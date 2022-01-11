<?php


namespace Application\Services;


use Application\Utils\MySQL;

class AboutPageService
{
    public function getAboutPageById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM aboutpage WHERE idAboutPage = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $aboutPage = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $aboutPage;
    }
    public function getAboutPageByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM aboutpage WHERE idAboutPage = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $aboutPage = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $aboutPage;
    }
    public function getAboutPageByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM aboutpage_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $aboutPages = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $aboutPages;

    }
}