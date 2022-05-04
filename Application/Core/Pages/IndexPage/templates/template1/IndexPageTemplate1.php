<?php


namespace Application\Core\Pages\IndexPage\templates\template1;


use Application\Core\Blocks\Feature\FeatureBuilder;
use Application\Core\Blocks\Feedback\FeedbackBuilder;
use Application\Core\Blocks\Main\MainBuilder;
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
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding, $style){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;
        //$obj->libs = '';

        $featureObj = $this->featureBuilder->getTemplate($id, $style, $settings, 'feature', $isLanding, 1,'index');
        $feedbackObj = $this->feedbackBuilder->getTemplate($id, $style, $featureObj->set, 'feedback', $isLanding, 1, 'index');



        if(strpos($obj->html, '<!--features-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--features-->', $featureObj->html);
        }

        if(strpos($obj->html, '<!--feedback-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--feedback-->', $feedbackObj->html);
        }

        $obj->style = $obj->style.'/*index-feature-start*/'.$featureObj->css.'/*index-feature-end*/'.'/*index-feedback-start*/'.$feedbackObj->css.'/*index-feedback-end*/';

        $obj->js = '/*index-feature-start*/'.'/*libs-start*/'.$featureObj->libs.'/*libs-end*/'.$featureObj->js.'/*index-feature-end*/'.'/*index-feedback-start*/'.'/*libs-start*/'.$feedbackObj->libs.'/*libs-end*/'.$feedbackObj->js.'/*index-feedback-end*/'.$obj->js;

        return $obj;
    }

}