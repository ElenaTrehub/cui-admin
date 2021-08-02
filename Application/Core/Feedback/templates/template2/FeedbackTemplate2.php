<?php


namespace Application\Core\Feedback\templates\template2;


use Application\Core\JsLibs\JsLibs;
use Application\Services\UtilsService;

class FeedbackTemplate2
{
    public $utilsService;
    public $jsLibs;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->jsLibs = new JsLibs();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $colors, $set){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $set;



        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $colors);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $colors);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $colors);
        }
        $obj = $this->setJs($obj);

        return $obj;
    }

    public function setColorsForChildInLightBlock($obj, $colors){
        if(strpos($obj->js, '/*feedback_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*feedback_h_c*/', 'feedbackTitle.classList.add("title-light");');
        }
        if(strpos($obj->style, '/*f_text_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_bg*/', 'background-color: '.$colors->thirdBg.';');
        }
        if(strpos($obj->style, '/*f_text_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_border*/', 'border-top: 10px solid'.$colors->thirdBg.';');
        }
        if(strpos($obj->style, '/*feed_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_t_c*/', 'color: '.$colors->linkColor.';');
        }
        if(strpos($obj->style, '/*feed_s_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_s_c*/', 'color: '.$colors->titleColor.';');
        }
        if(strpos($obj->style, '/*feed_btn_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_btn_c*/', 'color: '.$colors->titleColor.';');
        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->js, '/*feedback_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*feedback_h_c*/', 'feedbackTitle.classList.add("title-dark");');
        }
        if(strpos($obj->style, '/*f_text_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_bg*/', 'background-color: #ffffff;');
        }
        if(strpos($obj->style, '/*f_text_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_border*/', 'border-top: 10px solid #ffffff;');
        }
        if(strpos($obj->style, '/*feed_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_t_c*/', 'color: '.$colors->textColor.';');
        }
        if(strpos($obj->style, '/*feed_s_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_s_c*/', 'color: '.$colors->anyTextColor.';');
        }
        if(strpos($obj->style, '/*feed_btn_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_btn_c*/', 'color: '.$colors->linkColor.';');
        }
    }

    public function setJs($obj){

        if(isset($obj->set->getSliderOfThreeItems)){
            if(strpos($obj->js, '//js_code_feedback',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_feedback', 'slidesThreeSlider(".feedback-slider-item", ".feedback-wrapper", ".feedback-slider", ".feedback-prev-btn", ".feedback-next-btn");');
            }
        }
        else{
            $obj->set->getSliderOfThreeItems = true;
            if(strpos($obj->js, '//js_code_feedback',0)!==false){
                $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_feedback', $this->jsLibs->getJsLib('getSliderOfThreeItems').'slidesThreeSlider(".feedback-slider-item", ".feedback-wrapper", ".feedback-slider", ".feedback-prev-btn", ".feedback-next-btn");');
            }
        }

        return $obj;

    }


    public function setColorStyle($obj, $colors){


        if(isset($obj->set->lastSectionColor)){

            if($obj->set->lastSectionColor === 'light'){

                $bgFeature = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'dark';

                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;
            }

            else{
                $bgFeature = ['#ffffff', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'light';

                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;
            }

        }
        else{


            $bgFeature = [ '#ffffff', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_bg*/', 'background-color: '.$bgFeature[$index].';');

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
    public function setLightColorStyle($obj, $colors){


        $bgColor = '';

        if(isset($obj->set->lastSectionColor)){
            $colorStr = $obj->set->lastSectionColor;
            switch ($colorStr){
                case "$colors->secondBg":{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default: {

                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

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
        if(strpos($obj->style, '/*feed_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInLightBlock($obj, $colors);


        return $obj;


    }


    public function setDarkColorStyle($obj, $colors){

        $bgColor = '';

        if(isset($obj->set->lastSectionColor)){
            $colorStr = $obj->set->lastSectionColor;
            switch ($colorStr){
                case "$colors->mainBg":{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }

                    break;
                }
                case "$colors->thirdBg":{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#555555':{
                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default : {

                    if(strpos($obj->style, '/*feed_bg*/',0)!==false) {

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

        if(strpos($obj->style, '/*feed_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*feed_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;


    }


}