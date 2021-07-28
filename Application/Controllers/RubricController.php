<?php


namespace Application\Controllers;


use Application\Services\RubricService;

class RubricController extends BaseController
{
    public function rubricAction(){
        echo('Rubric');
    }
    public function rubricListAction(){
        $rubricService = new RubricService();

        $rubrics = $rubricService->GetRubrics();


        $this->json( $rubrics );
    }

}