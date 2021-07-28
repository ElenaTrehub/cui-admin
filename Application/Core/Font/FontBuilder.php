<?php


namespace Application\Core\Font;


use Application\Services\ColorService;
use Application\Services\FontService;
use Application\Services\UtilsService;

class FontBuilder
{
    public $utilsService;
    public $fontService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->fontService = new FontService();
    }
    public function getFontObj($id){

        $idFont = $this->getFontByRubricId($id);

        $font = $this->fontService->getFontById($idFont);



        return $font[0];
    }

    public function getFontByRubricId($id){


        $fonts = $this->fontService->getFontsByRubricId($id);

        $fontsArray = [];
        foreach ($fonts as $item){
            $nextFont = $this->fontService->getFontById($item->idFont)[0];
            $fontsArray[] = $nextFont;
        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($fonts)-1);
            $fontId = $fonts[$index]->idFont;
        }
        else{
            $fontId = $this->utilsService->getItemByWeight($fontsArray)->idFont;
        }


        return $fontId;
    }

}