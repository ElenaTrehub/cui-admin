<?php


namespace Application\Core\Blocks\Header;


use Application\Core\Header\templates\template1\HeaderTemplate1;
use Application\Core\Header\templates\template2\HeaderTemplate2;
use Application\Core\Header\templates\template3\HeaderTemplate3;

use Application\Core\Settings\Settings;
use Application\Services\HeaderService;
use Application\Services\UtilsService;

class HeaderBuilder
{
//основная логика хедера и общие вычисления
    public $utilsService;
    public $headerService;
    public $settings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->headerService = new HeaderService();
        $this->settings = new Settings();
    }

    public function getTemplate($id, $style, $settings, $menu, $isLanding, $userHeaderId = null){

        $headerId = is_null($userHeaderId) ? $this->getHeaderByRubricIdAction($id, $style) : $userHeaderId;

        //$headerId = 2;
        $pathToTemplate = '../Application/Core/Blocks/Header/templates/template'.$headerId;

        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Header\templates\template'.$headerId.'\HeaderTemplate'.$headerId;
        $jslFile = $pathToTemplate."/main.js";


        if($styleFile) {

            $styleString = file_get_contents($styleFile);
            $htmlString = file_get_contents($htmlFile);
            $jsString = file_get_contents($jslFile);

            if($isLanding === true){
                $html = $this->setLandingMenu($htmlString, $menu);
            }
            else{

                $html = $this->setManyPageSiteMenu($htmlString, $menu);
            }


            $style = $this->setFontStyle($styleString, $settings->fonts);

            $style = $this->setSpaceStyle($style, $settings->spaces);

            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder,  $settings);

            //printf($obj->html);

            $header = new \stdClass();
            $header->html = $obj->html;
            $header->css = $obj->style;
            $header->js = $obj->js;
            $header->set = $obj->set;


            return $header;
        }


    }

    public function getSectionsByName($id, $styleName){

        $headeres = $this->headerService->getHeadersByRubricId($id);

        $headersArray = [];
        foreach ($headeres as $key=>$item){

            $nextHeader = $this->headerService->getHeaderById($item->idHeader)[0];

            if(count($nextHeader)>0){
                $headersArray[] = $nextHeader;
            }

        }

        $headersStyleArray = [];

        foreach($headersArray as $key=>$header){
            if($header->style === $styleName){
                $headersStyleArray[]= $header;
            }
        }

        return $headersStyleArray;

    }
    public function getHeaderByRubricIdAction($id, $style){

        $headers = $this->headerService->getHeadersByRubricId($id);



        $headerArray = [];
        foreach ($headers as $key=>$item){
            if($style === 'all'){
                $nextHeader = $this->headerService->getHeaderById($item->idHeader)[0];
            }
            else{

                $nextHeader = $this->headerService->getHeaderByIdAndStyle($item->idHeader, $style)[0];
            }
            if(count($nextHeader)>0){
                $headerArray[] = $nextHeader;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($headers)-1);
            $headerId = $headers[$index]->idHeader;
        }
        else{
            $headerId = $this->utilsService->getItemByWeight($headerArray)->idHeader;
        }

        return $headerId;
    }


    public function setLandingMenu($htmlString, $menu){

        $menuStr = '';

        for ($i = 0; $i < count($menu); $i++){

            $translate = $this->settings->getTranslateForMenu($menu[$i], 'ru');
            $linkStr = lcfirst($menu[$i]);
            $menuStr = $menuStr."<li><a class='linkSize' href='#{$linkStr}'> $translate </a></li>";

        }


        if(strpos($htmlString, '<!--landingMenu-->',0)!==false){
            $htmlString = $this->utilsService->parseStyle($htmlString, '<!--landingMenu-->', $menuStr);
        }
        return $htmlString;
    }
    public function setManyPageSiteMenu($htmlString, $menu){
        $menuStr = '';
        foreach ($menu as $key => $value) {

            $translate = $this->settings->getTranslateForMenu($key, 'ru');
            $linkStr = lcfirst($key);

            if (count($value) > 0) {
                $menuIntoStr = '';
                foreach ($value as $keyInto => $valueInto) {

                    $translateInto = $this->settings->getTranslateForMenu($keyInto, 'ru');
                    $linkIntoStr = lcfirst($keyInto);



                    if (count($valueInto) > 0) {

                        $menuIntoSecondStr = '';
                        foreach ($valueInto as $keyIntoSecond => $valueIntoSecond) {
                            $translateInto = $this->settings->getTranslateForMenu($keyIntoSecond, 'ru');
                            $linkIntoStr = lcfirst($keyIntoSecond);

                            $menuIntoSecondStr = $menuIntoSecondStr . "<li><a class='linkSize' href='{$linkIntoStr}.html'> $translateInto </a></li>";

                        }
                        $menuIntoStr = $menuIntoStr . "<li><a class='linkSize' href='{$linkIntoStr}.html'> $translateInto </a>
                                        <ul>
                                            {$menuIntoSecondStr}
                                        </ul>
                                    </li>";

                    }
                    else{
                        $menuIntoStr = $menuIntoStr . "<li><a class='linkSize' href='{$linkIntoStr}.html'> $translateInto </a></li>";
                    }


                }

                $menuStr = $menuStr . "<li><a class='linkSize' href='{$linkStr}.html'> $translate </a>
                                        <ul>
                                            {$menuIntoStr}
                                        </ul>
                                    </li>";
            } else {
                $menuStr = $menuStr . "<li><a class='linkSize' href='{$linkStr}.html'> $translate </a></li>";
            }


        }


        if(strpos($htmlString, '<!--landingMenu-->',0)!==false){
            $htmlString = $this->utilsService->parseStyle($htmlString, '<!--landingMenu-->', $menuStr);
        }
        if(strpos($htmlString, '<!--landingSmallMenu-->',0)!==false){
            $htmlString = $this->utilsService->parseStyle($htmlString, '<!--landingSmallMenu-->', $menuStr);
        }
        return $htmlString;
    }

    public function setFontStyle($style, $fonts){


        $textTransform = ['none', 'uppercase'];
        $index = rand(0, 2);
        if(strpos($style, '/*menu_f_transform*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*menu_f_transform*/', 'text-transform: '.$textTransform[$index].';');
        }

        return $style;
    }

    public function setSpaceStyle($style, $spaces){

        if(strpos($style, '/*h_t_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_t_p*/', 'padding: '.$spaces->headerSmallSpace.';');
        }

        if(strpos($style, '/*h_m_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_m_p*/', 'padding: '.$spaces->headerBigSpace.';');
        }

        if(strpos($style, '/*h_b_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*h_b_p*/', 'padding: '.$spaces->headerBigSpace.';');
        }

        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings);

    }


}