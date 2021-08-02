<?php


namespace Application\Core\JsLibs;


class JsLibs
{
    public function getJsLib($nameLim){

        $jslFile = '../Application/Core/JsLibs/jslibs/'.$nameLim.'.js';

        return $jslFile ? file_get_contents($jslFile) : '';

    }


}