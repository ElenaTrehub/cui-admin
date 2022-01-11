<?php


namespace Application\Models;


use Application\Core\Builder;

class SectionModel
{
    public function getSectionsByName($id, $sectionName, $styleName){

        $builder = new Builder();

        return $builder->getSectionsByName($id, $sectionName, $styleName);

    }

    public function getChooseSection($id, $sectionName, $styleName, $theme, $sectionId, $typeSite){

        $builder = new Builder();

        return $builder->getChooseSection($id, $sectionName, $styleName, $theme, $sectionId, $typeSite);

    }

    public function getAddSection($id, $sectionName, $styleName, $typeSite, $theme){

        $builder = new Builder();

        return $builder->getAddSection($id, $sectionName, $styleName, $typeSite, $theme);

    }

    public function getSectionNames(){

        $builder = new Builder();

        return $builder->getSectionNames();

    }
}