<?php


namespace Application\Core\Blocks\About\templates\template2;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class AboutTemplate2
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

        $obj = $this->setPhoto($obj, $id);

        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors, $settings->fonts);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors, $settings->fonts);
        }
        else {
            $obj = $this->setDarkColorStyle($obj, $settings->colors, $settings->fonts);
        }


        return $obj;
    }

    public function setPhoto($obj, $id){
        if(strpos($obj->html, '<!--im_about-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_about-->', '<img class="about-img" src="../images/'.$this->settings->getPhotoFolderName($id).'/about.jpg" alt="about">');
        }
        return $obj;
    }

    public function setColorsForChildInLightBlock($obj, $colors, $fonts){
        if(strpos($obj->js, '/*a_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*a_h_c*/', 'aboutTitle.classList.add("title-light");');

        }

        if(strpos($obj->style, '/*a_h3_fz*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_h3_fz*/', 'font-size:'.$fonts->textSize.';');

        }
        if(strpos($obj->style, '/*a_h2_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_h2_c*/', 'color:'.$colors->anyTextColor.';');

        }

        if(strpos($obj->style, '/*a_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_t_c*/', 'color: '.$colors->textColor.';');

        }

        if(strpos($obj->style, '/*a_f_b_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_f_b_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*a_l_b_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_l_b_c*/', 'color: '.$colors->anyTextColor.';');

        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors, $fonts){
        if(strpos($obj->js, '/*a_h_c*/',0)!==false){
            $obj->js = $this->utilsService->parseStyle($obj->js, '/*a_h_c*/', 'aboutTitle.classList.add("title-dark");');

        }
        if(strpos($obj->style, '/*a_h3_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_h3_c*/', 'color:'.$colors->linkColor.';');

        }

        if(strpos($obj->style, '/*a_h2_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_h2_c*/', 'color:'.$colors->anyTextColor.';');

        }

        if(strpos($obj->style, '/*a_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_t_c*/', 'color: #ffffff;');

        }

        if(strpos($obj->style, '/*a_f_b_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_f_b_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*a_l_b_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_l_b_c*/', 'color: '.$colors->anyTextColor.';');

        }
    }




    public function setColorStyle($obj, $colors, $fonts){


        if(isset($obj->set->lastSectionColor)) {

            if ($obj->set->lastSectionColor === 'light') {

                $bgAbout  = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->set->lastSectionColor = 'dark';

                if(strpos($obj->style, '/*a_bg*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_bg*/', 'background-color: '.$bgAbout[$index].';');
                }

                $this->setColorsForChildInDarkBlock($obj, $colors, $fonts);

            }
            else{
                $bgAbout = [ '#ffffff', '#f0f1f6',  $colors->secondBg];
                $index = rand(0, 2);


                $obj->set->lastSectionColor = 'light';


                if(strpos($obj->style, '/*a_bg*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_bg*/', 'background-color: '.$bgAbout[$index].';');
                }

                $this->setColorsForChildInLightBlock($obj, $colors, $fonts);

            }
        }
        else{

            $bgAbout = [ '#ffffff', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            if(strpos($obj->style, '/*a_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_bg*/', 'background-color: '.$bgAbout[$index].';');
            }

            if($index < 3){
                $this->setColorsForChildInLightBlock($obj, $colors, $fonts);
                $obj->set->lastSectionColor = 'light';
            }
            else{

                $this->setColorsForChildInDarkBlock($obj, $colors, $fonts);
                $obj->set->lastSectionColor = 'dark';

            }

        }

        return $obj;

    }

    public function setLightColorStyle($obj, $colors, $fonts){
        $bgColor = '';

        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->secondBg:{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;


                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = ['#ffffff', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }
                    break;

                }
                default: {
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
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

        if(strpos($obj->style, '/*a_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;

        $this->setColorsForChildInLightBlock($obj, $colors, $fonts);

        return $obj;

    }
    public function setDarkColorStyle($obj, $colors, $fonts){
        $bgColor = '';
        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->mainBg:{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                case $colors->thirdBg:{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                case '#555555':{
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];


                    }

                    break;
                }
                default : {
                    if(strpos($obj->style, '/*a_bg*/',0)!==false) {

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
        if(strpos($obj->style, '/*a_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*a_bg*/', 'background-color: ' . $bgColor . ';');
        }
        $obj->set->lastSectionColor = $bgColor;
        $this->setColorsForChildInDarkBlock($obj, $colors, $fonts);


        return $obj;

    }


}