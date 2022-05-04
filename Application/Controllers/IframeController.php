<?php


namespace Application\Controllers;


use Application\Models\IframeModel;
use Application\Services\IframeService;

class IframeController extends BaseController
{
    public function getLandingByRubricIdAction($id, $style, $theme, $lang){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getLandingTemplateObj($id, $style, $theme, $lang);

        $this->json( $template );
    }

    public function getManyPageSiteByRubricIdAction($id, $style, $theme, $lang){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getManyPageSiteTemplateObj($id, $style, $theme, $lang);

        $this->json( $template );
    }







}