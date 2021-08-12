<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Voucher;
use App;
use Lang;

class VoucherCodeValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    
    public $voucher_id;

    public function __construct($voucher_id)
    {
        $this->voucher_id = $voucher_id;
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
        $voucher_id = $this->voucher_id;
        $voucher = Voucher::where('voucher_id', '!=', $voucher_id)->where('voucher_code', '=' ,$value)->get();
        if(count($voucher) == 0){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('notification.duplicate',['attribute' => Lang::get('field.:attribute')]);
    }
}
