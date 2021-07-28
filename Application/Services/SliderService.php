<?php


namespace Application\Services;


use Application\Utils\MySQL;

class SliderService
{
    public function getMainsByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM mains_rubrics WHERE id = :id"
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

}