<?php


namespace Application\Core\Color;


use Application\Services\ColorService;
use Application\Services\HeaderService;
use Application\Services\IframeService;
use Application\Services\UtilsService;

class ColorBuilder
{
    public $utilsService;
    public $colorService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->colorService = new ColorService();
    }
    public function getColorObj($id){

        $idColor = $this->getColorsByRubricId($id);
        $color = $this->colorService->getColorById($idColor);

        return $color[0];
    }

    public function getColorsByRubricId($id){


        $colors = $this->colorService->getColorsByRubricId($id);

        $colorArray = [];
        foreach ($colors as $item){
            $nextColor = $this->colorService->getColorById($item->idColor)[0];
            $colorArray[] = $nextColor;
        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($colors)-1);
            $colorId = $colors[$index]->idColor;
        }
        else{
            $colorId = $this->utilsService->getItemByWeight($colorArray)->idColor;
        }


        return $colorId;
    }

}