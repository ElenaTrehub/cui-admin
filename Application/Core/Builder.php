<?php


namespace Application\Core;


use Application\Core\About\AboutBuilder;
use Application\Core\Color\ColorBuilder;
use Application\Core\Feature\FeatureBuilder;
use Application\Core\Feedback\FeedbackBuilder;
use Application\Core\Font\FontBuilder;
use Application\Core\GlobalStyle\GlobalStyleBuilder;
use Application\Core\Header\HeaderBuilder;
use Application\Core\Service\ServiceBuilder;
use Application\Core\Slider\SliderBuilder;
use Application\Core\Space\SpaceBuilder;


class Builder
{
//ызов всех классов для построения сайта

    public $headerBuilder;
    public $colorBuilder;
    public $fontBuilder;
    public $spaceBuilder;
    public $globalStyleBuilder;
    public $sliderBuilder;
    public $aboutBuilder;
    public $featureBuilder;
    public $serviceBuilder;
    public $feedbackBuilder;

    public function __construct()
    {
        $this->headerBuilder = new HeaderBuilder();
        $this->colorBuilder = new ColorBuilder();
        $this->fontBuilder = new FontBuilder();
        $this->fontBuilder = new FontBuilder();
        $this->spaceBuilder = new SpaceBuilder();
        $this->globalStyleBuilder = new GlobalStyleBuilder();
        $this->sliderBuilder = new SliderBuilder();
        $this->aboutBuilder = new AboutBuilder();
        $this->featureBuilder = new FeatureBuilder();
        $this->serviceBuilder = new ServiceBuilder();
        $this->feedbackBuilder = new FeedbackBuilder();
    }
    public function getTemplateObjCore($id): \stdClass
    {


        $colors = $this->colorBuilder->getColorObj($id);
        $fonts = $this->fontBuilder->getFontObj($id);
        $spaces = $this->spaceBuilder->getSpaceObj($id);

        $themes = ['light', 'normal', 'dark'];
        $index = rand(0, 2);


        $headerObj = $this->headerBuilder->getHeaderTemplate($id, $colors, $fonts, $spaces, $themes[$index]);

        $sliderObj = $this->sliderBuilder->getSliderTemplate($id, $colors, $fonts, $spaces, $headerObj->set);

        $aboutObj = $this->aboutBuilder->getAboutTemplate($id, $colors, $fonts, $spaces, $sliderObj->set);

        $featureObj = $this->featureBuilder->getFeatureTemplate($id, $colors, $fonts, $spaces, $aboutObj->set);



        $feedbackObj = $this->feedbackBuilder->getFeedbackTemplate($id, $colors, $fonts, $spaces, $featureObj->set);
        $serviceObj = $this->serviceBuilder->getServiceTemplate($id, $colors, $fonts, $spaces, $feedbackObj->set);

        $globalStyle = $this->globalStyleBuilder->getGlobalStyle($fonts, $spaces, $colors);

        $html = $headerObj->html.$sliderObj->html.$aboutObj->html.$featureObj->html.$feedbackObj->html.$serviceObj->html;
        $css = $headerObj->css.$sliderObj->css.$aboutObj->css.$featureObj->css.$feedbackObj->css.$serviceObj->css;
        $js = '(function() { "use strict"'.$headerObj->js.$sliderObj->js.$aboutObj->js.$featureObj->js.$feedbackObj->js.$serviceObj->js.'new WOW().init();})();';
        $fontLink = $fonts->link;

        $iframe = new \stdClass();
        //$objHtml = new \stdClass();
        //$objHtml->tagName = "body";
        //$objHtml->children = $html;
        $iframe->html = $html;
        $iframe->css = $globalStyle.$css;
        $iframe->script = $js;
        $iframe->fontStyle = $fontLink;
        $iframe->set = $aboutObj->set;

        return $iframe;
    }
}