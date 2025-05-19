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
            'sort' => 'nullable|in:recent,price_asc,price_desc',
            'district' => 'nullable|exists:districts,id',
            'municipality' => 'nullable|exists:municipalities,id',
            'parish' => 'nullable|exists:parishes,id',
            'attributes' => 'nullable|array',
        ];
    }

    public function applyFilters($query)
    {
        if ($this->filled('transaction_type') && in_array($this->transaction_type, ['sale', 'rent'])) {
            $query->where('transaction_type', $this->transaction_type);
        }

        if ($this->filled('location')) {
            $query->where('location', 'LIKE', "%{$this->location}%");
        }

        if ($this->filled('min_price')) {
            $query->where('price', '>=', $this->min_price);
        }

        if ($this->filled('max_price')) {
            $query->where('price', '<=', $this->max_price);
        }

        if ($this->filled('property_type')) {
            $query->whereHas('property', function ($q) {
                $q->where('property_type_id', $this->property_type);
            });
        }

        if ($this->has('created_by')) {
            $query->where('created_by', $this->input('created_by'));
        }

        // Dynamic attribute filters
        if ($this->has('attributes') && is_array($this->input('attributes'))) {
            foreach ($this->input('attributes') as $attributeId => $data) {
                $query->whereHas('property.parameters', function ($q) use ($attributeId, $data) {
                    $q->where('attribute_id', $attributeId);

                    if (isset($data['min_int'])) {
                        $q->where('int_value', '>=', $data['min_int']);
                    }
                    if (isset($data['max_int'])) {
                        $q->where('int_value', '<=', $data['max_int']);
                    }

                    if (isset($data['min_float'])) {
                        $q->where('float_value', '>=', $data['min_float']);
                    }
                    if (isset($data['max_float'])) {
                        $q->where('float_value', '<=', $data['max_float']);
                    }

                    if (isset($data['boolean'])) {
                        $q->where('boolean_value', $data['boolean']);
                    }

                    if (isset($data['start_date'])) {
                        $q->whereDate('date_value', '>=', $data['start_date']);
                    }
                    if (isset($data['end_date'])) {
                        $q->whereDate('date_value', '<=', $data['end_date']);
                    }

                    if (isset($data['select_single'])) {
                        $q->where('select_value', $data['select_single']);
                    }

                    if (isset($data['select_multiple']) && is_array($data['select_multiple']) && count($data['select_multiple']) > 0) {
                        $selectedOptionIds = $data['select_multiple'];

                        $q->whereHas('options', function ($subQ) use ($selectedOptionIds) {
                            $subQ->whereIn('option_id', $selectedOptionIds);
                        }, '=', count($selectedOptionIds));
                    }
                });
            }
        }

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

        if ($this->filled('time_period')) {
            $now = now();
            switch ($this->time_period) {
                case '24h': $query->where('advertisements.created_at', '>=', $now->subDay()); break;
                case '3d':  $query->where('advertisements.created_at', '>=', $now->subDays(3)); break;
                case '7d':  $query->where('advertisements.created_at', '>=', $now->subDays(7)); break;
                case '30d': $query->where('advertisements.created_at', '>=', $now->subDays(30)); break;
            }
        }

        // Ordenação
        $sortField = 'advertisements.created_at';
        $sortDirection = 'desc';

        switch ($this->input('sort', 'recent')) {
            case 'price_asc':
                $sortField = 'price';
                $sortDirection = 'asc';
                break;
            case 'price_desc':
                $sortField = 'price';
                $sortDirection = 'desc';
                break;
            default:
                // Já definido como padrão
                break;
        }

        return $query->orderBy($sortField, $sortDirection)
            ->orderBy('advertisements.id', 'asc');
    }
}
