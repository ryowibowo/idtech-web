<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App;
use Lang;
use App\User;
use Hash;
use Session;

class PasswordValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $email;
    public $password;
    public $result = 0;

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
        $user = User::where('user_email', $this->email)->first();
        $this->password  = $user['user_password'];
        // if(Hash::check("indocyb3r",$user['user_password']) == true){
        //     return true;
        // }
        if($user !== null){
            if(Hash::check($value,$user['user_password']) == true){
                $this->result = 1;
                return true;
            }else{
                return false;
            }            
        }else{
            Session::flash('message_alert', Lang::get('notification.inaccurately'));
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
        return Lang::get('notification.not_same');
    }
}
