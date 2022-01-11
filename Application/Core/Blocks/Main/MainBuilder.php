<?php


namespace Application\Core\Blocks\Main;

use Application\Core\Slider\templates\template1\SliderTemplate1;
use Application\Core\Slider\templates\template2\SliderTemplate2;



use Application\Services\SliderService;
use Application\Services\UtilsService;

class MainBuilder
{
    public $utilsService;
    public $sliderService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->sliderService = new SliderService();
    }

    public function getTemplate($id, $style, $settings, $idStr, $isLanding, $userSliderId=null){

        $sliderId = is_null($userSliderId) ? $this->getSliderByRubricIdAction($id, $style) : $userSliderId;

        $sliderId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Main/templates/template'.$sliderId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Main\templates\template'.$sliderId.'\MainTemplate'.$sliderId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            if($isLanding === true){
                $html = $this->utilsService->setLandingSectionName($htmlString, $idStr);
            }
            else{
                $html = $this->utilsService->setManyPageSectionName($htmlString, $idStr);
            }
            $style = $this->setFontStyle($styleString, $settings->fonts);

            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder, $settings, $id);



            $slider = new \stdClass();
            $slider->html = $obj->html;
            $slider->css = $obj->style;
            $slider->js = $obj->js;
            $slider->set = $obj->set;

            return $slider;
        }


    }

    public function getSectionsByName($id, $styleName){

        $mains = $this->sliderService->getMainsByRubricId($id);

        $mainsArray = [];
        foreach ($mains as $key=>$item){

            $nextMain = $this->sliderService->getMainById($item->idMain)[0];

            if(count($nextMain)>0){
                $mainsArray[] = $nextMain;
            }

        }

        $mainsStyleArray = [];

        foreach($mainsArray as $key=>$main){
            if($main->style === $styleName){
                $mainsStyleArray[]= $main;
            }
        }

        return $mainsStyleArray;

    }

    public function getSliderByRubricIdAction($id, $style){

        $sliders = $this->sliderService->getMainsByRubricId($id);


        $slidersArray = [];
        foreach ($sliders as $key=>$item){
            if($style === 'all'){
                $nextSlider = $this->sliderService->getMainById($item->idMain)[0];
            }
            else{
                $nextSlider = $this->sliderService->getMainByIdAndStyle($item->idMain, $style)[0];
            }
            if(count($nextSlider)>0){
                $slidersArray[] = $nextSlider;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($sliders)-1);
            $sliderId = $sliders[$index]->idMain;
        }
        else{
            $sliderId = $this->utilsService->getItemByWeight($slidersArray)->idMain;
        }

        return $sliderId;
    }

    public function setFontStyle($style, $fonts){

//        if(strpos($style, '/*m_h_fz*/',0)!==false){
//            $style = $this->utilsService->parseStyle($style, '/*m_h_fz*/', 'font-size: '.$fonts->h1Size.';');
//        }
//
//        if(strpos($style, '/*m_t_fz*/',0)!==false){
//            $style = $this->utilsService->parseStyle($style, '/*m_t_fz*/', 'font-size: '.$fonts->textSize.';');
//        }
//
//        if(strpos($style, '/*star_f_z*/',0)!==false){
//            $style = $this->utilsService->parseStyle($style, '/*star_f_z*/', 'font-size: '.$fonts->h3Size.';');
//        }

        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }


}