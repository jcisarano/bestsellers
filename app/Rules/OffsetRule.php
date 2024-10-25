<?php
 
namespace App\Rules;
 
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
 
use Illuminate\Support\Facades\Log;


class OffsetRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(!is_numeric($value))
        {
            $fail("{$attribute} must be a number");
            return;
        }

        if( $value % 20 != 0)
        {
            $fail("{$attribute} must be multple of 20");
        }
    }
}