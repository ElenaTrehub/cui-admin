<?php


namespace Application\Core\Blocks\Footer\templates\template3;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class FooterTemplate3
{
    public $utilsService;
    public $settings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->libs = '';
        $obj->set = $settings;


        $obj = $this->setAlign($obj);

        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors);
        }
        else {
            $obj = $this->setDarkColorStyle($obj, $settings->colors);
        }


        return $obj;
    }
    public function setAlign($obj){

        $align  = ['left', 'right', 'center'];
        $index = rand(0, 2);
        if(strpos($obj->style, '/*footer_bottom_text_align*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_text_align*/', 'text-align: ' . $align[$index] . ';');
        }

        return $obj;
    }
    public function setColorsForChildInLightBlock($obj, $colors){

        if(strpos($obj->style, '/*footer_bottom_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_text_c*/', 'color: '.$colors->textColor.';');

        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->style, '/*footer_bottom_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_text_c*/', 'color: '.$colors->linkColor.';');

        }
    }


    public function setColorStyle($obj, $colors){


        if(isset($obj->set->lastSectionColor)){

            if($obj->set->lastSectionColor === 'light'){

                $bgAbout  = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'dark';


                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;

            }
            else{

                $bgAbout  = ['#999999', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'light';

                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;

            }


        }
        else{
            $bgAbout = [ '#999999', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            if(strpos($obj->style, '/*footer_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
            }

            if($index < 3){

                $this->setColorsForChildInLightBlock($obj, $colors);

                $obj->set->lastSectionColor = 'light';
            }
            else{

                $this->setColorsForChildInDarkBlock($obj, $colors);

                $obj->set->lastSectionColor = 'dark';
            }

            return $obj;
        }



    }

    public function setLightColorStyle($obj, $colors){
        $bgColor = '';
        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->secondBg:{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = ['#999999', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = ['#999999', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }
                    break;

                }
                default: {
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }
                }
            }
        }
        else{

            $bgAbout = [ '#999999', '#f0f1f6',  $colors->secondBg];
            $index = rand(0, 2);
            $bgColor = $bgAbout[$index];

        }


        if(strpos($obj->style, '/*footer_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;


        $this->setColorsForChildInLightBlock($obj, $colors);


        return $obj;

    }
    public function setDarkColorStyle($obj, $colors){
        $bgColor = '';
        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->mainBg:{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case $colors->thirdBg:{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                case '#555555':{
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }

                    break;
                }
                default : {
                    if(strpos($obj->style, '/*footer_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }
                }


            }
        }
        else{
            $bgAbout = [ $colors->mainBg,  $colors->thirdBg, '#555555'];
            $index = rand(0, 2);

            $bgColor = $bgAbout[$index];


        }

        if(strpos($obj->style, '/*footer_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bg*/', 'background-color: ' . $bgColor . ';');
        }

        $obj->set->lastSectionColor = $bgColor;
        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;

    }
}