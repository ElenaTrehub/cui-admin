<?php


namespace Application\Core\Blocks\About;


use Application\Services\AboutService;
use Application\Services\UtilsService;

class AboutBuilder
{
    public $utilsService;
    public $sliderService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->aboutService = new AboutService();
    }

    public function getTemplate($id, $style, $settings, $idStr, $isLanding, $userAboutId = null, $pageName=null ){


        $aboutId = is_null($userAboutId) ? $this->getAboutByRubricIdAction($id, $style) : $userAboutId;

        // $aboutId = 3;
        $pathToTemplate = '../Application/Core/Blocks/About/templates/template'.$aboutId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\About\templates\template'.$aboutId.'\AboutTemplate'.$aboutId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            if($isLanding === true){
                $html = $this->utilsService->setLandingSectionName($htmlString, $idStr);
            }
            else{
                $html = $this->utilsService->setManyPageSectionName($htmlString, $idStr, $pageName);
            }

            $style = $this->setFontStyle($styleString, $settings->fonts);


            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder, $settings, $id, $pageName);



            $about = new \stdClass();
            $about->html = $obj->html;
            $about->css = $obj->style;
            $about->js = $obj->js;
            $about->libs = $obj->libs;
            $about->set = $obj->set;

            return $about;
        }


    }

    public function getSectionsByName($id, $styleName){

        $abouts = $this->aboutService->getAboutByRubricId($id);

        $aboutsArray = [];
        foreach ($abouts as $key=>$item){

            $nextAbout = $this->aboutService->getaboutById($item->idAbout)[0];

            if(count($nextAbout)>0){
                $aboutsArray[] = $nextAbout;
            }

        }

        $aboutsStyleArray = [];

        foreach($aboutsArray as $key=>$about){
            if($about->style === $styleName){
                $aboutsStyleArray[]= $about;
            }
        }

//        $result = [];
//        foreach($aboutsStyleArray as $key=>$about){
//            $aboutTemp = $this->getTemplate($id, $styleName, $currentSettings, true, $about->aboutId);
//
//            $result[]= $aboutTemp;
//        }

        //print_r($aboutsStyleArray);

        return $aboutsStyleArray;

    }



    public function getAboutByRubricIdAction($id, $style){

        $abouts = $this->aboutService->getAboutByRubricId($id);


        $aboutsArray = [];
        foreach ($abouts as $key=>$item){

            if($style === 'all'){
                $nextAbout = $this->aboutService->getaboutById($item->idAbout)[0];
            }
            else{
                $nextAbout = $this->aboutService->getaboutByIdAndStyle($item->idAbout, $style)[0];
            }
            if(count($nextAbout)>0){
                $aboutsArray[] = $nextAbout;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($abouts)-1);
            $aboutId = $abouts[$index]->idAbout;
        }
        else{
            $aboutId = $this->utilsService->getItemByWeight($aboutsArray)->idAbout;
        }

        return $aboutId;
    }

    public function setFontStyle($style, $fonts){



        return $style;
    }





    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id, $pageName){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $pageName);

    }

}