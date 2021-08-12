<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App;
use Lang;
use App\UOM;

class NumberValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $uom_id;
    public function __construct($uom_id)
    {
        $this->uom_id = $uom_id;
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
        $data = UOM::where('uom_id', $this->uom_id)->first();
        
        if($data['is_decimal'] == 0){
            return ctype_digit($value) == true ? true : false;
        }else if($data['is_decimal'] == 1){
            return true;
        }else{
            return false;
        }
        // echo ctype_digit('10') == true ? 'true' : 'false';
        // exit;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('notification.invalid_number_format');
    }
}
