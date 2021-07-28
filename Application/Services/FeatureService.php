<?php


namespace Application\Services;


use Application\Utils\MySQL;

class FeatureService
{
    public function getFeaturesByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM features_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $features = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $features;

    }
    public function getFeatureById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM feature WHERE idFeature = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $feature = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $feature;
    }
}