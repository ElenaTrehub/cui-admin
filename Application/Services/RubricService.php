<?php

namespace Application\Services;

use Application\Utils\MySQL;

class RubricService
{
    public function GetRubrics($lang){

        $stm = MySQL::$db->prepare(
            "SELECT rubric.id, rubric.image, lang_rubric.title, lang_rubric.alt FROM rubric LEFT JOIN lang_rubric ON lang_rubric.rubric_id=rubric.id WHERE lang_rubric.lang=:lang"
        );
        $stm->bindParam(':lang', $lang, \PDO::PARAM_STR);
        $stm->execute();

        $rubrics = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $rubrics;

    }//GetRubrics

    public function GetSubRubrics($idRubric, $lang){

        $subrubricArray = array();

        $subrubrics = MySQL::$db->prepare("SELECT * FROM subrubric WHERE rubricId=:idRubric");
        $subrubrics->bindParam(':idRubric', $idRubric, \PDO::PARAM_INT);

        if($subrubrics){
            if ($subrubrics->execute()) {

                while ($subrubric = $subrubrics->fetch()) {
                    //var_dump($subrubric);
                    $idSubrubric = $subrubric['subrubricId'];
                    //echo($idSubrubric);
                    $stm = MySQL::$db->prepare(
                        "SELECT * FROM lang_subrubric WHERE (idSubrubric = :idSubrubric) AND (lang=:lang)"
                    );
                    $stm->bindParam(':idSubrubric', $idSubrubric, \PDO::PARAM_INT);
                    $stm->bindParam(':lang', $lang, \PDO::PARAM_STR);
                    $stm->execute();
                    $subrubricItem = $stm->fetchAll(\PDO::FETCH_OBJ);



                    $subrubricArray[] = $subrubricItem[0];
                }


            }
        }

        return $subrubricArray;

    }//GetRubrics
}