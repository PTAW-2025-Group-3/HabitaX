<?php

namespace App\Services;

use App\Models\Property;
use App\Models\PropertyAttribute;
use App\Models\PropertyParameter;
use App\Models\PropertyParameterOption;
use App\Enums\AttributeType;

class PropertyAttributeService
{
    public function updateAttributes(Property $property, array $attributesData): void
    {
        $attributes = PropertyAttribute::whereIn('id', array_keys($attributesData))
            ->get()
            ->keyBy('id');

        foreach ($attributesData as $attributeId => $value) {
            $attribute = $attributes[$attributeId] ?? null;

            if (!$attribute) {
                continue;
            }

            if ($attribute->type === AttributeType::SELECT_MULTIPLE) {
                $this->updateSelectMultiple($property, $attribute, $value);
            } else {
                $this->updateValue($property, $attribute, $value);
            }
        }
    }

    private function updateValue(Property $property, PropertyAttribute $attribute, mixed $rawValue): void
    {
        $parameter = PropertyParameter::firstOrNew([
            'property_id' => $property->id,
            'attribute_id' => $attribute->id,
        ]);

        $parameter->setValue($rawValue, $attribute->type->value);
        $parameter->save();
    }

    private function updateSelectMultiple(Property $property, PropertyAttribute $attribute, array $optionIds): void
    {
        $parameter = PropertyParameter::firstOrCreate([
            'property_id' => $property->id,
            'attribute_id' => $attribute->id,
        ]);

        $currentOptionIds = $parameter->options()->pluck('option_id')->toArray();

        $toAdd = array_diff($optionIds, $currentOptionIds);
        $toRemove = array_diff($currentOptionIds, $optionIds);

        if (!empty($toRemove)) {
            PropertyParameterOption::where('parameter_id', $parameter->id)
                ->whereIn('option_id', $toRemove)
                ->delete();
        }

        foreach ($toAdd as $optionId) {
            PropertyParameterOption::create([
                'parameter_id' => $parameter->id,
                'option_id' => $optionId,
            ]);
        }
    }
}
