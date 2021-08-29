<?php


namespace Application\Controllers;

use Application\Services\FontService;

class FontController extends BaseController
{
    public function fontListAction(){
        $fontService = new FontService();

        $fonts = $fontService->getFonts();


        $this->json( $fonts );
    }

}