<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementFilterRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_type' => 'nullable|in:sale,rent',
            'property_type' => 'nullable|exists:property_types,id',
            'location' => 'nullable|string|max:255',
            'time_period' => 'nullable|in:24h,3d,7d,30d',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'min_area' => 'nullable|numeric|min:0',
            'max_area' => 'nullable|numeric|min:0',
            'sort' => 'nullable|in:recent,price_asc,price_desc',
            'district' => 'nullable|exists:districts,id',
            'municipality' => 'nullable|exists:municipalities,id',
            'parish' => 'nullable|exists:parishes,id',
        ];
    }

    public function applyFilters($query)
    {
        // Filtrar por tipo de transação (compra ou arrendamento)
        if ($this->filled('transaction_type') && in_array($this->transaction_type, ['sale', 'rent'])) {
            $query->where('transaction_type', $this->transaction_type);
        }

        // Filtrar localização (em várias tabelas: district, municipality, parish)
        if ($this->filled('location')) {
            $location = strtolower($this->location);
            $query->whereHas('property.parish.municipality.district', function ($q) use ($location) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$location}%"]);
            })->orWhereHas('property.parish.municipality', function ($q) use ($location) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$location}%"]);
            })->orWhereHas('property.parish', function ($q) use ($location) {
                $q->whereRaw('LOWER(name) LIKE ?', ["%{$location}%"]);
            });
        }

        // Filtros de preço
        if ($this->filled('min_price')) {
            $query->where('price', '>=', $this->min_price);
        }

        if ($this->filled('max_price')) {
            $query->where('price', '<=', $this->max_price);
        }

        // Filtros de área
        if ($this->filled('min_area')) {
            $query->whereHas('property', function ($q) {
                $q->where('total_area', '>=', (float)$this->min_area);
            });
        }

        if ($this->filled('max_area')) {
            $query->whereHas('property', function ($q) {
                $q->where('total_area', '<=', (float)$this->max_area);
            });
        }

        // Filtro por tipo de imóvel
        if ($this->filled('property_type')) {
            $query->whereHas('property', function ($q) {
                $q->where('property_type_id', $this->property_type);
            });
        }

        // Filtros por localização geográfica específica
        if ($this->filled('district')) {
            $query->whereHas('property.parish.municipality.district', function ($q) {
                $q->where('id', $this->district);
            });
        }

        if ($this->filled('municipality')) {
            $query->whereHas('property.parish.municipality', function ($q) {
                $q->where('id', $this->municipality);
            });
        }

        if ($this->filled('parish')) {
            $query->whereHas('property.parish', function ($q) {
                $q->where('id', $this->parish);
            });
        }

        // Filtro de tempo
        if ($this->filled('time_period')) {
            $now = now();
            switch ($this->time_period) {
                case '24h':
                    $query->where('advertisements.created_at', '>=', $now->subDay());
                    break;
                case '3d':
                    $query->where('advertisements.created_at', '>=', $now->subDays(3));
                    break;
                case '7d':
                    $query->where('advertisements.created_at', '>=', $now->subDays(7));
                    break;
                case '30d':
                    $query->where('advertisements.created_at', '>=', $now->subDays(30));
                    break;
            }
        }

        // Ordenação
        switch ($this->input('sort', 'recent')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('advertisements.created_at', 'desc');
                break;
        }

        return $query;
    }
}
