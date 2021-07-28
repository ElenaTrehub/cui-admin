<?php


namespace Application\Models;


use Application\Core\Builder;

class IframeModel
{
//Вызываю построение сайта из програмного ядра
    public function getTemplateObj($id){

        $builder = new Builder();

        return $builder->getTemplateObjCore($id);

    }
}