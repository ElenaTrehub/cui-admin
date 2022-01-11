<?php


namespace Application\Services;


use Application\Utils\MySQL;

class FooterService
{
    public function getFootersByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM footers_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $footers = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $footers;

    }
    public function getFooterById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM footer WHERE idFooter = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $footer = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $footer;
    }
    public function getFooterByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM footer WHERE idFooter = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $footer = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $footer;
    }
}