<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
use App;
use Lang;

class UsernameValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $user_id;

    public function __construct($user_id)
    {
        //
        $this->user_id = $user_id;
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
        //
        $user_id = $this->user_id;
        $user = User::where(function($query) use ($value){
            $query->where('user_email',$value)->orWhere('user_phone_number',$value)->from('98_user');
        })->whereNotIn('user_id',function($query) use ($user_id){
            $query->where('uu.user_id',$user_id)->select('uu.user_id')->from('98_user AS uu');
        })->get();

        if(count($user) == 0){
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
        return Lang::get('notification.duplicate',['attribute' => Lang::get(':attribute')]);
    }
}
