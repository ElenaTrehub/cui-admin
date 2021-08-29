<?php


namespace Application\Services;


use Application\Utils\MySQL;

class ServicePageService
{
    public function getServicePageById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM servicepage WHERE idServicePage = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $servicePage = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $servicePage;
    }
    public function getServicePageByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM servicepage_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $servicePages = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $servicePages;

    }
}