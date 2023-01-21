<?php

namespace App\Rules;

use App\Models\Field;
use Illuminate\Contracts\Validation\InvokableRule;
use Illuminate\Validation\Rule;

class FieldExists implements InvokableRule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     * @return void
     */
    public function __invoke($attribute, $value, $fail)
    {
        if (Field::where('title', str_replace('fields.', '', $attribute))->doesntExist()) {
            $fail('Field does not exist');
        }
    }
}
