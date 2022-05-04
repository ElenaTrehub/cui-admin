<?php


namespace Application\Models;


use Application\Core\Builder;

class IframeModel
{
//Вызываю построение сайта из програмного ядра
    public function getLandingTemplateObj($id, $style, $theme, $lang){

        $builder = new Builder();

        return $builder->getLandingTemplateObjCore($id, $style, $theme, $lang);

    }
    public function getManyPageSiteTemplateObj($id, $style, $theme, $lang){

        $builder = new Builder();

        return $builder->getManyPageSiteTemplateObjCore($id, $style, $theme, $lang);

    }
}