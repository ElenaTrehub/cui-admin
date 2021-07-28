<?php


namespace Application\Controllers;


use Application\Models\IframeModel;
use Application\Services\IframeService;

class IframeController extends BaseController
{
    public function getTemplateByRubricIdAction($id){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getTemplateObj($id);



        //$headerId = $this->getHeaderByRubricId($id);
//        $mainId = $this->getMainByRubricId($id);
//        $aboutId = $this->getAboutByRubricId($id);
//        $featureId = $this->getFeaturesByRubricId($id);
//        $feedbackId = $this->getFeedbacksByRubricId($id);
//        $consultationId = $this->getConsultationsByRubricId($id);
//        $footerId = $this->getFootersByRubricId($id);







//        $main = $iframeService->getMainById($mainId);
//        $about = $iframeService->getAboutById($aboutId);
//        $feature = $iframeService->getFeatureById($featureId);
//        $feedback = $iframeService->getFeedbackById($feedbackId);
//        $consultation = $iframeService->getConsultationById($consultationId);
//        $footer = $iframeService->getFooterById($footerId);
//
//        $font = $iframeService->getFontById($fontId);
//        $space = $iframeService->getSpaceById($spaceId);
//
//        //var_dump($space[0]);
//
//
//        $gsheader = json_decode($header[0]->html);
//        $gsmain = json_decode($main[0]->html);
//        $gsabout = json_decode($about[0]->html);
//
//        $gsfeature = json_decode($feature[0]->html);
//
//        $gsfeedback = json_decode($feedback[0]->html);
//        $gsconsultation = json_decode($consultation[0]->html);
//        $gsfooter = json_decode($footer[0]->html);
//
//        $colorStyleStr = '.mainBg{background-color: '.$color[0]->mainBg.';}'.'.secondBg{background-color: '.$color[0]->secondBg.';}'.'.thirdBg{background-color: '.$color[0]->thirdBg.';}'
//            .'.titleColor{color: '.$color[0]->titleColor.';}'.'.textColor{color: '.$color[0]->textColor.';}'.'.linkColor{color: '.$color[0]->linkColor.';}'
//            .'.anyTextColor{color: '.$color[0]->anyTextColor.';}'.'.btnMainBg{background-color: '.$color[0]->btnMainBg.';}'.'.btnSecondBg{background-color: '.$color[0]->btnSecondBg.';}'
//            .'.btnAnyBg{background-color: '.$color[0]->btnAnyBg.';}'.'.btnLightFont{color: '.$color[0]->btnLightFont.';}'.'.btnDarkFont{color: '.$color[0]->btnDarkFont.';}'
//            .'.btnLightBorder{border-color: '.$color[0]->btnLightBorder.';}'.'.btnDarkBorder{border-color: '.$color[0]->btnDarkBorder.';}';
//
//        $fontStyleStr = 'body{font-family: '.$font[0]->nameFont.', sans-serif;}'.'.h1Size{font-size: '.$font[0]->h1Size.';}'.'.h2Size{font-size: '.$font[0]->h2Size.';}'
//            .'.h3Size{font-size: '.$font[0]->h3Size.';}'.'.textSize{font-size: '.$font[0]->textSize.';}'
//            .'.linkSize{font-size: '.$font[0]->linkSize.';}'.'.textTransform{font-size: '.$font[0]->textTransform.';}';
//
//        $spaceStyle = '.headerBigSpace{padding: '.$space[0]->headerBigSpace.' 0px;}'.'.headerSmallSpace{padding: '.$space[0]->headerSmallSpace.' 0px;}'
//        .'.sectionSpace{padding: '.$space[0]->sectionSpace.' 0px;}'.'.titleBottomSpace{padding-bottom: '.$space[0]->titleBottomSpace.';}'
//        .'.footerBigSpace{padding: '.$space[0]->footerBigSpace.' 0px;}'.'.footerSmallSpace{padding: '.$space[0]->footerSmallSpace.' 0px;}';
//
//
//        $mediaStyle =
//
//        $html = [$gsheader, $gsmain, $gsabout, $gsfeature, $gsfeedback, $gsconsultation, $gsfooter];
//        $css = $fontStyleStr.$spaceStyle.$colorStyleStr.$header[0]->style.$main[0]->style.$about[0]->style.$feature[0]->style.$feedback[0]->style.$consultation[0]->style.$footer[0]->style;
//        $js = $header[0]->script.$main[0]->script.$about[0]->script.$feature[0]->script.$feedback[0]->script.$consultation[0]->script.$footer[0]->script;
//        $fontLink = $font[0]->link;

//        $iframe = new \stdClass();
//        $objHtml = new \stdClass();
//        $objHtml->tagName = "body";
//        $objHtml->children = $html;
//        $iframe->html = $objHtml;
//        $iframe->css = $css;
//        $iframe->script = $js;
//        $iframe->fontStyle = $fontLink;



        $this->json( $template );
    }





    public function getMainByRubricId($id){
        $iframeService = new IframeService();

        $mains = $iframeService->getMainsByRubricId($id);
        $randomIndex = rand(1, count($mains));
        $mainId = $mains[$randomIndex-1]->idMain;
//echo $mainId;
        return $mainId;
    }

    public function getAboutByRubricId($id){
        $iframeService = new IframeService();

        $abouts = $iframeService->getAboutByRubricId($id);
        $randomIndex = rand(1, count($abouts));
        $aboutId = $abouts[$randomIndex-1]->idAbout;
//echo $aboutId;
        return $aboutId;
    }

    public function getFeaturesByRubricId($id){
        $iframeService = new IframeService();

        $features = $iframeService->getFeaturesByRubricId($id);
        $randomIndex = rand(1, count($features));
        $featureId = $features[$randomIndex-1]->idFeature;
//echo $featureId;
        return $featureId;
    }

    public function getFeedbacksByRubricId($id){
        $iframeService = new IframeService();

        $feedbacks = $iframeService->getFeedbacksByRubricId($id);
        $randomIndex = rand(1, count($feedbacks));
        $feedbackId = $feedbacks[$randomIndex-1]->idFeedback;
//echo $feedbackId;
        return $feedbackId;
    }

    public function getConsultationsByRubricId($id){
        $iframeService = new IframeService();

        $consultations = $iframeService->getConsultationsByRubricId($id);
        $randomIndex = rand(1, count($consultations));
        $consultationId = $consultations[$randomIndex-1]->idConsultation;
//echo $consultationId;
        return $consultationId;
    }

    public function getFootersByRubricId($id){
        $iframeService = new IframeService();

        $footers = $iframeService->getFootersByRubricId($id);
        $randomIndex = rand(1, count($footers));
        $footerId = $footers[$randomIndex-1]->idFooter;
//echo $footerId;
        return $footerId;
    }






}