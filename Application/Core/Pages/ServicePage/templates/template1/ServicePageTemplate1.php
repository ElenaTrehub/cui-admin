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
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding, $style){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;
        $obj->libs = '';

        $serviceObj = $this->serviceBuilder->getTemplate($id, $style, $settings, 'service', $isLanding, 2, 'service');





        if(strpos($obj->html, '<!--service-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--service-->', $serviceObj->html);
        }

        $obj->style = $obj->style.'/*service-service-start*/'.$serviceObj->css.'/*service-service-end*/';

        $obj->js =  '/*service-service-start*/'.'/*libs-start*/'.$serviceObj->libs.'/*libs-end*/'.$serviceObj->js.'/*service-service-end*/'.$obj->js;

        return $obj;
    }

}