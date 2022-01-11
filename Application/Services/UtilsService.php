<?php


namespace Application\Services;


class UtilsService
{
    public function getItemByWeight($arr){
        if(count($arr)<2){
            return $arr[0];
        }
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

    public function setLandingSectionName($htmlString, $idStr){

        $idStr = lcfirst($idStr);
        $str = "<section id='{$idStr}' class='{$idStr} section'>";

        if(strpos($htmlString, '<!--nameSection-->',0)!==false){
            $htmlString = $this->parseStyle($htmlString, '<!--nameSection-->', $str);
        }
        return $htmlString;
    }

    public function setManyPageSectionName($htmlString, $idStr){
        $idStr = lcfirst($idStr);
        $str = "<section class='{$idStr} section'>";

        if(strpos($htmlString, '<!--nameSection-->',0)!==false){
            $htmlString = $this->parseStyle($htmlString, '<!--nameSection-->', $str);
        }
        return $htmlString;
    }
}