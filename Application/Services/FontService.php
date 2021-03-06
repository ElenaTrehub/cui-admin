<?php


namespace Application\Services;
use Application\Utils\MySQL;

class FontService
{
    public function getFonts(){

        $stm = MySQL::$db->prepare("SELECT * FROM fonts");

        $stm->execute();

        $fonts = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $fonts;
    }

    public function getFontById($id){


        $stm = MySQL::$db->prepare("SELECT * FROM fonts WHERE idFont = :id");
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);

        $stm->execute();

        $font = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $font;
    }

    public function getFontsByRubricId($id){

        $stm = MySQL::$db->prepare(
            "SELECT * FROM fonts_subrubrics WHERE idSubrubrics = :id"
        );
        $stm->bindParam(':id', $id, \PDO::PARAM_INT);
        $stm->execute();

        $fonts = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $fonts;

    }
}