<?php


namespace Application\Controllers;


use Application\Models\IframeModel;
use Application\Services\IframeService;

class IframeController extends BaseController
{
    public function getLandingByRubricIdAction($id, $style, $theme){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getLandingTemplateObj($id, $style, $theme);

        $this->json( $template );
    }

    public function getManyPageSiteByRubricIdAction($id, $style, $theme){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getManyPageSiteTemplateObj($id, $style, $theme);

        $this->json( $template );
    }







}