<?php


namespace Application\Services;


use Application\Utils\MySQL;

class AboutService
{
    public function getAboutById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM about WHERE idAbout = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $about = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $about;
    }
    public function getAboutByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM about_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $abouts = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $abouts;

    }

}