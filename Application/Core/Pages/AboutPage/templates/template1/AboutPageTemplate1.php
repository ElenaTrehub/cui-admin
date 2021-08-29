<?php


namespace Application\Core\Pages\AboutPage\templates\template1;



use Application\Core\Blocks\About\AboutBuilder;

use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class AboutPageTemplate1
{
    public $utilsService;
    public $settings;

    public $aboutBuilder;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();

        $this->aboutBuilder = new AboutBuilder();

    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;

        $aboutObj = $this->aboutBuilder->getTemplate($id, $settings, 'about', $isLanding);


        if(strpos($obj->html, '<!--about-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--about-->', $aboutObj->html);
        }



        $obj->style = $obj->style.$aboutObj->css;

        $obj->js = $obj->js.$aboutObj->js;

        return $obj;
    }
}