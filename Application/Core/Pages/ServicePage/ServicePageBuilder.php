<?php


namespace Application\Core\Pages\ServicePage;


use Application\Services\IndexPageService;
use Application\Services\ServicePageService;
use Application\Services\UtilsService;

class ServicePageBuilder
{
    public $utilsService;
    public $servicePageService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->servicePageService = new ServicePageService();
    }

    public function getPageTemplate($id, $style, $settings, $idStr, $isLanding){

        $servicePageId = $this->getServicePageByRubricIdAction($id, $style);

        $servicePageId = 1;
        $pathToTemplate = '../Application/Core/Pages/ServicePage/templates/template'.$servicePageId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Pages\ServicePage\templates\template'.$servicePageId.'\ServicePageTemplate'.$servicePageId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);



            $obj = $this->setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $idStr, $isLanding, $style);



            $about = new \stdClass();
            $about->html = $obj->html;
            $about->css = $obj->style;
            $about->js = $obj->js;
            $about->set = $obj->set;

            return $about;
        }


    }



    public function getServicePageByRubricIdAction($id, $style){

        $servicePages = $this->servicePageService->getServicePageByRubricId($id);


        $servicePagesArray = [];
        foreach ($servicePages as $key=>$item){
            if($style === 'all'){
                $nextServicePage = $this->servicePageService->getServicePageById($item->idServicePage)[0];
            }
            else{

                $nextServicePage = $this->servicePageService->getServicePageByIdAndStyle($item->idServicePage, $style)[0];
            }
            if(count($nextServicePage)>0){
                $servicePagesArray[] = $nextServicePage;
            }




        }


        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($servicePages)-1);

            $servicePageId = $servicePages[$index]->idServicePage;
        }
        else{

            $servicePageId = $this->utilsService->getItemByWeight($servicePagesArray)->idServicePage;
        }

        return $servicePageId;
    }





    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $idStr, $isLanding, $style){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding, $style);

    }
}