<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class SkillRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $lst = explode(',', $value);
        $flag = true;

        foreach ($lst as $sk) {
            $val = trim($sk);
            if (strlen($val) == 0 || strlen($val) > 10 || !ctype_alpha($val)) {
                $flag = false;
                break;
            }
        }
        return $flag;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Skills should not be empty and must be less than 10 character 
        and can have only letter';
    }
}
