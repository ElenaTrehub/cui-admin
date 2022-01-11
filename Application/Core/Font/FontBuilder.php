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

        $objFont = new \stdClass();
        $objFont->idFont = $font[0]->idFont;
        $objFont->link = $font[0]->link;
        $objFont->h1Size = $font[0]->h1Size;
        $objFont->h1Type = $font[0]->nameFont;
        $objFont->h2Size = $font[0]->h2Size;
        $objFont->h2Type = $font[0]->nameFont;
        $objFont->h3Size = $font[0]->h3Size;
        $objFont->h3Type = $font[0]->nameFont;
        $objFont->h4Size = $font[0]->h4Size;
        $objFont->h4Type = $font[0]->nameFont;
        $objFont->textSize = $font[0]->textSize;
        $objFont->textType = $font[0]->nameFont;
        $objFont->linkSize = $font[0]->linkSize;
        $objFont->linkType = $font[0]->nameFont;
        $objFont->bigSize = $font[0]->bigSize;
        $objFont->bigType = $font[0]->nameFont;

        return $objFont;
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