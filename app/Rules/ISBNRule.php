<?php
 
namespace App\Rules;
 
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ISBNRule implements ValidationRule
{
    /**
     * Run the validation rule.
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (strlen($value) > 0)
        {
            $tokens = explode(";", $value);
            foreach($tokens as $token)
            {
                $len = strlen($token);
                if ($len != 10 && $len != 13)
                {
                    $fail("Individual {$attribute} must be length 10 or 13");
                    break;
                }
            }
        }
    }
}