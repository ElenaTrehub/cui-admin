<?php


namespace Application\Controllers;


use Application\Models\IframeModel;
use Application\Services\IframeService;

class IframeController extends BaseController
{
    public function getLandingByRubricIdAction($id){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getLandingTemplateObj($id);

        $this->json( $template );
    }

    public function getManyPageSiteByRubricIdAction($id){

        $iframeModel = new IframeModel();

        $template = $iframeModel->getManyPageSiteTemplateObj($id);

        $this->json( $template );
    }







}