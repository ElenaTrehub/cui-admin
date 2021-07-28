<?php


namespace Application\Core\Settings;


use Application\Services\UtilsService;

class Settings
{
    public $photoDir;

    public function __construct()
    {
        $this->photoDir = [
           6 => 'auto'
        ];
    }
    public function getPhotoFolderName($rubricId){
        return $this->photoDir[$rubricId];
    }
}