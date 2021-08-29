<?php


namespace Application\Core\Blocks\Footer\templates\template1;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class FooterTemplate1
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

    public function setColorsForChildInLightBlock($obj, $colors){
        if(strpos($obj->html, '<!--im_footer_logo-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_footer_logo-->', '<img src="../images/light-logo.png" alt="">');
        }
        if(strpos($obj->style, '/*footer_top_title_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_title_c*/', 'color: '.$colors->titleColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_c*/', 'color: '.$colors->textColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_active_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_active_c*/', 'color: '.$colors->titleColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_hover_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_hover_c*/', 'color: '.$colors->titleColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_hover_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_hover_c*/', 'color: '.$colors->titleColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_c*/', 'color: '.$colors->textColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_fas_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_fas_c*/', 'color: '.$colors->titleColor.';');

        }
        if(strpos($obj->style, '/*footer_bottom_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_text_c*/', 'color: '.$colors->textColor.';');

        }
    }

    public function setColorsForChildInDarkBlock($obj, $colors){
        if(strpos($obj->html, '<!--im_footer_logo-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_footer_logo-->', '<img src="../images/black-logo.png" alt="">');
        }
        if(strpos($obj->style, '/*footer_top_title_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_title_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_c*/', 'color: '.$colors->linkColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_active_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_active_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*footer_top_li_hover_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_li_hover_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_hover_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_hover_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_c*/', 'color: '.$colors->linkColor.';');

        }
        if(strpos($obj->style, '/*footer_top_info_fas_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_info_fas_c*/', 'color: '.$colors->anyTextColor.';');

        }
        if(strpos($obj->style, '/*footer_bottom_text_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_text_c*/', 'color: '.$colors->linkColor.';');

        }
    }


    public function setColorStyle($obj, $colors){

        if(isset($obj->set->lastSectionColor)){

            if($obj->set->lastSectionColor === 'light'){

                $bgAbout  = [$colors->thirdBg, '#555555', $colors->mainBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'dark';

                $bgColor = '';
                switch ($bgAbout[$index]){
                    case $colors->thirdBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case '#555555':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = [$colors->thirdBg, $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case $colors->mainBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->thirdBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    default: {
                        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                    }



                }

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgColor . ';');



                $this->setColorsForChildInDarkBlock($obj, $colors);

                return $obj;

            }
            else{

                $bgAbout  = ['#f2f3f4', '#f0f1f6', $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
                $obj->set->lastSectionColor = 'light';

                $bgColor = '';
                switch ($bgAbout[$index]){
                    case '#ffffff':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f0f1f6', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case '#f0f1f6':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f2f3f4', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case $colors->secondBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f2f3f4', '#f0f1f6'];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    default: {
                        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                            $bgAbout  = ['#f0f1f6', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                    }



                }

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgColor . ';');


                $this->setColorsForChildInLightBlock($obj, $colors);

                return $obj;

            }


        }
        else{
            $bgAbout = [ '#f2f3f4', '#f0f1f6',  $colors->secondBg, $colors->thirdBg, '#555555', $colors->mainBg];
            $index = rand(0, 5);

            if(strpos($obj->style, '/*footer_top_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_bg*/', 'background-color: ' . $bgAbout[$index] . ';');
            }

            if($index < 3){

                $bgColor = '';
                switch ($bgAbout[$index]){
                    case '#f2f3f4':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f0f1f6', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case '#f0f1f6':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f2f3f4', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case $colors->secondBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#f2f3f4', '#f0f1f6'];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    default: {
                        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                            $bgAbout  = ['#f0f1f6', $colors->secondBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                    }



                }

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgColor . ';');


                $this->setColorsForChildInLightBlock($obj, $colors);

                $obj->set->lastSectionColor = 'light';
            }
            else{

                $bgColor = '';
                switch ($bgAbout[$index]){
                    case $colors->thirdBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case '#555555':{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = [$colors->thirdBg, $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    case $colors->mainBg:{
                        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->thirdBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                        break;

                    }
                    default: {
                        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                            $bgAbout  = ['#555555', $colors->mainBg];
                            $index = rand(0, 1);

                            $bgColor = $bgAbout[$index];


                        }
                    }



                }

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgColor . ';');

                $this->setColorsForChildInDarkBlock($obj, $colors);

                $obj->set->lastSectionColor = 'dark';
            }

            return $obj;
        }



    }

    public function setLightColorStyle($obj, $colors){
        $bgColor = '';
        $bgBottomBg = '';
        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->secondBg:{
                    if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                        $bgAbout  = ['#f2f3f4', '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];

                        $bgBottomBg = $colors->secondBg;


                    }
                    break;

                }
                case '#ffffff':{
                    if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = '#888888';

                    }
                    break;

                }
                case '#f0f1f6':{
                    if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                        $bgAbout  = ['#f2f3f4', $colors->secondBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = '#f0f1f6';

                    }
                    break;

                }
                default: {
                    if(strpos($obj->style, '/*footer_top_bg*/',0)!==false) {

                        $bgAbout  = [$colors->secondBg, '#f0f1f6'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = '#888888';

                    }
                }
            }
        }
        else{

            $bgAbout = [ '#f2f3f4', '#f0f1f6',  $colors->secondBg];
            $index = rand(0, 2);
            $bgColor = $bgAbout[$index];

            if($index < 1){
                $bgBottomBg = $bgAbout[$index+1];
            }
            else{
                $bgBottomBg = $bgAbout[$index-1];
            }

        }


        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_bg*/', 'background-color: ' . $bgColor . ';');
        }
        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgBottomBg . ';');
        }
        $obj->set->lastSectionColor = $bgColor;


        $this->setColorsForChildInLightBlock($obj, $colors);


        return $obj;

    }
    public function setDarkColorStyle($obj, $colors){
        $bgColor = '';
        $bgBottomBg = '';
        if(isset($obj->set->lastSectionColor)){
            switch ($obj->set->lastSectionColor){
                case $colors->mainBg:{
                    if(strpos($obj->style, '/*footer_top_bg*',0)!==false) {

                        $bgAbout  = [$colors->thirdBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = $colors->mainBg;

                    }
                    break;

                }
                case $colors->thirdBg:{
                    if(strpos($obj->style, '/*footer_top_bg*',0)!==false) {

                        $bgAbout  = [$colors->mainBg, '#555555'];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = $colors->thirdBg;

                    }

                    break;
                }
                case '#555555':{
                    if(strpos($obj->style, '/*footer_top_bg*',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = '#555555';

                    }

                    break;
                }
                default : {
                    if(strpos($obj->style, '/*footer_top_bg*',0)!==false) {

                        $bgAbout  = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $bgColor = $bgAbout[$index];
                        $bgBottomBg = '#555555';

                    }
                }


            }
        }
        else{
            $bgAbout = [ $colors->mainBg,  $colors->thirdBg, '#555555'];
            $index = rand(0, 2);

            $bgColor = $bgAbout[$index];

            if($index < 1){
                $bgBottomBg = $bgAbout[$index+1];
            }
            else{
                $bgBottomBg = $bgAbout[$index-1];
            }
        }

        if(strpos($obj->style, '/*footer_top_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_top_bg*/', 'background-color: ' . $bgColor . ';');
        }
        if(strpos($obj->style, '/*footer_bottom_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*footer_bottom_bg*/', 'background-color: ' . $bgBottomBg . ';');
        }
        $obj->set->lastSectionColor = $bgColor;
        $this->setColorsForChildInDarkBlock($obj, $colors);


        return $obj;

    }
}