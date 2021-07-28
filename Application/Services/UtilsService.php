<?php


namespace Application\Services;


class UtilsService
{
    public function getItemByWeight($arr){

        usort ( $arr , function ($a, $b) {

            if($a->weight == $b->weight){
                return 0;
            }
            return ($a->weight > $b->weight) ? -1 : 1;
        }
        );


        return $arr[1];

    }

    public function parseStyle($str, $flag, $refactorString){

        if(strpos($str, $flag, 0)!==false){
            $style = str_replace($flag, $refactorString, $str);
        }
        return $style;
    }

}