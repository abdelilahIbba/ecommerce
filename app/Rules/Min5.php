<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Min5 implements Rule
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
        return strlen($value) >= 5;  // Checks if string length is at least 5 characters
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The :attribute must be at least 5 characters long.';
    }
}
