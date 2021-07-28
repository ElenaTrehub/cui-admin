<?php


namespace Application\Core\Feature\templates\template3;


use Application\Services\UtilsService;

class FeatureTemplate3
{
    public $utilsService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $colors, $fonts, $set){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $set;

        $obj = $this->setFontStyle($obj, $fonts);

        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $colors);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $colors);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $colors);
        }


        return $obj;
    }

    public function setFontStyle($obj, $fonts){
        if(strpos($obj->style, '/*f_z_fit*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_z_fit*/', 'font-size:'.$fonts->textSize.';');

        }
        if(strpos($obj->style, '/*n_fz_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*n_fz_c*/', 'font-size:'.$fonts->bigSize.';');

        }
        if(strpos($obj->style, '/*f_text_fz*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_fz*/', 'font-size:'.$fonts->linkSize.';');

        }

        return $obj;
    }


    public function setColorsForChildInLightBlock($obj, $colors){
        if(strpos($obj->js, '/*feature_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*feature_h_c*/', 'featureTitle.classList.add("title-light");');
        }
        if(strpos($obj->style, '/*f_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_t_c*/', 'color: '.$colors->textColor.';');
        }
        if(strpos($obj->style, '/*f_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_c*/', 'color: '.$colors->textColor.';');
        }
        if(strpos($obj->style, '/*n_f_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*n_f_c*/', 'color: '.$colors->thirdBg.';');
        }
        if(strpos($obj->style, '/*bg_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*bg_item*/', 'background-color: rgba(255, 255, 255, 0.3);');
        }
        if(strpos($obj->style, '/*border_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*border_item*/', 'border: 1px solid rgba(80, 80, 80, 0.2);');
        }
        if(strpos($obj->style, '/*t_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_border*/', 'border-bottom: 1px solid rgba(80, 80, 80, 0.2);');
        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->js, '/*feature_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*feature_h_c*/', 'featureTitle.classList.add("title-dark");');
        }
        if(strpos($obj->style, '/*f_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_t_c*/', 'color: '.$colors->linkColor.';');
        }

        if(strpos($obj->style, '/*f_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_c*/', 'color: '.$colors->linkColor.';');
        }
        if(strpos($obj->style, '/*n_f_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*n_f_c*/', 'color: '.$colors->secondBg.';');
        }
        if(strpos($obj->style, '/*bg_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*bg_item*/', 'background-color: rgba(255, 255, 255, 0.1);');
        }
        if(strpos($obj->style, '/*border_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*border_item*/', 'border: 1px solid rgba(255, 255, 255, 0.1);');
        }
        if(strpos($obj->style, '/*t_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_border*/', 'border-bottom: 1px solid rgba(255, 255, 255, 0.1);');
        }
    }




    public function setColorStyle($obj, $colors){


        if(isset($obj->set->lastSectionColor)){

            if($obj->set->lastSectionColor === 'light'){

                $bgFeature = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'dark';

                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;
            }

            else{
                $bgFeature = ['#ffffff', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-color: '.$bgFeature[$index].';');

                $obj->set->lastSectionColor = 'light';

                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;
            }

        }
        else{


            $bgFeature = [ '#ffffff', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-color: '.$bgFeature[$index].';');

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
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default: {

                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

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
        if(strpos($obj->style, '/*f_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-color: ' . $bgColor . ';');
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
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                    }

                    break;
                }
                case "$colors->thirdBg":{
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                case '#555555':{
                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                    }
                    break;

                }
                default : {

                    if(strpos($obj->style, '/*f_bg*/',0)!==false) {

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

        if(strpos($obj->style, '/*f_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;




    }
}