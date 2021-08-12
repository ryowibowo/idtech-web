<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App;
use Lang;

class VoucherValueValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $is_fixed;

    public function __construct($is_fixed)
    {
        $this->is_fixed = $is_fixed;
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
        $is_fixed = $this->is_fixed;
        $value = str_replace('.','',$value);
        // echo $is_fixed;
        // exit;
        if($is_fixed == 'N'){
            if($value > 100){
                return false;
            }else{
                return true;
            }
        }else{
            return true;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('notification.wrong_voucher_value_format');
    }
}
