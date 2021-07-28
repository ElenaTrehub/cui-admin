<?php


namespace Application\Services;
use Application\Utils\MySQL;

class ColorService
{
    public function getColorsByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM colors_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $colors = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $colors;

    }

    public function getColorById($id){


        $stm = MySQL::$db->prepare("SELECT * FROM color WHERE idColor = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $color = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $color;
    }

}