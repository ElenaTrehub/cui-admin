<?php


namespace Application\Core\Blocks\Contact\templates\template2;


use Application\Core\JsLibs\JsLibs;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class ContactTemplate2
{
    public $utilsService;
    public $settings;
    public $jsLibs;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();
        $this->jsLibs = new JsLibs();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;


        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors, $id);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors, $id);
        }
        else {
            $obj = $this->setDarkColorStyle($obj, $settings->colors, $id);
        }
        $obj = $this->setJs($obj);

        return $obj;
    }

    public function setJs($obj){

        if(isset($obj->set->getMask)){
            if(strpos($obj->js, '//js_code_contact',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_contact', 'mask(\'[name="phone"]\');');
            }

        }
        else{
            $obj->set->getSliderOfOneItem = true;
            if(strpos($obj->js, '//js_code_contact',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_contact', $this->jsLibs->getJsLib('getMask').'mask(\'[name="phone"]\');');
            }
        }

        return $obj;

    }

    public function setColorsForChildInLightBlock($obj, $colors){
        if(strpos($obj->js, '/*contact_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*contact_h_c*/', 'contactTitle.classList.add("title-light");');

        }
        if(strpos($obj->js, '/*contact_btn_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*contact_btn_c*/', 'contactBtn.classList.add("button-light");');

        }
        if(strpos($obj->style, '/*contact_content_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_content_c*/', 'color: '.$colors->textColor.';');

        }
        if(strpos($obj->style, '/*contact_info_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_info_c*/', 'color: '.$colors->textColor.';');

        }
        if(strpos($obj->style, '/*contact_span_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_span_c*/', 'color: '.$colors->titleColor.';');

        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->js, '/*contact_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*contact_h_c*/', 'contactTitle.classList.add("title-dark");');
        }
        if(strpos($obj->js, '/*contact_btn_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*contact_btn_c*/', 'contactBtn.classList.add("button-dark");');

        }
        if(strpos($obj->style, '/*contact_content_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_content_c*/', 'color: '.$colors->linkColor.';');

        }
        if(strpos($obj->style, '/*contact_info_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_info_c*/', 'color: '.$colors->linkColor.';');

        }
        if(strpos($obj->style, '/*contact_span_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_span_c*/', 'color: '.$colors->anyTextColor.';');

        }
    }


    public function setLightBg($obj, $colors, $id){
        if(strpos($obj->style, '/*contact_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/contact_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: lighten; background-color: rgba(255, 255, 255, .5);');
        }
    }
    public function setDarkBg($obj, $colors, $id){
        if(strpos($obj->style, '/*contact_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/contact_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: darken; background-color: rgba('.$colors->rgbaMainBg.', .65);');
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

                $bgAbout  = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'dark';

                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;

            }
            else{

                $bgAbout  = ['#e4e1ea', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'light';

                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;

            }


        }
        else{
            $bgAbout = [ '#e4e1ea', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            if(strpos($obj->style, '/*contact_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-color: '.$bgAbout[$index].';');
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
            switch ($obj->set->lastSectionColor){
                case $colors->secondBg:{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = ['#e4e1ea', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case '#e4e1ea':{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = ['#e4e1ea', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                default: {
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                }
            }
        }
        else{

            $bgAbout = [ '#e4e1ea', '#f0f1f6',  $colors->secondBg];
            $index = rand(0, 2);
            $bgColor = $bgAbout[$index];


        }


        if(strpos($obj->style, '/*contact_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-color: ' . $bgColor . ';');
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
            switch ($obj->set->lastSectionColor){
                case $colors->mainBg:{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case $colors->thirdBg:{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                case '#555555':{
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                default : {
                    if(strpos($obj->style, '/*contact_bg*/',0)!==false) {

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

        if(strpos($obj->style, '/*contact_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*contact_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;
        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;

    }
}