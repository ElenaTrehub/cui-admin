<?php


namespace Application\Core\Blocks\Header\templates\template3;


use Application\Services\UtilsService;

class HeaderTemplate3
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
        $obj->libs = '';
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

        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg_block*/', '.header_main_bg_block{/*h_m_bg*/}');
        $obj->js = $this->utilsService->parseStyle($obj->js, '//header', "let header_main = document.querySelector('.header_main');
    header_main.classList.add('header_main_bg_block');");
        if($index == 0){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed*/', '.header_fixed{position: fixed; z-index: 102;}');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed_top*/', '.header_fixed_top{display: none;!important}');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_fixed_main_bg*/', '.header_fixed_main_bg{/*h_f_main_bg*/}');


            $obj->js = $this->utilsService->parseStyle($obj->js, '//hfixed', "let header = document.querySelector('.header');

    let header_top = document.querySelector('.header_top');
    
    window.addEventListener('scroll', ()=> {

    if(header_top && header_main){
    let top = window.scrollY;

        if(top > 20){
            header.classList.add('header_fixed');
            header_top.classList.add('header_fixed_top');
            header_top.classList.remove('d-lg-block');
            header_top.classList.remove('d-md-block');
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
            header_top.classList.add('d-lg-block');
            header_top.classList.add('d-md-block');
        }
    
    }
            
    });");
        }
        $obj->set->position = $positions[$index];

        return $obj;
    }
    public function setColorStyle($obj, $colors){

        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
            $bgMain = [ $colors->mainBg,  $colors->thirdBg,  $colors->secondBg];
            $index = rand(0, 2);

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_sm_bg*/', 'background-color: '.$bgMain[$index].';');
            if($index < 2){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->linkColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/black-logo.png" alt="logo">');
                }

                $bgMain = [ $colors->secondBg, '#fcfcfc'];
                $index = rand(0, 1);

                if($obj->set->position == 'fixed'){

                    //$index = rand(0, 1);

                    //if($index == 0){
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .88);');
                    //}

                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$bgMain[$index].';');
                $obj->set->lastSectionColor = 'light';
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$bgMain[$index].';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->titleColor.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->titleColor.';');

                }



                $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, $colors->thirdBg, $colors->secondBg);


            }
            else{

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->textColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->textColor.';');

                }
                $obj->set->lastSectionColor = 'dark';
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/light-logo.png" alt="logo">');
                }

                $bgMain = [ $colors->mainBg,  $colors->thirdBg];
                $index = rand(0, 1);

                if($obj->set->position == 'fixed'){

                    //$index = rand(0, 1);

                    //if($index == 0){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .85);');
                    //}


                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$bgMain[$index].';');
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->linkColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$bgMain[$index].';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->secondBg.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->secondBg.';');

                }



                $obj = $this->setLiStyle($obj, $colors->linkColor, $colors->anyTextColor, $colors->secondBg, $colors->thirdBg);


            }
        }

        return $obj;



    }

    public function setLightColorStyle($obj, $colors){

        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
            $bgMain = [ '#fcfcfc',  $colors->secondBg];
            $index = rand(0, 1);

            $obj->set->lastSectionColor = 'light';

            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_sm_bg*/', 'background-color: '.$bgMain[$index].';');
            if($index < 1){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->textColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/light-logo.png" alt="logo">');
                }

                if($obj->set->position == 'fixed'){


                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .88);');


                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->secondBg.';');

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$colors->mainBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->linkColor.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->linkColor.';');

                }



                $obj = $this->setLiStyle($obj, $colors->textColor, $colors->titleColor, '#fcfcfc', $colors->secondBg);


            }
            else{

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->textColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/light-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/light-logo.png" alt="logo">');
                }

                if($obj->set->position == 'fixed'){


                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(255, 255, 255, .85);');


                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: #fcfcfc;');
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->textColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$colors->mainBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: #fcfcfc;');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: #fcfcfc;');

                }



                $obj = $this->setLiStyle($obj, $colors->linkColor, $colors->titleColor, $colors->secondBg, '#fcfcfc');


            }
        }

        return $obj;



    }
    public function setDarkColorStyle($obj, $colors){

        if(strpos($obj->style, '/*h_t_bg*/',0)!==false){
            $bgMain = [ $colors->mainBg,  $colors->thirdBg];
            $index = rand(0, 1);

            $obj->set->lastSectionColor = 'dark';


            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_bg*/', 'background-color: '.$bgMain[$index].';');
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_sm_bg*/', 'background-color: '.$bgMain[$index].';');
            if($index < 1){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->linkColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/black-logo.png" alt="logo">');
                }


                if($obj->set->position == 'fixed'){

                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .88);');
                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->thirdBg.';');

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->textColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$colors->secongBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->mainBg.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->mainBg.';');

                }



                $obj = $this->setLiStyle($obj, $colors->anyTextColor, '#ffffff', '#fcfcfc', $colors->secondBg);


            }
            else{

                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_t_fc*/', 'color: '.$colors->linkColor.';');
                if(strpos($obj->style, '/*header_icon_c*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*header_icon_c*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->html, '<!--im_l-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l-->', '<img src="../images/black-logo.png" alt="logo">');
                }
                if(strpos($obj->html, '<!--im_l_mini-->',0)!==false){
                    $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_l_mini-->', '<img src="../images/black-logo.png" alt="logo">');
                }

                if($obj->set->position == 'fixed'){


                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_f_main_bg*/', 'background-color: rgba(0, 0, 0, .85);');

                }
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_bg*/', 'background-color: '.$colors->mainBg.';');
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*h_m_fc*/', 'color: '.$colors->linkColor.';');


                if(strpos($obj->style, '/*menu_fc*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*menu_fc*/', 'color: '.$colors->linkColor.';');

                }
                if(strpos($obj->style, '/*humb_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_color*/', 'background-color: '.$colors->secondBg.';');

                }
                if(strpos($obj->style, '/*humb_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_span_color*/', 'background-color: '.$colors->mainBg.';');

                }

                if(strpos($obj->style, '/*humb_before_span_color*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*humb_before_span_color*/', 'background-color: '.$colors->mainBg.';');

                }



                $obj = $this->setLiStyle($obj, $colors->anyTextColor, $colors->linkColor, $colors->thirdColor, $colors->secondBg);


            }
        }

        return $obj;



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