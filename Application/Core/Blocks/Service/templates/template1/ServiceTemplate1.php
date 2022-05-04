<?php


namespace Application\Core\Blocks\Service\templates\template1;


use Application\Core\JsLibs\JsLibs;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class ServiceTemplate1
{
    public $utilsService;
    public $jsLibs;
    public $settings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->jsLibs = new JsLibs();
        $this->settings = new Settings();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $pageName){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->libs = '';
        $obj->set = $settings;


        $obj = $this->setPhoto($obj, $id);


        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors, $id);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors, $id);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $settings->colors, $id);
        }
        $obj = $this->setJs($obj);

        if($pageName){

            if(strpos($obj->style, '/*page*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*page*/', '.service-'.$pageName);
            }
            if(strpos($obj->js, '/*page*/',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '/*page*/', '.service-'.$pageName);
            }


        }

        return $obj;
    }

    public function setPhoto($obj, $id){
        if(strpos($obj->html, '<!--im_service_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_service_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/service-1.jpg" alt="service">');
        }
        if(strpos($obj->html, '<!--im_service_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_service_2-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/service-2.jpg" alt="service">');
        }
        if(strpos($obj->html, '<!--im_service_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_service_3-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/service-3.jpg" alt="service">');
        }
        return $obj;
    }


    public function setJs($obj){

        if(in_array('getSliderOfThreeItems', $obj->set->libs)){
            if(strpos($obj->js, '//js_code_service',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_service', 'slidesThreeSlider(".service-slider-item", ".service-wrapper", ".service-slider", ".service-prev-btn", ".service-next-btn");');
            }
        }
        else{
            array_push($obj->set->libs, 'getSliderOfThreeItems');
            $obj->libs = $obj->libs.$this->jsLibs->getJsLib('getSliderOfThreeItems');
            if(strpos($obj->js, '//js_code_service',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_service', 'slidesThreeSlider(".service-slider-item", ".service-wrapper", ".service-slider", ".service-prev-btn", ".service-next-btn");');
            }
        }

        return $obj;

    }
    public function setColorsForChildInLightBlock($obj, $colors){
        if(strpos($obj->js, '/*service_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*service_h_c*/', 'serviceTitle.classList.add("title-light");');
        }
        if(strpos($obj->style, '/*service_head_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_head_c*/', 'color: '.$colors->titleColor.';');
        }
        if(strpos($obj->style, '/*service_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_t_c*/', 'color: '.$colors->textColor.';');
        }
        if(strpos($obj->style, '/*ser_c_content*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*ser_c_content*/', 'color: '.$colors->textColor.';');
        }

    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->js, '/*service_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*service_h_c*/', 'serviceTitle.classList.add("title-dark");');
        }
        if(strpos($obj->style, '/*service_head_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_head_c*/', 'color: '.$colors->anyTextColor.';');
        }
        if(strpos($obj->style, '/*service_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_t_c*/', 'color: '.$colors->linkColor.';');
        }
        if(strpos($obj->style, '/*ser_c_content*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*ser_c_content*/', 'color: '.$colors->linkColor.';');
        }

    }

    public function setLightBg($obj, $colors, $id){
        if(strpos($obj->style, '/*service_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/service_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: lighten; background-color: rgba(255, 255, 255, .5);');
        }
    }
    public function setDarkBg($obj, $colors, $id){
        if(strpos($obj->style, '/*service_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/service_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: darken; background-color: rgba('.$colors->rgbaMainBg.', .65);');
        }
    }


    public function setColorStyle($obj, $colors, $id){

        if($obj->set->withBg === 'withBg'){
            if(isset($obj->set->lastSectionWithBg)){
                if($obj->set->lastSectionWithBg !== true){
                    if($obj->set->lastSectionColor === 'light'){
                        $this->setDarkBg($obj, $colors, $id);
                        $this->setColorsForChildInDarkBlock($obj, $colors);
                        $obj->set->lastSectionColor = 'dark';
                    }
                    else{
                        $this->setLightBg($obj, $colors, $id);
                        $this->setColorsForChildInLightBlock($obj, $colors);
                        $obj->set->lastSectionColor = 'light';
                    }
                    $obj->set->lastSectionWithBg = true;

                    return $obj;
                }
                else{
                    $obj->set->lastSectionWithBg = false;
                }
            }
            else{
                if($obj->set->lastSectionColor === 'light'){
                    $this->setDarkBg($obj, $colors, $id);
                    $this->setColorsForChildInDarkBlock($obj, $colors);
                    $obj->set->lastSectionColor = 'dark';
                }
                else{
                    $this->setLightBg($obj, $colors, $id);
                    $this->setColorsForChildInLightBlock($obj, $colors);
                    $obj->set->lastSectionColor = 'light';
                }
                $obj->set->lastSectionWithBg = true;
                return $obj;
            }

        }
        if(isset($obj->set->lastSectionColor)){

            if($obj->set->lastSectionColor === 'light'){

                $bgFeature = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'dark';

                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;
            }

            else{
                $bgFeature = ['#ffffff', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'light';

                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;
            }

        }
        else{


            $bgFeature = [ '#ffffff', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-color: '.$bgFeature[$index].';');

            if($index < 3) {
                $this->setColorsForChildInLightBlock($obj, $colors);

                $obj->set->lastSectionColor = 'light';

            }
            else {
                $this->setColorsForChildInDarkBlock($obj, $colors);

                $obj->set->lastSectionColor = 'dark';
            }

            return $obj;


        }




    }
    public function setLightColorStyle($obj, $colors, $id){
        if($obj->set->withBg === 'withBg'){
            if(isset($obj->set->lastSectionWithBg)){
                if($obj->set->lastSectionWithBg !== true){

                    $this->setLightBg($obj, $colors, $id);

                    $obj->set->lastSectionColor = '#ffffff';
                    $obj->set->lastSectionWithBg = true;
                    $this->setColorsForChildInLightBlock($obj, $colors);
                    return $obj;
                }else{
                    $obj->set->lastSectionWithBg = false;
                }
            }
            else{

                $this->setLightBg($obj, $colors, $id);

                $obj->set->lastSectionColor = '#ffffff';

                $obj->set->lastSectionWithBg = true;
                $this->setColorsForChildInLightBlock($obj, $colors);
                return $obj;
            }

        }

        $bgColor = '';

        if(isset($obj->set->lastSectionColor)){
            $colorStr = $obj->set->lastSectionColor;
            switch ($colorStr){
                case "$colors->secondBg":{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default: {

                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                }
            }
        }
        else{

            $bgAbout = [ '#ffffff', '#f0f1f6',  $colors->secondBg];
            $index = rand(0, 2);

            $bgColor = $bgAbout[$index];

        }
        if(strpos($obj->style, '/*service_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInLightBlock($obj, $colors);


        return $obj;


    }


    public function setDarkColorStyle($obj, $colors, $id){
        if($obj->set->withBg === 'withBg'){
            if(isset($obj->set->lastSectionWithBg)){
                if($obj->set->lastSectionWithBg !== true){

                    $this->setDarkBg($obj, $colors, $id);

                    $obj->set->lastSectionColor = '#555555';
                    $obj->set->lastSectionWithBg = true;
                    $this->setColorsForChildInDarkBlock($obj, $colors);

                    return $obj;
                }
                else{
                    $obj->set->lastSectionWithBg = false;
                }
            }
            else{

                $this->setDarkBg($obj, $colors, $id);

                $obj->set->lastSectionColor = '#555555';

                $obj->set->lastSectionWithBg = true;
                $this->setColorsForChildInDarkBlock($obj, $colors);
                return $obj;
            }

        }
        $bgColor = '';

        if(isset($obj->set->lastSectionColor)){
            $colorStr = $obj->set->lastSectionColor;
            switch ($colorStr){
                case "$colors->mainBg":{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }

                    break;
                }
                case "$colors->thirdBg":{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#555555':{
                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default : {

                    if(strpos($obj->style, '/*service_bg*/',0)!==false) {

                        $bgAbout  = ['#555555', $colors->thirdBg];
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

        if(strpos($obj->style, '/*service_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*service_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;


    }




}