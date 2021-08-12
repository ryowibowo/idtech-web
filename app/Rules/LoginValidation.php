<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App;
use Lang;
use App\User;
use App\GlobalSettings;
use Hash;
use Session;

class LoginValidation implements Rule
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
        $user = User::select('98_user.user_id','98_user.user_name','98_user.user_email','98_user.user_password','98_user.user_phone_number','98_user.pwd_changed','98_user.active_flag AS user_active_status','98_user_role.role_id','98_role.role_name','98_role.role_desc','98_user.user_image','98_user.warehouse_id','00_warehouse.warehouse_name','98_user.organization_id','00_organization.organization_name','00_organization.organization_type_id','98_role_type.role_type_id','98_role_type.role_type_name')->join('98_user_role','98_user_role.user_id','=','98_user.user_id')->join('98_role','98_role.role_id','=','98_user_role.role_id')->leftJoin('00_organization','00_organization.organization_id','=','98_user.organization_id')->leftJoin('98_role_type','98_role_type.role_type_id','=','98_role.role_type_id')->leftJoin('00_warehouse','00_warehouse.warehouse_id','=','98_user.warehouse_id')->where([
            ['98_user.user_email','=',$this->email]
        ])->first();
        
        if($user != null){
            if ($user['user_active_status'] != 0) {
                if(Hash::check($value,$user['user_password']) != false) {                
                    $token = Hash::make('secret');

                    $company_logo = GlobalSettings::where('global_parameter_name','company_logo')->first();
                    if($user['pwd_changed'] == 0){
                        Session::flash('password_alert',Lang::get('notification.change_password',['name' => $user['user_name']]));
                    }
                    if($company_logo != null){
                        $user = array(
                            'id' => $user['user_id'],
                            'fullname' => $user['user_name'],
                            'email' => $this->email,
                            'role_id' => $user['role_id'],
                            'role_name' => $user['role_name'],
                            'profile_picture' => $user['user_image'],
                            'token' => $token,
                            'organization_id' => $user['organization_id'],
                            'organization_name' => $user['organization_name'],
                            'organization_type_id' => $user['organization_type_id'],
                            'role_status' => $user['organization_type_id'] == 2 ? 'agent' : 'cms',
                            'warehouse_id' => $user['warehouse_id'],
                            'warehouse_name' => $user['warehouse_name'],
                            'company_logo' => $company_logo['global_parameter_value'],
                            'role_type_id' => $user['role_type_id'],
                            'role_type_name' => $user['role_type_name']
                        );
                    }else{
                        $user = array(
                            'id' => $user['user_id'],
                            'fullname' => $user['user_name'],
                            'email' => $this->email,
                            'role_id' => $user['role_id'],
                            'role_name' => $user['role_name'],
                            'profile_picture' => $user['user_image'],
                            'token' => $token,
                            'organization_id' => $user['organization_id'],
                            'organization_name' => $user['organization_name'],
                            'organization_type_id' => $user['organization_type_id'],
                            'role_status' => $user['organization_type_id'] == 2 ? 'agent' : 'cms',
                            'warehouse_id' => $user['warehouse_id'],
                            'warehouse_name' => $user['warehouse_name'],
                            'role_type_id' => $user['role_type_id'],
                            'role_type_name' => $user['role_type_name']
                        );
                    }
                    Session::put('users',$user);
                    User::where('user_id', $user['id'])->update(['last_login' => date('Y-m-d H:i:s'),'remember_token' => $token]);
                    return true;
                }else{
                    User::where('user_id', $user['user_id'])->update(['count_invalid_login' => ($user['count_invalid_login'] + 1)]);
                    Session::flash('message_alert', Lang::get('notification.cannot_login'));
                    return false;
                }
            } else {
                Session::flash('message_alert', Lang::get('notification.unactive'));
                return false;
            }
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
        return Lang::get('auth.failed');
    }
}
