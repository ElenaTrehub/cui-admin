<?php


namespace Application\Core\Pages\ServicePage\templates\template1;



use Application\Core\Blocks\Service\ServiceBuilder;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class ServicePageTemplate1
{
    public $utilsService;
    public $settings;

    public $serviceBuilder;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();

        $this->serviceBuilder = new ServiceBuilder();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;

        $serviceObj = $this->serviceBuilder->getTemplate($id, $settings, 'service', $isLanding);





        if(strpos($obj->html, '<!--service-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--service-->', $serviceObj->html);
        }

        $obj->style = $obj->style.$serviceObj->css;

        $obj->js = $obj->js.$serviceObj->js;

        return $obj;
    }

}