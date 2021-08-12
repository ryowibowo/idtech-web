<?php

namespace App\Helpers;

class PhoneNumber{
    public function convert($phone_number)
    {
        $k = 0;
        $converted_string = "";
        $phone_number = (string)$phone_number;
        for ($b=0; $b < strlen($phone_number); $b++) {
            $k += 1;
            $converted_string .= $phone_number[$b];
            if($k % 4 == 0){
                $converted_string .= " ";
            }
        }
        return $converted_string;
    }
}