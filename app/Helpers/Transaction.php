<?php

namespace App\Helpers;

class Transaction{
    public function generateCode($id, $complaint = null){
        $id = (string)$id;
        $first_index = 9;
        if($complaint != null && $complaint != "bill"){
            $first_index = 12;
        }
        $code = str_pad($id, $first_index, '0', STR_PAD_LEFT);
        $code_template = "YMOD".date("Ymd");
        if($complaint != null){
            $code_template = "YMIS";
            if($complaint == "user"){
                $code_template = "YMPPL";
            }elseif($complaint == "bill"){
                $code_template = "YMBL".date("Ymd");
            }
        }
        $code = $code_template.$code;

        return $code;
    }
}

?>