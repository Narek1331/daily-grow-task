<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;

class CustomDateOfBirth implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the date of birth matches the format 'dd.mm.yy'
        return preg_match('/^\d{2}\.\d{2}\.\d{2}$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be in the format dd.mm.yy.';
    }
}
