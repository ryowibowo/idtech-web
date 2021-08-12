<?php

namespace App\Helpers;

class Currency{
    public function convertToCurrency($number)
    {
        $converted_string = "";
        $string = (string)$number;
        $total = strlen($string);
        for ($b=0; $b < strlen($string); $b++) { 
            $total -= 1;
            $converted_string .= $string[$b];
            if($total > 0 && $total % 3 == 0){
                $converted_string .= ".";
            }
        }
        return $converted_string;
    }

    public function thousandsCurrencyFormat($number)
    {
        if($number > 1000) {
      
              $x = round($number);
              $x_number_format = number_format($x);
              $x_array = explode(',', $x_number_format);
              $x_parts = array('k', 'm', 'b', 't');
              $x_count_parts = count($x_array) - 1;
              $x_display = $x;
              $x_display = $x_array[0] . ((int) $x_array[1][0] !== 0 ? '.' . $x_array[1][0] : '');
              $x_display .= $x_parts[$x_count_parts - 1];
      
              return $x_display;
      
        }
      
        return $number;
      }
}