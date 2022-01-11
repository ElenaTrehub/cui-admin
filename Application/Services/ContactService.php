<?php


namespace Application\Services;


use Application\Utils\MySQL;

class ContactService
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

    public function getConsultationById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM consultation WHERE idContact = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $consultation = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $consultation;
    }

    public function getConsultationByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM consultation WHERE idContact = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $consultation = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $consultation;
    }
}