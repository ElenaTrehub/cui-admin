<?php

namespace Application\Services;

use Application\Utils\MySQL;

class RubricService
{
    public function GetRubrics(){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM rubric"
        );
        $stm->execute();

        $rubrics = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $rubrics;

    }//GetRubrics
}