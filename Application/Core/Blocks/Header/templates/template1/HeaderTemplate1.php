<?php


namespace Application\Core\Blocks\Header\templates\template1;

use Application\Services\UtilsService;

class HeaderTemplate1
{

    public $utilsService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();

    }


    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;



        $obj = $this->setPositionStyle($obj);

        if($obj->set->theme === 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors);
        }
        else if($obj->set->theme === 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $settings->colors);
        }




        return $obj;
    }
    public function setPositionStyle($obj){

        $positions = ['fixed', 'static'];

        $index = rand(0, 1);

        //$refactorSting = 'position: '.$positions[$index].';';

        //$obj->style = $this->utilsService->parseStyle($obj->style, '/*h_pos*/', $refactorSting);
        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg_block*/', '.header_bg{/*h_bg*/}');

        if($index == 0){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed*/', '.header_fixed{position: fixed; z-index: 102;}');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed_bg*/', '.header_fixed_bg{/*h_f_bg*/}');



            $obj->js = $this->utilsService->parseStyle($obj->js, '//header-fixed', "let header = document.querySelector('.header');

    window.addEventListener('scroll', ()=> {

        let top = window.scrollY;

        if(top > 20){
            header.classList.add('header_fixed');
            header.classList.add('header_fixed_bg');
            if(header.classList.contains('h_bg_block')){
                header.classList.remove('h_bg_block');
            }
        }
        else{
            header.classList.add('header_bg');
            if(header.classList.contains('header_fixed')){
                header.classList.remove('header_fixed');
            }
            if(header.classList.contains('header_fixed_bg')){
                header.classList.remove('header_fixed_bg');
            }
        }
    });");
        }
        $obj->set->position = $positions[$index];

        return $obj;
    }
    public function setColorStyle($obj, $colors){

        $variantBg = rand(1, 2);

        switch ($variantBg){
            case '1': {

                    if(strpos($obj->style, '/*h_bg*/',0)!==false){
                        $bgMain = [ $colors->mainBg,  $colors->thirdBg,  $colors->secondBg];
                        $index = rand(0, 2);

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background-color: '.$bgMain[$index].';');

                        if($index < 2){
                            $obj->set->lastSectionColor = 'dark';
                            if($obj->set->position == 'fixed'){

                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_bg*/', 'background-color: rgba(0, 0, 0, .88);');

                            }



                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->linkColor.';');

                            if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #f9fafc;');

                            }
                            if(strpos($obj->style, '/*humb_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->linkColor.';');

                            }
                            if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$bgMain[$index].';');

                            }

                            if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$bgMain[$index].';');

                            }

                            if(strpos($obj->html, '<!--im_l-->',0)!==false){
                                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                            }

                            $obj = $this->setLiStyle($obj, '#f9fafc', $colors->anyTextColor, $colors->thirdColor, $colors->secondBg);


                        }
                        else{


                            $obj->set->lastSectionColor = 'light';
                            if($obj->set->position == 'fixed'){

                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_bg*/', 'background-color: rgba(255, 255, 255, .88);');


                            }

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');

                            if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                            }

                            if(strpos($obj->style, '/*humb_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$bgMain[$index].';');

                            }
                            if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->linkColor.';');

                            }

                            if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->linkColor.';');

                            }


                            if(strpos($obj->html, '<!--im_l-->',0)!==false){
                                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                            }

                            $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, $colors->thirdColor, $colors->secondBg);


                        }
                    }








                return $obj;
            }
            case '2': {

                    if(strpos($obj->style, '/*h_bg*/',0)!==false){
                        $bgMain = [ $colors->mainBg,  $colors->thirdBg,  $colors->secondBg];
                        $index = rand(0, 2);


                        if($index < 2){

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, '.$colors->thirdBg. ' 25%,'.$bgMain[$index].' 25%, '.$bgMain[$index].' 75%,'.$bgMain[$index].' 75%);' );
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->linkColor.';');

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg_block_small*/', '.header_bg{background: '.$bgMain[$index].';}');

                            $obj->set->lastSectionColor = 'dark';

                            if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #f9fafc;');
                            }
                            if(strpos($obj->style, '/*humb_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->linkColor.';');

                            }
                            if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$bgMain[$index].';');

                            }

                            if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$bgMain[$index].';');

                            }
                            if(strpos($obj->html, '<!--im_l-->',0)!==false){
                                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                            }

                            $obj = $this->setLiStyle($obj, '#f9fafc', $colors->anyTextColor, $colors->thirdColor, $colors->secondBg);

                        }
                        else{

                            $obj->set->lastSectionColor = 'light';
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, #f9fafc 25%,'.$colors->secondBg.' 25%, '.$colors->secondBg.' 75%,'.$colors->secondBg.' 75%);' );

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg_block_small*/', '.header_bg{background: '.$bgMain[$index].';}');

                            if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');
                            }

                            if(strpos($obj->style, '/*humb_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$bgMain[$index].';');

                            }

                            if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->linkColor.';');

                            }

                            if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                                $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->linkColor.';');

                            }
                            if(strpos($obj->html, '<!--im_l-->',0)!==false){
                                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                            }

                            $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, $colors->thirdColor, $colors->secondBg);

                        }
                    }




                return $obj;
            }

        }





    }

    public function setLightColorStyle($obj, $colors)
    {
        $variantBg = rand(1, 2);

        switch ($variantBg) {
            case '1':
            {



                    if (strpos($obj->style, '/*h_bg*/', 0) !== false) {

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background-color: ' . $colors->secondBg . ';');

                        $obj->set->lastSectionColor = 'light';

                        if ($this->currentSettings->position == 'fixed') {

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_bg*/', 'background-color: rgba(255, 255, 255, .88);');

                        }

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: ' . $colors->textColor . ';');

                        if (strpos($obj->style, '/*menu_fc*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: ' . $colors->textColor . ';');

                        }

                        if (strpos($obj->style, '/*humb_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: #ffffff;');

                        }
                        if (strpos($obj->style, '/*humb_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: ' . $colors->linkColor . ';');

                        }

                        if (strpos($obj->style, '/*humb_before_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: ' . $colors->linkColor . ';');

                        }


                        if (strpos($obj->html, '<!--im_l-->', 0) !== false) {
                            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                        }

                        $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, $colors->thirdColor, $colors->secondBg);


                    }




                return $obj;
            }
            case '2':
            {



                    if (strpos($obj->style, '/*h_bg*/', 0) !== false) {
                        $bgMain = ['#ffffff', $colors->secondBg];
                        $index = rand(0, 1);
                        $obj->set->lastSectionColor = 'light';

                        if ($index < 1) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, ' . $colors->secondBg . ' 25%,' . $bgMain[$index] . ' 25%, ' . $bgMain[$index] . ' 75%,' . $bgMain[$index] . ' 75%);');

                        } else {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, ' . $bgMain[$index] . ' 25%,' . $colors->secondBg . ' 25%, ' . $colors->secondBg . ' 75%,' . $colors->secondBg . ' 75%);');
                        }

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: ' . $colors->textColor . ';');

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg_block_small*/', '.header_bg{background: ' . $bgMain[$index] . ';}');

                        if (strpos($obj->style, '/*menu_fc*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: ' . $colors->textColor . ';');
                        }

                        if (strpos($obj->style, '/*humb_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: ' . $bgMain[$index] . ';');

                        }
                        if (strpos($obj->style, '/*humb_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: ' . $colors->linkColor . ';');

                        }

                        if (strpos($obj->style, '/*humb_before_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: ' . $colors->linkColor . ';');

                        }
                        if (strpos($obj->html, '<!--im_l-->', 0) !== false) {
                            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                        }

                        $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, $colors->thirdColor, $colors->secondBg);


                    }



                return $obj;
            }
        }
    }
    public function setDarkColorStyle($obj, $colors)
    {
        $variantBg = rand(1, 2);

        switch ($variantBg) {
            case '1':
            {



                    if (strpos($obj->style, '/*h_bg*/', 0) !== false) {
                        $bgMain = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background-color: ' . $bgMain[$index] . ';');


                        $obj->set->lastSectionColor = 'dark';
                        if ($this->currentSettings->position == 'fixed') {

                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_bg*/', 'background-color: rgba(0, 0, 0, .88);');

                        }


                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: ' . $colors->linkColor . ';');

                        if (strpos($obj->style, '/*menu_fc*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #f9fafc;');

                        }
                        if (strpos($obj->style, '/*humb_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: ' . $colors->linkColor . ';');

                        }
                        if (strpos($obj->style, '/*humb_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: ' . $bgMain[$index] . ';');

                        }

                        if (strpos($obj->style, '/*humb_before_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: ' . $bgMain[$index] . ';');

                        }

                        if (strpos($obj->html, '<!--im_l-->', 0) !== false) {
                            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                        }

                        $obj = $this->setLiStyle($obj, '#f9fafc', $colors->anyTextColor, $colors->thirdColor, $colors->secondBg);


                    }



                return $obj;
            }
            case '2':
            {



                    if (strpos($obj->style, '/*h_bg*/', 0) !== false) {
                        $bgMain = [$colors->mainBg, $colors->thirdBg];
                        $index = rand(0, 1);

                        $obj->set->lastSectionColor = 'dark';
                        if ($index < 1) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, ' . $colors->thirdBg . ' 25%,' . $bgMain[$index] . ' 25%, ' . $bgMain[$index] . ' 75%,' . $bgMain[$index] . ' 75%);');

                        } else {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg*/', 'background: linear-gradient(to right, ' . $bgMain[$index] . ' 25%,' . $colors->thirdBg . ' 25%, ' . $colors->thirdBg . ' 75%,' . $colors->thirdBg . ' 75%);');
                        }

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: ' . $colors->linkColor . ';');

                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_bg_block_small*/', '.header_bg{background: ' . $bgMain[$index] . ';}');


                        if (strpos($obj->style, '/*menu_fc*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #f9fafc;');
                        }
                        if (strpos($obj->style, '/*humb_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: ' . $colors->linkColor . ';');

                        }
                        if (strpos($obj->style, '/*humb_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: ' . $bgMain[$index] . ';');

                        }

                        if (strpos($obj->style, '/*humb_before_span_color*/', 0) !== false) {
                            $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: ' . $bgMain[$index] . ';');

                        }
                        if (strpos($obj->html, '<!--im_l-->', 0) !== false) {
                            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                        }

                        $obj = $this->setLiStyle($obj, '#f9fafc', $colors->anyTextColor, $colors->thirdColor, $colors->secondBg);


                    }



                return $obj;
            }
        }
    }
    public function setLiStyle($obj, $liColor, $hoverColor, $bgColor, $colorActive){
        $variantLi = rand(1, 6);

        switch ($variantLi){
            case 1:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                position: relative;
                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 30px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                            
                                                                                            }
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$hoverColor.';
                                                                                            }');
                }
                break;
            }
            case 2:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                padding:0 12px 0 12px;
                                                                                                border-right: 1px solid '.$hoverColor.';
                                                                                            position: relative;
                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 30px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                                border: none;
                                                                                                padding: 0;
                                                                                            
                                                                                            }
                                                                                            
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            .menu ul li:last-child{
                                                                                                padding-right: 0px;
                                                                                                border: none;
                                                                                            }
                                                                                            .menu ul li:first-child{
                                                                                                padding-left: 0px;
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$hoverColor.';
                                                                                            }');
                }
                break;
            }
            case 3:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                position: relative;
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                margin-bottom: 0;
                                                                                                position: relative;
                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 30px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                            
                                                                                            }
                                                                                           
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            .menu ul li:before{
                                                                                                position: absolute;
                                                                                                content: "";
                                                                                                width: 0;
                                                                                                height: 2px;
                                                                                                background-color: '.$hoverColor.';
                                                                                                top: 0;
                                                                                                left: 0;
                                                                                                transition: all .5s ease;
                                                                                            }
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li:hover:before{
                                                                                                    width: 100%;
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$hoverColor.';
                                                                                            }');
                }
                break;
            }
            case 4:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                position: relative;
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                position: relative;
                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 20px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                            
                                                                                            }
                                                                                            
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            .menu ul li:after{
                                                                                                position: absolute;
                                                                                                content: "";
                                                                                                width: 0;
                                                                                                height: 2px;
                                                                                                background-color: '.$hoverColor.';
                                                                                                bottom: 0;
                                                                                                left: 0;
                                                                                                transition: all .5s ease;
                                                                                            }
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li:hover:after{
                                                                                                    width: 100%;
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$colorActive.';
                                                                                            }');
                }
                break;
            }
            case 5:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                position: relative;
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                padding: 5px 10px;
                                                                                                background-color: transparent;
                                                                                                transition: all .3s ease;

                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 30px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                            
                                                                                            }
                                                                                            
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li:hover{
                                                                                                background-color: '.$bgColor.';
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                color: '.$colorActive.';
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$colorActive.';
                                                                                            }');
                }
                break;
            }
            case 6:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                position: relative;
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                padding: 5px 10px;
                                                                                                background-color: transparent;
                                                                                                transition: all .3s ease;
                                                                                                border-radius: 5px;
position: relative;
                                                                                               
                                                                                            
                                                                                            }
                                                                                            .menu ul li ul{
                                                                                                width: 200px;
                                                                                                position: absolute;
                                                                                                opacity: 0;
                                                                                                top: 30px;
                                                                                                left: -100px;
                                                                                                padding: 20px;
                                                                                                background-color: '.$colorActive.';
                                                                                                color: '.$hoverColor.';
                                                                                                transition: all 0.3s ease;
                                                                                                z-index: 2000;
                                                                                                display: none;
                                                                                            }
                                                                                            .menu ul li ul::before{
                                                                                                    content: "";
                                                                                                    position: absolute;
                                                                                                    left: 120px;
                                                                                                    top: -20px;
                                                                                                    border: 10px solid transparent;
                                                                                                    border-bottom: 10px solid '.$colorActive.';
                                                                                                  }
                                                                                            .menu ul li ul li{
                                                                                                display: block;
                                                                                                margin-bottom: 15px;
                                                                                                text-align: left;
                                                                                            
                                                                                            }
                                                                                            
                                                                                            .menu ul li, .menu ul li ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }
                                                                                            .menu ul li:hover>ul,
                                                                                            .menu ul li:focus-within>ul,
                                                                                            .menu ul li ul:hover{
                                                                                                opacity: 1;
                                                                                                display: block;
                                                                                            }
                                                                                            
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li:hover{
                                                                                                background-color: '.$bgColor.';
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                color: '.$colorActive.';
                                                                                            }
                                                                                            .menu li a.active{
                                                                                                color: '.$colorActive.';
                                                                                            }');
                }
                break;
            }



        }
        return $obj;
    }
}