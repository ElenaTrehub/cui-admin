<?php

namespace Application\Controllers;


use Application\Utils\Request;
use Application\Utils\Storage;


class BaseController
{
    protected $request;
    protected $storage;

    public function __construct(){

        //$userService = new UserService();

        //$this->currentUser = $userService->getCurrentUser();

        $this->request = new Request();
        $this->storage = new Storage();

    }//__construct

    protected function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param mixed $storage
     */
    protected  function setStorage($storage){
        $this->storage = $storage;
    }//setStorage

    protected function createUrl( $controller , $action ){

        return "?ctrl=$controller&act=$action";

    }

    protected function json(  $data ){

        header('Access-Control-Allow-Origin: http://cui-admin:1252');
        header('Content-type: application/json');
        echo json_encode($data); //  res.send();
        exit();

    }//json
}