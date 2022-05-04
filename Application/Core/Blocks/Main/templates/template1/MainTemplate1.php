<?php


namespace Application\Core\Blocks\Main\templates\template1;


use Application\Core\JsLibs\JsLibs;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class MainTemplate1
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
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $lang){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->libs = '';
        $obj->set = $settings;



        if($obj->set->theme == 'normal'){
            $obj = $this->setColorStyle($obj, $settings->colors, $id);
        }
        else if($obj->set->theme == 'light'){
            $obj = $this->setLightColorStyle($obj, $settings->colors, $id);
        }
        else{
            $obj = $this->setDarkColorStyle($obj, $settings->colors, $id);
        }

        $obj = $this->setJs($obj);
        $obj = $this->translate($obj, $lang);

        return $obj;
    }

    public function translate($obj, $lang){
        if(strpos($obj->html, '<!--slider_item_title_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_title_1-->', $this->settings->getTranslate('<!--slider_item_title_1-->', $lang));
        }
        if(strpos($obj->html, '<!--slider_item_text_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_text_1-->', $this->settings->getTranslate('<!--slider_item_text_1-->', $lang));
        }
        if(strpos($obj->html, '<!--slider_item_title_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_title_2-->', $this->settings->getTranslate('<!--slider_item_title_2-->', $lang));
        }
        if(strpos($obj->html, '<!--slider_item_text_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_text_2-->', $this->settings->getTranslate('<!--slider_item_text_2-->', $lang));
        }
        if(strpos($obj->html, '<!--slider_item_title_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_title_3-->', $this->settings->getTranslate('<!--slider_item_title_3-->', $lang));
        }
        if(strpos($obj->html, '<!--slider_item_text_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--slider_item_text_3-->', $this->settings->getTranslate('<!--slider_item_text_3-->', $lang));
        }
        return $obj;
    }

    public function setColorsForChildInLightBlock($obj, $colors, $id){
        if(strpos($obj->html, '<!--im_s_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-1.jpg" alt="">');
        }
        if(strpos($obj->html, '<!--im_s_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_2-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-2.jpg" alt="">');
        }
        if(strpos($obj->html, '<!--im_s_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_3-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-3.jpg" alt="">');
        }

        if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(0, 0, 0, .5);');

        }
        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color: #ffffff;');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: '.$colors->secondBg.';');

        }
        $obj = $this->setBorderStyle($obj, $colors->mainBg);
        $obj = $this->setDotsStyle($obj, $colors->secondBg);

        $obj->set->lastSectionColor = 'light';
    }

    public function setColorsForChildInDarkBlock($obj, $colors, $id){
        if(strpos($obj->html, '<!--im_s_1-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-1.jpg" alt="">');
        }
        if(strpos($obj->html, '<!--im_s_2-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_2-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-2.jpg" alt="">');
        }
        if(strpos($obj->html, '<!--im_s_3-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_3-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-3.jpg" alt="">');
        }

        if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(254, 254, 254, .7);');

        }
        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color: '.$colors->thirdBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: '.$colors->maindBg.';');

        }
        $obj = $this->setBorderStyle($obj, $colors->secondBg);
        $obj = $this->setDotsStyle($obj, $colors->secondBg);

        $obj->set->lastSectionColor = 'dark';
    }

    public function setJs($obj){

        $variantDots = rand(1, 2);

        switch ($variantDots) {
            case 1:
            {
                if(isset($obj->set->libs->getSliderOneSlideAllWidth)){
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideAllWidth(".main-slider-item", ".main", ".main-slider",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                else{
                    $obj->set->libs->getSliderOneSlideAllWidth = true;
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->libs = $this->jsLibs->getJsLib('getSliderOneSlideAllWidth');
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideAllWidth(".main-slider-item", ".main", ".main-slider",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                break;
            }
            case 2:
            {
                if(strpos($obj->style, '/*main_wrapper*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*main_wrapper*/', '.main-slider{width: 100%;}');
                }
                if(isset($obj->set->libs->getSliderOneSlideOpacity)){
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideOpacity(".main-slider-item", ".main",  ".main-prev-btn", ".main-next-btn");');
                    }
                }
                else{
                    $obj->set->libs->getSliderOneSlideAllWidth = true;
                    $obj->libs = $this->jsLibs->$this->jsLibs->getJsLib('getSliderOneSlideOpacity');
                    if(strpos($obj->js, '//js_code_main',0)!==false){
                        $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_main', 'sliderOneSlideOpacity(".main-slider-item", ".main",  ".main-prev-btn", ".main-next-btn");');
                    }
                }

                break;
            }

        }



        return $obj;

    }
    public function setColorStyle($obj, $colors, $id){

                if($obj->set->lastSectionColor === 'dark'){
                    $this->setColorsForChildInLightBlock($obj, $colors, $id);
                }
                else{
                    $this->setColorsForChildInDarkBlock($obj, $colors, $id);
                }

                return $obj;

        }
    public function setLightColorStyle($obj, $colors, $id){

        $this->setColorsForChildInLightBlock($obj, $colors, $id);

        return $obj;

    }
    public function setDarkColorStyle($obj, $colors, $id){

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
}');
                }
                break;
            }




        }
        return $obj;
    }


    public function setBorderStyle($obj, $borderColor){
        $variantBorder = rand(1, 3);

        switch ($variantBorder){
            case 1:{
                if(strpos($obj->style, '/*t_w_border*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_border*/', 'border-left: 6px solid '.$borderColor.';');
                }
                break;
            }
            case 2:{
                if(strpos($obj->style, '/*t_w_border*/',0)!==false){
                    $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_border*/', 'border-top: 6px solid '.$borderColor.';');
                }
                break;
            }
            case 3:
                {
                    if (strpos($obj->style, '/*t_w_border*/', 0) !== false) {
                        $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_border*/', '');
                    }
                    break;
                }




        }
        return $obj;
    }








}