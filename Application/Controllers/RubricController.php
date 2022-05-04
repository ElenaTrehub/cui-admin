<?php


namespace Application\Controllers;


use Application\Services\RubricService;

class RubricController extends BaseController
{

    public function rubricListAction($lang){
        $rubricService = new RubricService();

        $rubrics = $rubricService->GetRubrics($lang);


        $this->json( $rubrics );
    }

    public function subrubricListAction($idRubric, $lang){
        $rubricService = new RubricService();

        $subrubrics = $rubricService->GetSubRubrics($idRubric, $lang);


        $this->json( $subrubrics );
    }

}