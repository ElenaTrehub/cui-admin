<?php


namespace Application\Core\Blocks\Scroll;


use Application\Core\JsLibs\JsLibs;
use Application\Services\ServiceService;
use Application\Services\UtilsService;

class ScrollBuilder
{
    public $utilsService;
    public $serviceService;
    public $jsLibs;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->serviceService = new ServiceService();
        $this->jsLibs = new JsLibs();
    }

    public function getTemplate($settings){

        $pathToTemplate = '../Application/Core/Blocks/Scroll/template';

        $htmlFile = $pathToTemplate."/index.html";
        $jslFile = $pathToTemplate."/main.js";


        if($htmlFile) {

            $styleString = '';
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);



            $index = rand(0, 2);
            $index = 0;
            switch ($index) {
                case 0:
                {
                    $styleString = '.pageup {
  opacity: 0;
  width: 26px ;
  height: 26px;
  position: fixed;
  bottom: 100px;
  right: 5%;
  z-index: 3000;
  background-color: '.$settings->colors->thirdBg.';
  cursor: pointer;
  transition: 1s all;
}';
                    break;
                }
            }

            $obj = new \stdClass();
            $obj->html = $htmlString;
            $obj->css = $styleString;
            $obj->js = $jsString;
            $obj->set = $settings;



            if(isset($obj->set->scrolling) && $obj->set->scrolling === true){
                if(strpos($obj->js, '//js_code_scroll',0)!==false){
                    $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_scroll', 'scrolling(".pageup");');
                }
            }
            else{
                $obj->set->scrolling = true;
                if(strpos($obj->js, '//js_code_scroll',0)!==false){
                    $obj->js = $this->utilsService->parseStyle($obj->js, '//js_code_scroll', $this->jsLibs->getJsLib('scrolling').'scrolling(".pageup");');
                }
            }


            return $obj;
        }


    }






}