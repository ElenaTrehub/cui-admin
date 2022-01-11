<?php


namespace Application\Services;


use Application\Utils\MySQL;

class IndexPageService
{
    public function getIndexPageById($id){

        $stm = MySQL::$db->prepare("SELECT * FROM indexpage WHERE idIndexPage = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $indexPage = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $indexPage;
    }
    public function getIndexPageByIdAndStyle($id, $style){

        $stm = MySQL::$db->prepare("SELECT * FROM indexpage WHERE idIndexPage = :id AND style = :styleStr");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->bindParam(':styleStr', $style, \PDO::PARAM_STR);

        $stm->execute();

        $indexPage = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $indexPage;
    }
    public function getIndexPageByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM indexpage_rubrics WHERE id = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $indexPages = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $indexPages;

    }

}