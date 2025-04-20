<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertisementFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'location' => 'nullable|string|max:255',
            'time_period' => 'nullable|in:24h,3d,7d,30d',
            'min_price' => 'nullable|numeric|min:0',
            'max_price' => 'nullable|numeric|min:0',
            'min_area' => 'nullable|numeric|min:0',
            'max_area' => 'nullable|numeric|min:0',
            'sort' => 'nullable|in:recent,price_asc,price_desc',
        ];
    }

    /**
     * Apply filters to the query.
     */
    public function applyFilters($query)
    {
        if ($this->filled('location')) {
            $query->where('location', 'LIKE', "%{$this->location}%");
        }

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

        if ($this->filled('min_price')) {
            $query->where('price', '>=', (float)$this->min_price);
        }

        if ($this->filled('max_price')) {
            $query->where('price', '<=', (float)$this->max_price);
        }

        if ($this->filled('min_area')) {
            $query->where('properties.total_area', '>=', (float)$this->min_area);
        }

        if ($this->filled('max_area')) {
            $query->where('properties.total_area', '<=', (float)$this->max_area);
        }

        switch ($this->input('sort', 'recent')) {
            case 'price_asc':
                $query->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $query->orderBy('price', 'desc');
                break;
            default:
                $query->orderBy('created_at', 'desc');
                break;
        }

        return $query;
    }
}
