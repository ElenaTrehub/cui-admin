<?php


namespace Application\Services;


use Application\Utils\MySQL;

class ServiceService
{
    public function getServiceById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM services WHERE idService = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $service = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $service;
    }
    public function getServiceByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM services WHERE idService = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $service = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $service;
    }
    public function getServiceByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM services_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $services = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $services;

    }



}





