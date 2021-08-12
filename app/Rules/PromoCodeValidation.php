<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\ProductPromo;
use App;
use Lang;

class PromoCodeValidation implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $product_id;

    public function __construct($product_id)
    {
        $this->product_id = $product_id;
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
        $product_id = $this->product_id;
        $product_promo = ProductPromo::where('prod_id', '!=', $product_id)->where('promo_code', '=' ,$value)->get();
        if(count($product_promo) == 0){
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
