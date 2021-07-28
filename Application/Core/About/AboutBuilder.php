<?php


namespace Application\Core\About;


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

    public function getAboutTemplate($id, $colors, $fonts, $spaces, $set){

        $aboutId = $this->getAboutByRubricIdAction($id);

        $aboutId = 1;
        $pathToTemplate = '../Application/Core/About/templates/template'.$aboutId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\About\templates\template'.$aboutId.'\AboutTemplate'.$aboutId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);


            $style = $this->setFontStyle($styleString, $fonts);


            $obj = $this->setUniqueStyle($style, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $fonts, $set, $id);



            $about = new \stdClass();
            $about->html = $obj->html;
            $about->css = $obj->style;
            $about->js = $obj->js;
            $about->set = $obj->set;

            return $about;
        }


    }

    public function getAboutByRubricIdAction($id){

        $abouts = $this->aboutService->getAboutByRubricId($id);


        $aboutsArray = [];
        foreach ($abouts as $key=>$item){
            $nextAbout = $this->aboutService->getaboutById($item->idAbout)[0];
            $aboutsArray[] = $nextAbout;
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


        if(strpos($style, '/*a_t_fz*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*a_t_fz*/', 'font-size: '.$fonts->textSize.';');
        }



        return $style;
    }







    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $fonts, $set, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $colors, $fonts, $set, $id);

    }

}