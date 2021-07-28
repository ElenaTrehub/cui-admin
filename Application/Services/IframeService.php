<?php


namespace Application\Services;
use Application\Utils\MySQL;

class IframeService
{








    public function getConsultationsByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM consultations_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $consultations = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $consultations;

    }
    public function getFootersByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM footers_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $footers = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $footers;

    }

















    public function getConsultationById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM consultation WHERE idConsultation = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $consultation = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $consultation;
    }

    public function getFooterById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM footer WHERE idFooter = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $footer = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $footer;
    }






}