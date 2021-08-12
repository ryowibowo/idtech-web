<?php

namespace App\Helpers;
use App\Uom;
use App\UomConvertion;
use DB;

class UomConvert{
    public function convert($first_uom, $second_uom){
        $uom = Uom::select(DB::raw('(SELECT uo.uom_id FROM 00_uom AS uo where uo.uom_name = "'.$first_uom.'") AS uom_first_id'),DB::raw('(SELECT uo.uom_name FROM 00_uom AS uo where uo.uom_name = "'.$first_uom.'") AS uom_first_name'),DB::raw('(SELECT uo.uom_id FROM 00_uom AS uo where uo.uom_name = "'.$second_uom.'") AS uom_second_id'),DB::raw('(SELECT uo.uom_name FROM 00_uom AS uo where uo.uom_name = "'.$second_uom.'") AS uom_second_name'),'00_uom_convertion.formula')->join('00_uom_convertion', function($join){
            $join->on('00_uom_convertion.uom_first_id','=','00_uom.uom_id');
            $join->orOn('00_uom_convertion.uom_second_id','=','00_uom.uom_id');
        })->where(function($query) use($first_uom,$second_uom){
            $query->where('00_uom_convertion.uom_first_id', function($query2) use($first_uom){
                $query2->from('00_uom')->select('00_uom.uom_id')->where(DB::raw('00_uom.uom_name'),strtolower($first_uom));
            })->where('00_uom_convertion.uom_second_id', function($query2) use($second_uom){
                $query2->from('00_uom')->select('00_uom.uom_id')->where(DB::raw('00_uom.uom_name'),strtolower($second_uom));
            });
            // $query->where('00_uom.uom_name',$first_uom)->orWhere('00_uom.uom_name',$second_uom);
        })->orWhere(function($query) use($first_uom,$second_uom){
            $query->where('00_uom_convertion.uom_first_id', function($query2) use($second_uom){
                $query2->from('00_uom')->select('00_uom.uom_id')->where(DB::raw('LOWER(00_uom.uom_name)'),strtolower($second_uom));
            })->where('00_uom_convertion.uom_second_id', function($query2) use($first_uom){
                $query2->from('00_uom')->select('00_uom.uom_id')->where(DB::raw('LOWER(00_uom.uom_name)'),strtolower($first_uom));
            });
            // $query->where('00_uom.uom_name',$first_uom)->orWhere('00_uom.uom_name',$second_uom);
        })->first();

        return $uom;
    }

    public function convertToStock ($first_uom, $first_value, $second_uom, $second_value){
        $result = 0;
        if($first_uom == $second_uom){
            $result = $first_value / $second_value;
        } else {
            $uom_multiplication = UomConvertion::select('*')
                            ->where('uom_first_id',$first_uom)
                            ->where('uom_second_id',$second_uom)
                            ->first();
            if ($uom_multiplication) {
                $formula = $uom_multiplication->formula;
                $result = ($first_value * $formula) / $second_value;
                // dd($result);
            } else {
                $uom_division = UomConvertion::select('*')
                                ->where('uom_second_id',$first_uom)
                                ->where('uom_first_id',$second_uom)
                                ->first();
                if ($uom_division) {
                    $formula = $uom_division->formula;
                    $result = ($first_value / $formula) / $second_value;
                } else {
                    $result = array('flag'=>false, 'message'=>'Konversi tidak ditemukan!');
                }
            }
        }
        return $result;

    }


    public function checkUom ($first_uom, $first_value, $second_uom, $second_value){
        $result = 0;
        if($first_uom == $second_uom){
            $result = $first_value;
        } else {
            $uom_multiplication = UomConvertion::select('*')
                            ->where('uom_first_id',$first_uom)
                            ->where('uom_second_id',$second_uom)
                            ->first();
            if ($uom_multiplication) {
                $formula = $uom_multiplication->formula;
                $result = ($first_value * $formula);
                // dd($result);
            } else {
                $uom_division = UomConvertion::select('*')
                                ->where('uom_second_id',$first_uom)
                                ->where('uom_first_id',$second_uom)
                                ->first();
                if ($uom_division) {
                    $formula = $uom_division->formula;
                    $result = ($first_value / $formula);
                } else {
                    $result = array('flag'=>false, 'message'=>'Konversi tidak ditemukan!');
                }
            }
        }
        $res = $result > $second_value;
        return $res;

    }
}

?>