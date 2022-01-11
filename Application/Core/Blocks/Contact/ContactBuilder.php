<?php


namespace Application\Core\Blocks\Contact;


use Application\Services\AboutService;
use Application\Services\ContactService;
use Application\Services\UtilsService;

class ContactBuilder
{
    public $utilsService;
    public $contactService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->contactService = new ContactService();
    }

    public function getTemplate($id, $style, $settings, $idStr, $isLanding, $userContactId = null){

        $contactId = is_null($userContactId) ? $this->getContactByRubricIdAction($id, $style) : $userContactId;


        //$contactId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Contact/templates/template'.$contactId;



        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Contact\templates\template'.$contactId.'\ContactTemplate'.$contactId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            if($isLanding === true){
                $html = $this->utilsService->setLandingSectionName($htmlString, $idStr);
            }
            else{
                $html = $this->utilsService->setManyPageSectionName($htmlString, $idStr);
            }

            $style = $this->setFontStyle($styleString, $settings->fonts);


            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder, $settings, $id);



            $about = new \stdClass();
            $about->html = $obj->html;
            $about->css = $obj->style;
            $about->js = $obj->js;
            $about->set = $obj->set;

            return $about;
        }


    }
    public function getSectionsByName($id, $styleName){

        $contacts = $this->contactService->getConsultationsByRubricId($id);

        $consultationsArray = [];
        foreach ($contacts as $key=>$item){

            $nextContact = $this->contactService->getConsultationById($item->idContact)[0];

            if(count($nextContact)>0){
                $consultationsArray[] = $nextContact;
            }

        }

        $contactsStyleArray = [];

        foreach($consultationsArray as $key=>$contact){
            if($contact->style === $styleName){
                $contactsStyleArray[]= $contact;
            }
        }

        return $contactsStyleArray;

    }
    public function getContactByRubricIdAction($id, $style){

        $contacts = $this->contactService->getConsultationsByRubricId($id);


        $contactsArray = [];
        foreach ($contacts as $key=>$item){
            if($style === 'all'){
                $nextContact = $this->contactService->getConsultationById($item->idContact)[0];
            }
            else{
                $nextContact = $this->contactService->getConsultationByIdAndStyle($item->idContact, $style)[0];
            }
            if(count($nextContact)>0){
                $contactsArray[] = $nextContact;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($contacts)-1);
            $contactId = $contacts[$index]->idContact;
        }
        else{
            $contactId = $this->utilsService->getItemByWeight($contactsArray)->idContact;
        }

        return $contactId;
    }

    public function setFontStyle($style, $fonts){


        return $style;
    }





    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }

}