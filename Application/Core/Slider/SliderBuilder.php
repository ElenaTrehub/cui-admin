<?php


namespace Application\Core\Slider;

use Application\Core\Slider\templates\template1\SliderTemplate1;
use Application\Core\Slider\templates\template2\SliderTemplate2;



use Application\Services\SliderService;
use Application\Services\UtilsService;

class SliderBuilder
{
    public $utilsService;
    public $sliderService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->sliderService = new SliderService();
    }

    public function getSliderTemplate($id, $colors, $fonts, $spaces, $set){

        $sliderId = $this->getSliderByRubricIdAction($id);
        //$sliderId = 2;
        $pathToTemplate = '../Application/Core/Slider/templates/template'.$sliderId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Slider\templates\template'.$sliderId.'\SliderTemplate'.$sliderId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);


            $style = $this->setFontStyle($styleString, $fonts);

            $obj = $this->setUniqueStyle($style, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $set, $id);



            $slider = new \stdClass();
            $slider->html = $obj->html;
            $slider->css = $obj->style;
            $slider->js = $obj->js;
            $slider->set = $obj->set;

            return $slider;
        }


    }

    public function getSliderByRubricIdAction($id){

        $sliders = $this->sliderService->getMainsByRubricId($id);


        $slidersArray = [];
        foreach ($sliders as $key=>$item){
            $nextSlider = $this->sliderService->getMainById($item->idMain)[0];
            $slidersArray[] = $nextSlider;
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

        if(strpos($style, '/*m_h_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*m_h_fz*/', 'font-size: '.$fonts->h1Size.';');
        }

        if(strpos($style, '/*m_t_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*m_t_fz*/', 'font-size: '.$fonts->textSize.';');
        }

        if(strpos($style, '/*star_f_z*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*star_f_z*/', 'font-size: '.$fonts->h3Size.';');
        }

        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $set, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $colors, $set, $id);

    }


}