<?php


namespace Application\Utils;


class Storage
{
    private $storage = [];

    public function __get($name){

        if( isset( $this->storage[$name] ) ){
            return $this->storage[$name];
        }//if

        return null;

    }//__get


    //$storage->langs = [ 'RU' , 'EN' ];

    public function __set($name, $value){

        $this->storage[ $name ] = $value;

    }//__set

    function getRawStorage(){
        return $this->storage;
    }

}