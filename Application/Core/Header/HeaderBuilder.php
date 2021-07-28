<?php


namespace Application\Core\Header;


use Application\Core\Header\templates\template1\HeaderTemplate1;
use Application\Core\Header\templates\template2\HeaderTemplate2;
use Application\Core\Header\templates\template3\HeaderTemplate3;

use Application\Services\HeaderService;
use Application\Services\UtilsService;

class HeaderBuilder
{
//основная логика хедера и общие вычисления
    public $utilsService;
    public $headerService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->headerService = new HeaderService();
    }

    public function getHeaderTemplate($id, $colors, $fonts, $spaces, $theme){

        $headerId = $this->getHeaderByRubricIdAction($id);
        $headerId = 2;
        $pathToTemplate = '../Application/Core/Header/templates/template'.$headerId;

        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Header\templates\template'.$headerId.'\HeaderTemplate'.$headerId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);


            //$style = $this->setPositionStyle($styleString);
            $style = $this->setFontStyle($styleString, $fonts);

            $style = $this->setSpaceStyle($style, $spaces);

            $obj = $this->setUniqueStyle($style, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $theme);



            $header = new \stdClass();
            $header->html = $obj->html;
            $header->css = $obj->style;
            $header->js = $obj->js;
            $header->set = $obj->set;


            return $header;
        }


    }

    public function getHeaderByRubricIdAction($id){

        $headers = $this->headerService->getHeadersByRubricId($id);

        $headerArray = [];
        foreach ($headers as $key=>$item){
            $nextHeader = $this->headerService->getHeaderById($item->idHeader)[0];
            $headerArray[] = $nextHeader;
        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($headers)-1);
            $headerId = $headers[$index]->idHeader;
        }
        else{
            $headerId = $this->utilsService->getItemByWeight($headerArray)->idHeader;
        }

        return $headerId;
    }





    public function setFontStyle($style, $fonts){

        if(strpos($style, '/*h_t_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_t_fz*/', 'font-size: '.$fonts->textSize.';');
        }

        if(strpos($style, '/*h_m_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_m_fz*/', 'font-size: '.$fonts->textSize.';');
        }

        if(strpos($style, '/*menu_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*menu_fz*/', 'font-size: '.$fonts->linkSize.';');
        }

        if(strpos($style, '/*menu_f_transform*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*menu_f_transform*/', 'text-transform: '.$fonts->textTransform.';');
        }

        return $style;
    }

    public function setSpaceStyle($style, $spaces){

        if(strpos($style, '/*h_t_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_t_p*/', 'padding: '.$spaces->headerSmallSpace.';');
        }

        if(strpos($style, '/*h_m_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_m_p*/', 'padding: '.$spaces->headerBigSpace.';');
        }

        if(strpos($style, '/*h_b_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_b_p*/', 'padding: '.$spaces->headerBigSpace.';');
        }

        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $theme){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $colors, $theme);

    }


}