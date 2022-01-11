<?php


namespace Application\Controllers;


use Application\Models\IframeModel;
use Application\Models\SectionModel;

class SectionController extends BaseController
{
    public function getSectionsByName($id, $sectionName, $styleName){

        $sectionModel = new SectionModel();

        $sections = $sectionModel->getSectionsByName($id, $sectionName, $styleName);

        $this->json( $sections );
    }

    public function getChooseSection($id, $sectionName, $styleName, $theme, $sectionId, $typeSite){

        $sectionModel = new SectionModel();

        $sections = $sectionModel->getChooseSection($id, $sectionName, $styleName, $theme, $sectionId, $typeSite);

        $this->json( $sections );
    }

    public function getAddSection($id, $sectionName, $styleName, $typeSite, $theme){

        $sectionModel = new SectionModel();

        $sections = $sectionModel->getAddSection($id, $sectionName, $styleName, $typeSite, $theme);

        $this->json( $sections );
    }

    public function getSectionNames(){
        $sectionModel = new SectionModel();

        $sectionNames = $sectionModel->getSectionNames();

        $this->json( $sectionNames );
    }
}