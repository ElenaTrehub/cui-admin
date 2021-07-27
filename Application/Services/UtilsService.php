<?php


namespace Application\Services;


class WeightService
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

}