<?php


namespace Application\Core\Header\templates\template2;


use Application\Services\UtilsService;

class HeaderTemplate2
{

    public $utilsService;
    public $currentSettings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->currentSettings = new \stdClass();
    }


    public function setUniqueStyle($styleString, $htmlString, $jsString, $colors, $theme){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;


        $this->currentSettings->theme = $theme;

        $obj = $this->setPositionStyle($obj);

        if($this->currentSettings->theme === 'normal'){
            $obj = $this->setColorStyle($obj, $colors);
        }
        else if($this->currentSettings->theme === 'light'){
            $obj = $this->setLightColorStyle($obj, $colors);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $colors);
        }

        $obj = $this->setFlexStyle($obj);
        $obj->set = $this->currentSettings;
        return $obj;
    }
    public function setPositionStyle($obj){

        $positions = ['fixed', 'static'];

        $index = rand(0, 1);

        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg_block*/', '.header_main_bg_block{/*h_m_bg*/}');
        $obj->js = $this->utilsService->parseStyle($obj->js, '//header', "let header_main = document.querySelector('.header_main');
    header_main.classList.add('header_main_bg_block');");
        if($index == 0){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed*/', '.header_fixed{position: fixed; z-index: 102;}');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed_top*/', '.header_fixed_top{display: none;}');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed_main_bg*/', '.header_fixed_main_bg{/*h_f_main_bg*/}');


            $obj->js = $this->utilsService->parseStyle($obj->js, '//hfixed', "let header = document.querySelector('.header');

    let header_top = document.querySelector('.header_top');
    
    window.addEventListener('scroll', ()=> {


        let top = window.scrollY;

        if(top > 20){
            header.classList.add('header_fixed');
            header_top.classList.add('header_fixed_top');
            header_main.classList.add('header_fixed_main_bg');
            if(header_main.classList.contains('header_main_bg_block')){
                header_main.classList.remove('header_main_bg_block');
            }
        }
        else{
            header_main.classList.add('header_main_bg_block');
            if(header.classList.contains('header_fixed')){
                header.classList.remove('header_fixed');
            }
            if(header_main.classList.contains('header_fixed_main_bg')){
                header_main.classList.remove('header_fixed_main_bg');
            }
            if(header_top.classList.contains('header_fixed_top')){
                header_top.classList.remove('header_fixed_top');
            }
        }
    });");
        }
        $this->currentSettings->position = $positions[$index];
//print_r($obj);
        return $obj;
    }
    public function setColorStyle($obj, $colors){


        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
                $bgMain = [ $colors->mainBg,  $colors->thirdBg,  $colors->secondBg];
                $index = rand(0, 2);

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');

                if($index < 2){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->linkColor.';');


                    $bgMain = [ $colors->secondBg, '#fcfcfc'];
                    $index = rand(0, 1);

                    if($this->currentSettings->position == 'fixed'){

                        //$index = rand(0, 1);

                        //if($index == 0){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .88);');
                        //}

                    }
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$bgMain[$index].';');
                    $this->currentSettings->lastSectionColor = 'light';
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                    if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                    }
                    if(strpos($obj->style, '/*humb_color*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->MainBg.';');

                    }
                    if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$bgMain[$index].';');

                    }

                    if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$bgMain[$index].';');

                    }

                    if(strpos($obj->html, '<!--im_l-->',0)!==false){
                        $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                    }

                    $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor);


                }
                else{

                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->textColor.';');

                    $bgMain = [ $colors->mainBg,  $colors->thirdBg];
                    $index = rand(0, 1);

                    if($this->currentSettings->position == 'fixed'){

                        //$index = rand(0, 1);

                        //if($index == 0){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .854);');
                        //}

                    }
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$bgMain[$index].';');
                    $this->currentSettings->lastSectionColor = 'dark';
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->linkColor.';');


                    if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->linkColor.';');

                    }
                    if(strpos($obj->style, '/*humb_color*/',0)!==false){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->secondBg.';');

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

                    $obj = $this->setLiStyle($obj, $colors->linkColor, $colors->anyTextColor);


                }
            }


        return $obj;

    }
    public function setLightColorStyle($obj, $colors){


        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
            $bgMain = [ '#fcfcfc', $colors->secondBg];
            $index = rand(0, 1);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');
            $this->currentSettings->lastSectionColor = 'light';
            if($index < 1){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->mainBg.';');




                if($this->currentSettings->position == 'fixed'){

                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .88);');
                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->secondBg.';');

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: #ffffff;');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->thirdBg.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->thirdBg.';');

                }

                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                }

                $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor);


            }
            else{

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->textColor.';');


                if($this->currentSettings->position == 'fixed'){


                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .854);');


                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: #ffffff;');

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->mainBg.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->mainBg.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->thirdBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: #ffffff;');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: #ffffff;');

                }

                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="">');
                }

                $obj = $this->setLiStyle($obj, $colors->linkColor, $colors->anyTextColor);


            }
        }


        return $obj;

    }
    public function setDarkColorStyle($obj, $colors){


        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
            $bgMain = [ $colors->mainBg,  $colors->thirdBg];
            $index = rand(0, 1);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');

            if($index < 1){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->linkColor.';');

                if($this->currentSettings->position == 'fixed'){

                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .88);');

                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->thirdBg.';');
                $this->currentSettings->lastSectionColor = 'light';
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: #ffffff;');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #ffffff;');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->secondBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->mainBg.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->mainBg.';');

                }

                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                }

                $obj = $this->setLiStyle($obj, '#ffffff', $colors->secondBg);


            }
            else{

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: #ffffff;');

                if($this->currentSettings->position == 'fixed'){

                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .854);');

                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->mainBg.';');
                $this->currentSettings->lastSectionColor = 'dark';
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: #ffffff;');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: #ffffff;');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'color: '.$colors->thirdBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: #ffffff;');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: #ffffff;');

                }

                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="">');
                }

                $obj = $this->setLiStyle($obj, '#ffffff', $colors->secondBg);


            }
        }


        return $obj;

    }

    public function setFlexStyle($obj)
    {

        if (strpos($obj->style, '/*t_2*/', 0) !== false) {
            $flex = ['flex-end', 'flex-start', 'space-between'];
            $index = rand(0, 2);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_j*/', 'justify-content: ' . $flex[$index] . ';');




        }
        else {
            $flex = ['flex-end', 'flex-start'];
            $index = rand(0, 1);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_j*/', 'justify-content: ' . $flex[$index] . ';');
        }

        return $obj;

    }
    public function setLiStyle($obj, $liColor, $hoverColor){
        $variantLi = rand(1, 4);

        switch ($variantLi){
            case 1:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-right: 25px;
                                                                                                margin-top: 12px;
                                                                                            
                                                                                            }
                                                                                            .menu ul li:last-child{
                                                                                                margin-right: 0px;
                                                                                            }
                                                                                            .menu ul li:hover a{
                                                                                                color: '.$hoverColor.';
                                                                                                text-decoration: none;
                                                                                            }');
                }
                break;
            }
            case 2:{
                if(strpos($obj->style, '/*menu_li*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_li*/', '.menu ul li{
                                                                                                display: inline-block;
                                                                                                list-style-type: none;
                                                                                                margin-top: 12px;
                                                                                                padding:0 12px 0 12px;
                                                                                                border-right: 1px solid '.$hoverColor.'
                                                                                            
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
                                                                                                padding-top: 4px;
                                                                                                margin-bottom: 0;
                                                                                            
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
                                                                                                padding-bottom: 4px;
                                                                                                margin-top: 8px;
                                                                                            
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
                                                                                            }');
                }
                break;
            }




        }
        return $obj;
    }
}