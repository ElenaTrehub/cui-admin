<?php


namespace Application\Core\Pages\AboutPage\templates\template1;



use Application\Core\Blocks\About\AboutBuilder;

use Application\Core\Blocks\Feature\FeatureBuilder;
use Application\Core\Settings\Settings;
use Application\Services\UtilsService;

class AboutPageTemplate1
{
    public $utilsService;
    public $settings;

    public $aboutBuilder;
    public $featureBuilder;
    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->settings = new Settings();

        $this->aboutBuilder = new AboutBuilder();
        $this->featureBuilder = new FeatureBuilder();
    }
    public function setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id, $idStr, $isLanding, $style){

        $obj = new \stdClass();
        $obj->html = $htmlString;
        $obj->style = $styleString;
        $obj->js = $jsString;
        $obj->set = $settings;
        //$obj->libs = '';

        $aboutObj = $this->aboutBuilder->getTemplate($id, $style, $settings, 'about', $isLanding, 1, 'about');
        $featureObj = $this->featureBuilder->getTemplate($id, $style, $aboutObj->set, 'feature', $isLanding, 2,'about');

        if(strpos($obj->html, '<!--about-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--about-->', $aboutObj->html);
        }

        if(strpos($obj->html, '<!--features-->',0)!==false){
            $obj->html = $this->utilsService->parseStyle($obj->html, '<!--features-->', $featureObj->html);
        }

        $obj->style = $obj->style.'/*about-about-start*/'.$aboutObj->css.'/*about-about-end*/'.'/*about-feature-start*/'.$featureObj->css.'/*about-feature-end*/';

        $obj->js = '/*about-about-start*/'.'/*libs-start*/'.$aboutObj->libs.'/*libs-end*/'.$aboutObj->js.'/*about-about-end*/'.'/*about-feature-start*/'.'/*libs-start*/'.$featureObj->libs.'/*libs-start*/'.$featureObj->js.'/*about-feature-end*/'.$obj->js;

        return $obj;
    }
}