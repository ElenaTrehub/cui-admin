<?php
namespace Application\Controllers;
use Bramus\Router\Router;
use Application\Utils\MySQL;

class ApplicationController
{
    public function Start(  ){

        date_default_timezone_set('Europe/Moscow');


        //session_start([
            //'cookie_lifetime' => 86400,
        //]);
        $hostname = 'localhost';
        //$username = 'neoguk';
        //$password = 'neoguk123';
        $username = 'root';
        $password = 'root';
        $dbName = 'creator';
        MySQL::$db = new \PDO(
            "mysql:dbname={$dbName};host={$hostname}",
            $username,
           $password
        );

        $router = new Router();



        $routes = include_once '../Application/Models/PublicRoutes.php';
        $router->setNamespace('Application\\Controllers');
//var_dump($routes);
        $router->setBasePath('/');
        foreach ($routes as $key => $path ){

            foreach ($path as $subKey => $value){

                $router->$key( $subKey , $value );

            }//foreach

        }//foreach

        $router->run();

    }//Start
}