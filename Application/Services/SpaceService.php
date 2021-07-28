<?php


namespace Application\Services;
use Application\Utils\MySQL;

class SpaceService
{
    public function getSpacesByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM spaces_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $spaces = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $spaces;

    }

    public function getSpaceById($id){


        $stm = MySQL::$db->prepare("SELECT * FROM spaces WHERE idSpace = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $space = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $space;
    }
}