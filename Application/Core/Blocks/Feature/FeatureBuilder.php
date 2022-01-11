<?php


namespace Application\Core\Blocks\Feature;


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

    public function getTemplate($id, $style, $settings,  $idStr, $isLanding, $userFeatureId = null){

        $featureId = is_null($userFeatureId) ? $this->getFeatureByRubricIdAction($id, $style) : $userFeatureId;

        //$featureId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Feature/templates/template'.$featureId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Feature\templates\template'.$featureId.'\FeatureTemplate'.$featureId;
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

            $obj = $this->setUniqueStyle($styleString, $html, $jsString, $UniqueStyleBuilder, $settings, $id);



            $slider = new \stdClass();
            $slider->html = $obj->html;
            $slider->css = $obj->style;
            $slider->js = $obj->js;
            $slider->set = $obj->set;

            return $slider;
        }


    }

    public function getSectionsByName($id, $styleName){

        $features = $this->featureService->getFeaturesByRubricId($id);

        $featuresArray = [];
        foreach ($features as $key=>$item){

            $nextFeature = $this->featureService->getFeatureById($item->idFeature)[0];

            if(count($nextFeature)>0){
                $featuresArray[] = $nextFeature;
            }

        }

        $featuresStyleArray = [];

        foreach($featuresArray as $key=>$feature){
            if($feature->style === $styleName){
                $featuresStyleArray[]= $feature;
            }
        }

        return $featuresStyleArray;

    }

    public function getFeatureByRubricIdAction($id, $style){

        $features = $this->featureService->getFeaturesByRubricId($id);


        $featuresArray = [];
        foreach ($features as $key=>$item){
            if($style === 'all'){
                $nextFeature = $this->featureService->getFeatureById($item->idFeature)[0];
            }
            else{
                $nextFeature = $this->featureService->getFeatureByIdAndStyle($item->idFeature, $style)[0];
            }
            if(count($nextFeature)>0){
                $featuresArray[] = $nextFeature;
            }


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



    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }
}