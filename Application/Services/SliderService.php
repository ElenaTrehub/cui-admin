<?php


namespace Application\Services;


use Application\Utils\MySQL;

class SliderService
{
    public function getMainsBySubRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM mains_subrubrics WHERE idSubrubric = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $mains = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $mains;

    }

    public function getMainById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM main WHERE idMain = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $main = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $main;
    }

    public function getMainByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM main WHERE idMain = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $main = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $main;
    }

}