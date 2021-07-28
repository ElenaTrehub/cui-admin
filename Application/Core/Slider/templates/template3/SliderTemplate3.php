<?php


namespace Application\Core\Slider\templates\template3;


use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class SliderTemplate3
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
                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-2.jpg" alt="slide">');
            }

            if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(80, 80, 80, .5);');

            }

            if(strpos($obj->style, '/*star_color*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*star_color*/', 'color: '.$colors->thirdBg.';');

            }


            $obj->set->lastSectionColor = 'light';


        }
        else{
            if(strpos($obj->html, '<!--im_s_1-->',0)!==false){
                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-2.jpg" alt="slide">');
            }


            if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(0, 0, 0, .42);');

            }
            if(strpos($obj->style, '/*star_color*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*star_color*/', 'color: '.$colors->secondBg.';');

            }


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
                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/light/slide-2.jpg" alt="slide">');
            }

            if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(80, 80, 80, .5);');

            }

            if(strpos($obj->style, '/*star_color*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*star_color*/', 'color: '.$colors->thirdBg.';');

            }


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
                $obj->html = $this->utilsService->parseStyle($obj->html, '<!--im_s_1-->', '<img src="../images/'.$this->settings->getPhotoFolderName($id).'/dark/slide-2.jpg" alt="slide">');
            }


            if(strpos($obj->style, '/*t_w_bg*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*t_w_bg*/', 'background-color: rgba(0, 0, 0, .42);');

            }
            if(strpos($obj->style, '/*star_color*/',0)!==false){
                $obj->style = $this->utilsService->parseStyle($obj->style, '/*star_color*/', 'color: '.$colors->secondBg.';');

            }


            $obj->set->lastSectionColor = 'dark';

        return $obj;




    }







}