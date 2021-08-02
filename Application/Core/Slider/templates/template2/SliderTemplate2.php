<?php


namespace Application\Core\Slider\templates\template2;


use Application\Core\JsLibs\JsLibs;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class SliderTemplate2
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
    public function setUniqueStyle($styleString, $htmlString, $jsString, $colors, $set, $id){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $set;


        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $colors, $id);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $colors, $id);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $colors, $id);
        }

        $obj = $this->setJs($obj);

        return $obj;
    }

    public function setColorsForChildInLightBlock($obj, $colors, $id){
        if(strpos($obj->html, '<!--im_s_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-1.jpg" alt="slide">');
        }
        if(strpos($obj->html, '<!--im_s_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_2-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-2.jpg" alt="slide">');
        }
        if(strpos($obj->html, '<!--im_s_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_3-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-3.jpg" alt="slide">');
        }
        if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(80, 80, 80, .5);');

        }



        $obj = $this->setDotsStyle($obj, $colors->secondBg);

        $obj->set->lastSectionColor = 'light';
    }

    public function setColorsForChildInDarkBlock($obj, $colors, $id){
        if(strpos($obj->html, '<!--im_s_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-1.jpg" alt="slide">');
        }
        if(strpos($obj->html, '<!--im_s_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_2-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-2.jpg" alt="slide">');
        }
        if(strpos($obj->html, '<!--im_s_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_3-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-3.jpg" alt="slide">');
        }

        if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(0, 0, 0, .42);');

        }


        $obj = $this->setDotsStyle($obj, $colors->secondBg);
        $obj->set->lastSectionColor = 'dark';
    }



    public function setJs($obj){

        $variantDots = rand(1, 2);

        switch ($variantDots) {
            case 1:
            {
                if(isset($obj->set->getSliderOneSlideAllWidth)){
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideAllWidth(".main-slider-item", ".main", ".main-slider",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                else{
                    $obj->set->getSliderOneSlideAllWidth = true;
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', $this->jsLibs->getJsLib('getSliderOneSlideAllWidth').'sliderOneSlideAllWidth(".main-slider-item", ".main", ".main-slider",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                break;
            }
            case 2:
            {
                if(strpos($obj->style, '/*main_wrapper*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*main_wrapper*/', '.main-slider{width: 100%;}');
                }
                if(isset($obj->set->getSliderOneSlideOpacity)){
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideOpacity(".main-slider-item", ".main",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                else{
                    $obj->set->getSliderOneSlideAllWidth = true;
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', $this->jsLibs->getJsLib('getSliderOneSlideOpacity').'sliderOneSlideOpacity(".main-slider-item", ".main",  ".main-prev-btn", ".main-next-btn");');
                    }
                }

                break;
            }

        }



        return $obj;

    }
    public function setColorStyle($obj, $colors, $id){


        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color:'.$colors->secondBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: #ffffff;');

        }

        if($obj->set->lastSectionColor === 'dark'){

            $this->setColorsForChildInLightBlock($obj, $colors, $id);

        }
        else{
            $this->setColorsForChildInDarkBlock($obj, $colors, $id);
        }

        return $obj;
    }
    public function setLightColorStyle($obj, $colors, $id){


        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color:'.$colors->secondBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: #ffffff;');

        }
        $this->setColorsForChildInLightBlock($obj, $colors, $id);

        return $obj;

    }
    public function setDarkColorStyle($obj, $colors, $id){


        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color:'.$colors->secondBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: #ffffff;');

        }

        $this->setColorsForChildInDarkBlock($obj, $colors, $id);


        return $obj;
    }

    public function setDotsStyle($obj, $dotColor){
        $variantDots = rand(1, 4);

        switch ($variantDots){
            case 1:{
                if(strpos($obj->style, '/*dots_style*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*dots_style*/', '.carousel-indicators li{
    
    box-sizing: content-box;
    flex: 0 1 auto;
    width: 30px;
    height: 6px;
    margin-right: 10px;
    margin-left: 10px;
    cursor: pointer;
    background-color: '.$dotColor.';
    background-clip: padding-box;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: none;
    border-right: none;
    opacity: .5;
    transition: opacity .6s ease;
    z-index: 1000;
}');
                }
                break;
            }
            case 2:{
                if(strpos($obj->style, '/*dots_style*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*dots_style*/', '.carousel-indicators li{
    
    box-sizing: content-box;
    flex: 0 1 auto;
    width: 30px;
    height: 6px;
    margin-right: 10px;
    margin-left: 10px;
    cursor: pointer;
    background-color: '.$dotColor.';
    background-clip: padding-box;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: none;
    border-right: none;
    border-radius: 3px;
    opacity: .5;
    transition: opacity .6s ease;
    z-index: 1000;
}');
                }
                break;
            }
            case 3:{
                if(strpos($obj->style, '/*dots_style*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*dots_style*/', '.carousel-indicators li{
    
    width: 12px;
    height: 12px;
    margin-right: 15px;
    margin-left: 15px;
    cursor: pointer;
    background-color: '.$dotColor.';
    opacity: .5;
    border-radius: 6px;
    transition: opacity .6s ease;
    z-index: 1000;
}');
                }
                break;
            }
            case 4:{
                if(strpos($obj->style, '/*dots_style*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*dots_style*/', '.carousel-indicators li{
    
    box-sizing: content-box;
    flex: 0 1 auto;
    width: 30px;
    height: 3px;
    margin-right: 10px;
    margin-left: 10px;
    cursor: pointer;
    background-color: '.$dotColor.';
    background-clip: padding-box;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-left: none;
    border-right: none;
    opacity: .5;
    transition: opacity .6s ease;
    z-index: 1000;
}');
                }
                break;
            }




        }
        return $obj;
    }









}