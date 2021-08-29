<?php


namespace Application\Core\Pages\IndexPage\templates\template1;


use Application\Core\Blocks\Feature\FeatureBuilder;
use Application\Core\Blocks\Feedback\FeedbackBuilder;
use Application\Core\Blocks\Slider\SliderBuilder;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class IndexPageTemplate1
{
    public $utilsService;
    public $settings;

    public $sliderBuilder;
    public $featureBuilder;
    public $feedbackBuilder;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();

        $this->featureBuilder = new FeatureBuilder();
        $this->feedbackBuilder = new FeedbackBuilder();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;

        $featureObj = $this->featureBuilder->getTemplate($id, $settings, 'feature', $isLanding);
        $feedbackObj = $this->feedbackBuilder->getTemplate($id, $featureObj->set, 'feedback', $isLanding);



        if(strpos($obj->html, '<!--features-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--features-->', $featureObj->html);
        }

        if(strpos($obj->html, '<!--feedback-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--feedback-->', $feedbackObj->html);
        }

        $obj->style = $obj->style.$featureObj->css.$feedbackObj->css;

        $obj->js = $obj->js.$featureObj->js.$feedbackObj->js;

        return $obj;
    }

}