<?php


namespace Application\Core\Space;



use Application\Services\IframeService;
use Application\Services\SpaceService;
use Application\Services\UtilsService;

class SpaceBuilder
{

    public $utilsService;
    public $spaceService;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->spaceService = new SpaceService();
    }

    public function getSpaceObj($id){

        $spaceId = $this->getSpacesByRubricId($id);
        $space = $this->spaceService->getSpaceById($spaceId);

        return $space[0];
    }

    public function getSpacesByRubricId($id){

        $spaces = $this->spaceService->getSpacesByRubricId($id);

        $spaceArray = [];
        foreach ($spaces as $item){
            $nextSpace = $this->spaceService->getSpaceById($item->idSpace)[0];
            $spaceArray[] = $nextSpace;
        }

        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($spaces)-1);
            $spaceId = $spaces[$index]->idSpace;
        }
        else{
            $spaceId = $this->utilsService->getItemByWeight($spaceArray)->idSpace;

        }


        return $spaceId;
    }

}