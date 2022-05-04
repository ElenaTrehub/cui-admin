<?php


namespace Application\Services;
use Application\Utils\MySQL;

class SettingService
{
    public function getLandingMenu($id, $lang){
        $stmLanding = MySQL::$db->prepare(
            "SELECT * FROM landingmenu_subrubrics  WHERE idSubrubrics=:id"
        );
        $stmLanding->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmLanding->execute();
        $objLandingMenu = $stmLanding->fetchAll(\PDO::FETCH_OBJ);
        $idLandingMenu = +$objLandingMenu[0]->idLandingMenu;

        $stm = MySQL::$db->prepare(
            "SELECT landing_menu.menuStr, lang_landing_menu.langMenuStr FROM landing_menu
                LEFT JOIN lang_landing_menu ON lang_landing_menu.idLandingMenu=landing_menu.idLandingMenu WHERE lang_landing_menu.lang=:lang && landing_menu.idLandingMenu=:id"
        );
        $stm->bindParam(':id', $idLandingMenu, \PDO::PARAM_INT);
        $stm->bindParam(':lang', $lang, \PDO::PARAM_STR);
        $stm->execute();

        $landing_menu = $stm->fetchAll(\PDO::FETCH_OBJ);

        //var_dump($landing_menu[0]);
        return $landing_menu[0];

    }//GetRubrics

    public function getTranslate($key, $lang){
        $stm = MySQL::$db->prepare(
            "SELECT textTranslate FROM translate  WHERE keyValue=:key && lang=:lang"
        );
        $stm->bindParam(':key', $key, \PDO::PARAM_STR);
        $stm->bindParam(':lang', $lang, \PDO::PARAM_STR);
        $stm->execute();

        $translate = $stm->fetchAll(\PDO::FETCH_OBJ);

        return $translate[0]->textTranslate;

    }
}