<?php


namespace Application\Core\Blocks\Feedback;

use Application\Services\FeedbackService;
use Application\Services\UtilsService;

class FeedbackBuilder
{
    public $utilsService;
    public $feedbackService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->feedbackService = new FeedbackService();
    }

    public function getTemplate($id, $style, $settings, $idStr, $isLanding, $userFeedbackId = null){

        $feedbackId = is_null($userFeedbackId) ? $this->getFeedbackByRubricIdAction($id, $style) : $userFeedbackId;

        //$feedbackId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Feedback/templates/template'.$feedbackId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Feedback\templates\template'.$feedbackId.'\FeedbackTemplate'.$feedbackId;
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

        $feedbacks = $this->feedbackService->getFeedbacksByRubricId($id);

        $feedbacksArray = [];
        foreach ($feedbacks as $key=>$item){

            $nextFeedback = $this->feedbackService->getFeedbackById($item->idFeedback)[0];

            if(count($nextFeedback)>0){
                $feedbacksArray[] = $nextFeedback;
            }

        }

        $feedbacksStyleArray = [];

        foreach($feedbacksArray as $key=>$feedback){
            if($feedback->style === $styleName){
                $feedbacksStyleArray[]= $feedback;
            }
        }

        return $feedbacksStyleArray;

    }
    public function getFeedbackByRubricIdAction($id, $style){

        $feedbacks = $this->feedbackService->getFeedbacksByRubricId($id);


        $feedbacksArray = [];
        foreach ($feedbacks as $key=>$item){
            if($style === 'all'){
                $nextFeedback = $this->feedbackService->getFeedbackById($item->idFeedback)[0];
            }
            else{
                $nextFeedback = $this->feedbackService->getFeedbackByIdAndStyle($item->idFeedback, $style)[0];
            }
            if(count($nextFeedback)>0){
                $feedbacksArray[] = $nextFeedback;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($feedbacks)-1);
            $feedbackId = $feedbacks[$index]->idFeedback;
        }
        else{
            $feedbackId = $this->utilsService->getItemByWeight($feedbacksArray)->idFeedback;
        }

        return $feedbackId;
    }

    public function setFontStyle($style, $fonts){

        return $style;
    }



    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }

}