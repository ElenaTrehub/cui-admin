<?php


namespace Application\Services;
use Application\Utils\MySQL;

class HeaderService
{
    public function getHeadersByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM headers_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $headers = $stm->fetchAll(\PDO::FETCH_OBJ);


        return $headers;

    }

    public function getHeaderById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM header WHERE idHeader = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $header = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $header;
    }

    public function getHeaderByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM header WHERE idHeader = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $header = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $header;
    }

}