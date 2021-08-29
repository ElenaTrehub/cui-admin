<?php


namespace Application\Core\Pages\AboutPage;


use Application\Services\AboutPageService;
use Application\Services\UtilsService;

class AboutPageBuilder
{
    public $utilsService;
    public $aboutPageService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->aboutPageService = new AboutPageService();
    }

    public function getPageTemplate($id, $settings, $idStr, $isLanding){

        $aboutPageId = $this->getAboutPageByRubricIdAction($id);

        $aboutPageId = 1;
        $pathToTemplate = '../Application/Core/Pages/AboutPage/templates/template'.$aboutPageId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Pages\AboutPage\templates\template'.$aboutPageId.'\AboutPageTemplate'.$aboutPageId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);


            $obj = $this->setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $idStr, $isLanding);



            $about = new \stdClass();
            $about->html = $obj->html;
            $about->css = $obj->style;
            $about->js = $obj->js;
            $about->set = $obj->set;

            return $about;
        }


    }



    public function getAboutPageByRubricIdAction($id){

        $aboutPages = $this->aboutPageService->getAboutPageByRubricId($id);


        $aboutPagesArray = [];
        foreach ($aboutPages as $key=>$item){
            $nextAboutPage = $this->aboutPageService->getAboutPageById($item->idAboutPage)[0];
            $aboutPagesArray[] = $nextAboutPage;
        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($aboutPages)-1);
            $aboutPageId = $aboutPages[$index]->idAboutPage;
        }
        else{
            $aboutPageId = $this->utilsService->getItemByWeight($aboutPagesArray)->idAboutPage;
        }

        return $aboutPageId;
    }




    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $idStr, $isLanding){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding);

    }

}