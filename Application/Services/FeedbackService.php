<?php


namespace Application\Services;


use Application\Utils\MySQL;

class FeedbackService
{

    public function getFeedbacksByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM feedbacks_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $feedbacks = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $feedbacks;

    }


    public function getFeedbackById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM feedback WHERE idFeedback = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $feedback = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $feedback;
    }
    public function getFeedbackByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM feedback WHERE idFeedback = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $feedback = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $feedback;
    }

}