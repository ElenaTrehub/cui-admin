<?php


namespace Application\Core\Pages\IndexPage;


use Application\Services\IndexPageService;
use Application\Services\UtilsService;

class IndexPageBuilder
{
    public $utilsService;
    public $indexPageService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->indexPageService = new IndexPageService();
    }

    public function getPageTemplate($id, $style, $settings, $idStr, $isLanding){

        $indexPageId = $this->getIndexPageByRubricIdAction($id, $style);

        $indexPageId = 1;
        $pathToTemplate = '../Application/Core/Pages/IndexPage/templates/template'.$indexPageId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Pages\IndexPage\templates\template'.$indexPageId.'\IndexPageTemplate'.$indexPageId;
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



    public function getIndexPageByRubricIdAction($id, $style){

        $indexPages = $this->indexPageService->getIndexPageByRubricId($id);


        $indexPagesArray = [];
        foreach ($indexPages as $key=>$item){
            if($style === 'all'){
                $nextIndexPage = $this->indexPageService->getIndexPageById($item->idIndexPage)[0];
            }
            else{

                $nextIndexPage = $this->indexPageService->getIndexPageByIdAndStyle($item->idIndexPage, $style)[0];
            }
            if(count($nextIndexPage)>0){
                $indexPagesArray[] = $nextIndexPage;
            }





        }


        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($indexPages)-1);

            $indexPageId = $indexPages[$index]->idIndexPage;
        }
        else{

            $indexPageId = $this->utilsService->getItemByWeight($indexPagesArray)->idIndexPage;
        }

        return $indexPageId;
    }





    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $idStr, $isLanding, $style){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding, $style);

    }
}