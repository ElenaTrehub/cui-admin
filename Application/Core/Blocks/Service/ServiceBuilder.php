<?php


namespace Application\Core\Blocks\Service;


use Application\Services\FeedbackService;
use Application\Services\ServiceService;
use Application\Services\UtilsService;

class ServiceBuilder
{
    public $utilsService;
    public $serviceService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->serviceService = new ServiceService();
    }

    public function getTemplate($id, $style, $settings, $idStr, $isLanding, $userServiceId = null){

        $serviceId = is_null($userServiceId) ? $this->getServiceByRubricIdAction($id, $style) : $userServiceId;

        $serviceId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Service/templates/template'.$serviceId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Service\templates\template'.$serviceId.'\ServiceTemplate'.$serviceId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            if($isLanding === true){
                $html = $this->utilsService->setLandingSectionName($htmlString, $idStr);
            }
            else{
                $html = $this->utilsService->setManyPageSectionName($htmlString, $idStr);
            }

            $style = $this->setFontStyle($styleString, $settings->fonts);

            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder, $settings, $id);



            $slider = new \stdClass();
            $slider->html = $obj->html;
            $slider->css = $obj->style;
            $slider->js = $obj->js;
            $slider->set = $obj->set;

            return $slider;
        }


    }
    public function getSectionsByName($id, $styleName){

        $services = $this->serviceService->getServiceByRubricId($id);

        $servicesArray = [];
        foreach ($services as $key=>$item){

            $nextService = $this->serviceService->getServiceById($item->idService)[0];

            if(count($nextService)>0){
                $servicesArray[] = $nextService;
            }

        }

        $servicesStyleArray = [];

        foreach($servicesArray as $key=>$service){
            if($service->style === $styleName){
                $servicesStyleArray[]= $service;
            }
        }

        return $servicesStyleArray;

    }
    public function getServiceByRubricIdAction($id, $style){

        $services = $this->serviceService->getServiceByRubricId($id);


        $servicesArray = [];
        foreach ($services as $key=>$item){
            if($style === 'all'){
                $nextService = $this->serviceService->getServiceById($item->idService)[0];
            }
            else{
                $nextService = $this->serviceService->getServiceByIdAndStyle($item->idService, $style)[0];
            }
            if(count($nextService)>0){
                $servicesArray[] = $nextService;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($services)-1);
            $serviceId = $services[$index]->idService;
        }
        else{
            $serviceId = $this->utilsService->getItemByWeight($servicesArray)->idService;
        }

        return $serviceId;
    }

    public function setFontStyle($style, $fonts){

        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }
}