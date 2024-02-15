<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\User;

class ExistsInUsersTable implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @param  \Closure  $fail
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if each user ID exists in the users table
        foreach ($value as $userId) {
            if (!User::where('id', $userId)->exists()) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'One or more of the provided user IDs do not exist in the users table.';
    }
}
