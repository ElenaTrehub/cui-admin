<?php


namespace Application\Core\Feature;


use Application\Services\FeatureService;
use Application\Services\UtilsService;

class FeatureBuilder
{
    public $utilsService;
    public $featureService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->featureService = new FeatureService();
    }

    public function getFeatureTemplate($id, $colors, $fonts, $spaces, $set){

        $featureId = $this->getFeatureByRubricIdAction($id);
        //$featureId = 3;
        $pathToTemplate = '../Application/Core/Feature/templates/template'.$featureId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Feature\templates\template'.$featureId.'\FeatureTemplate'.$featureId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            $obj = $this->setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $fonts, $set);



            $slider = new \stdClass();
            $slider->html = $obj->html;
            $slider->css = $obj->style;
            $slider->js = $obj->js;
            $slider->set = $obj->set;

            return $slider;
        }


    }

    public function getFeatureByRubricIdAction($id){

        $features = $this->featureService->getFeaturesByRubricId($id);


        $featuresArray = [];
        foreach ($features as $key=>$item){
            $nextFeature = $this->featureService->getFeatureById($item->idFeature)[0];
            $featuresArray[] = $nextFeature;
        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($features)-1);
            $featureId = $features[$index]->idFeature;
        }
        else{
            $featureId = $this->utilsService->getItemByWeight($featuresArray)->idFeature;
        }

        return $featureId;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $colors, $fonts, $set){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $colors, $fonts, $set);

    }
}