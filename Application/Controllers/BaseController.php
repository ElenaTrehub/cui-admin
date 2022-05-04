<?php

namespace Application\Controllers;


use Application\Utils\Request;
use Application\Utils\Storage;
use http\Cookie;


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

        header('Access-Control-Allow-Origin: http://cui-prog:1252');
        //header('Access-Control-Allow-Credentials: true');
        //header('Access-Control-Request-Headers: Content-Type, API-Key');
        //header('Content-type: application/json');
        //header('Set-Cookie: SameSite=None; Secure');
        //header('Set-Cookie: session='.session_id().'; SameSite=None', false);
        //setcookie('session', session_id());
        echo json_encode($data); //  res.send();
        exit();

    }//json
}