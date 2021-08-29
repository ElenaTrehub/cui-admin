<?php


namespace Application\Core\Blocks\Feature\templates\template3;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class FeatureTemplate3
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
        $obj->set = $settings;

        $obj = $this->setFontStyle($obj, $settings->fonts);

        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors, $id);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors, $id);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $settings->colors, $id);
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
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*border_item*/', 'border: 1px solid rgba('.$colors->rgbaThirdBg.', 0.2);');
        }
        if(strpos($obj->style, '/*t_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_border*/', 'border-bottom: 1px solid rgba('.$colors->rgbaThirdBg.', 0.2);');
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
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_text_c*/', 'color: #ffffff;');
        }
        if(strpos($obj->style, '/*n_f_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*n_f_c*/', 'color: '.$colors->secondBg.';');
        }
        if(strpos($obj->style, '/*bg_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*bg_item*/', 'background-color: rgba(255, 255, 255, 0.1);');
        }
        if(strpos($obj->style, '/*border_item*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*border_item*/', 'border: 1px solid rgba('.$colors->rgbaSecondBg.', 0.2);');
        }
        if(strpos($obj->style, '/*t_border*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_border*/', 'border-bottom: 1px solid rgba('.$colors->rgbaSecondBg.', 0.2);');
        }
    }

    public function setLightBg($obj, $colors, $id){
        if(strpos($obj->style, '/*f_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/feature_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: lighten; background-color: rgba(255, 255, 255, .5);');
        }
    }
    public function setDarkBg($obj, $colors, $id){
        if(strpos($obj->style, '/*f_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*f_bg*/', 'background-image: url("../images/'.$this->settings->getPhotoFolderName($id).'/feature_bg.jpg"); background-repeat: no-repeat; background-size: cover; background-position: center center; background-blend-mode: darken; background-color: rgba('.$colors->rgbaMainBg.', .65);');
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
    public function setLightColorStyle($obj, $colors, $id){

        if($obj->set->withBg === 'withBg'){
            if(isset($obj->set->lastSectionWithBg)){
                if($obj->set->lastSectionWithBg !== true){

                    $this->setLightBg($obj, $colors, $id);

                    $obj->set->lastSectionColor = '#ffffff';
                    $obj->set->lastSectionWithBg = true;
                    $this->setColorsForChildInLightBlock($obj, $colors);
                    return $obj;
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