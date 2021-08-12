<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App;
use Lang;
use App\OTP;

class OTPValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $email;

    public function __construct($email)
    {
        $this->email = $email;
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
        $data = OTP::join('98_user','98_user.user_id','=','99_otp.user_id')->where('98_user.user_email', $this->email)->where('99_otp.otp_code', $value)->count();
        if($data == 0){
            return false;
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
        return Lang::get('notification.invalid_otp');
    }
}
