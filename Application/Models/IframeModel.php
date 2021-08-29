<?php


namespace Application\Models;


use Application\Core\Builder;

class IframeModel
{
//Вызываю построение сайта из програмного ядра
    public function getLandingTemplateObj($id){

        $builder = new Builder();

        return $builder->getLandingTemplateObjCore($id);

    }
    public function getManyPageSiteTemplateObj($id){

        $builder = new Builder();

        return $builder->getManyPageSiteTemplateObjCore($id);

    }
}