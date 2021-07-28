<?php


namespace Application\Core\Slider\templates\template2;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class SliderTemplate2
{
    public $utilsService;
    public $settings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();
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
        else{
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





        return $obj;




    }
    public function setLightColorStyle($obj, $colors, $id){


        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color:'.$colors->secondBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: #ffffff;');

        }

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

        return $obj;

    }
    public function setDarkColorStyle($obj, $colors, $id){


        if(strpos($obj->style, '/*m_h_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_h_c*/', 'color:'.$colors->secondBg.';');

        }
        if(strpos($obj->style, '/*m_t_c*/',0)!==false){
            $obj->style = $this->utilsService->parseStyle($obj->style, '/*m_t_c*/', 'color: #ffffff;');

        }


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









}