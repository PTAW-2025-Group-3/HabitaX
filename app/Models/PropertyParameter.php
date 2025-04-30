<?php

namespace App\Models;

use App\Enums\AttributeType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PropertyParameter extends Model
{
    use HasFactory;

    protected $fillable = [
        'property_id',
        'attribute_id',
        'value',
        'text_value',
        'int_value',
        'float_value',
        'boolean_value',
        'select_value',
        'date_value',
        'is_multiple',
    ];

    protected $casts = [
        'int_value' => 'integer',
        'float_value' => 'float',
        'boolean_value' => 'boolean',
        'date_value' => 'date',
        'is_multiple' => 'boolean',
    ];

    public function setValue(mixed $rawValue, string $type): void
    {
        $this->value = null;
        $this->text_value = null;
        $this->int_value = null;
        $this->float_value = null;
        $this->boolean_value = null;
        $this->select_value = null;
        $this->date_value = null;

        switch ($type) {
            case AttributeType::TEXT->value:
            case AttributeType::LONG_TEXT->value:
                $this->text_value = $rawValue;
                break;

            case AttributeType::INT->value:
                $this->int_value = is_numeric($rawValue) ? (int)$rawValue : null;
                break;

            case AttributeType::FLOAT->value:
                $this->float_value = is_numeric($rawValue) ? (float)$rawValue : null;
                break;

            case AttributeType::BOOLEAN->value:
                $this->boolean_value = match ($rawValue) {
                    'true', true, 1, '1' => true,
                    'false', false, 0, '0' => false,
                    default => null,
                };
                break;

            case AttributeType::SELECT_SINGLE->value:
                $this->select_value = $rawValue;
                break;

            case AttributeType::SELECT_MULTIPLE->value:
                $this->is_multiple = true;
                break;

            case AttributeType::DATE->value:
                $this->date_value = $rawValue ? \Carbon\Carbon::parse($rawValue) : null;
                break;

            default:
                $this->value = $rawValue;
                break;
        }
    }

    public function property()
    {
        return $this->belongsTo(Property::class, 'property_id');
    }

    public function attribute()
    {
        return $this->belongsTo(PropertyAttribute::class, 'attribute_id');
    }

    public function select_value()
    {
        return $this->belongsTo(PropertyAttributeOption::class, 'select_value');
    }

    public function options()
    {
        return $this->hasMany(PropertyParameterOption::class, 'parameter_id');
    }
}
