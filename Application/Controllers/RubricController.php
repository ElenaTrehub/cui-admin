<?php


namespace Application\Controllers;


use Application\Services\RubricService;

class RubricController extends BaseController
{

    public function rubricListAction(){
        $rubricService = new RubricService();

        $rubrics = $rubricService->GetRubrics();


        $this->json( $rubrics );
    }

}