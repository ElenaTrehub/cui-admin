<?php


namespace Application\Core\Blocks\Footer;


use Application\Core\Settings\Settings;
use Application\Services\FooterService;
use Application\Services\UtilsService;

class FooterBuilder
{
    public $utilsService;
    public $footerService;
    public $settings;

    public function __construct()
    {
        $this->utilsService = new UtilsService();
        $this->footerService = new FooterService();
        $this->settings = new Settings();
    }

    public function getTemplate($id, $style, $settings, $menu, $isLanding, $userFooterId = null){
        $footerId = is_null($userFooterId) ? $this->getFooterByRubricIdAction($id, $style) : $userFooterId;

        //$footerId = 3;
        $pathToTemplate = '../Application/Core/Blocks/Footer/templates/template'.$footerId;

        $styleFile = $pathToTemplate."/style.css";
        $htmlFile = $pathToTemplate."/index.html";
        $UniqueStyleBuilder = 'Application\Core\Blocks\Footer\templates\template'.$footerId.'\FooterTemplate'.$footerId;
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

            //$style = $this->setPositionStyle($styleString);
            $style = $this->setFontStyle($styleString, $settings->fonts);

            $style = $this->setSpaceStyle($style, $settings->spaces);

            $obj = $this->setUniqueStyle($style, $html, $jsString, $UniqueStyleBuilder, $settings, $id);



            $footer = new \stdClass();
            $footer->html = $obj->html;
            $footer->css = $obj->style;
            $footer->js = $obj->js;
            $footer->set = $obj->set;


            return $footer;
        }


    }

    public function getSectionsByName($id, $styleName){

        $footers = $this->footerService->getFootersByRubricId($id);

        $footersArray = [];
        foreach ($footers as $key=>$item){

            $nextFooter = $this->footerService->getFooterById($item->idFooter)[0];

            if(count($nextFooter)>0){
                $footersArray[] = $nextFooter;
            }

        }

        $footersStyleArray = [];

        foreach($footersArray as $key=>$footer){
            if($footer->style === $styleName){
                $footersStyleArray[]= $footer;
            }
        }

        return $footersStyleArray;

    }

    public function getFooterByRubricIdAction($id, $style){

        $footers = $this->footerService->getFootersByRubricId($id);

        $footerArray = [];
        foreach ($footers as $key=>$item){
            if($style === 'all'){
                $nextFooter = $this->footerService->getFooterById($item->idFooter)[0];
            }
            else{
                $nextFooter = $this->footerService->getFooterByIdAndStyle($item->idFooter, $style)[0];
            }
            if(count($nextFooter)>0){
                $footerArray[] = $nextFooter;
            }

        }
        $randInt = rand(0, 100);


        if($randInt < 20){
            $index = rand(0, count($footers)-1);
            $footerId = $footers[$index]->idFooter;
        }
        else{
            $footerId = $this->utilsService->getItemByWeight($footerArray)->idFooter;
        }

        return $footerId;
    }


    public function setLandingMenu($htmlString, $menu){

        $menuStr = '';

        for ($i = 0; $i < count($menu); $i++){

            $translate = $this->settings->getTranslateForMenu($menu[$i], 'ru');
            $linkStr = lcfirst($menu[$i]);
            $menuStr = $menuStr."<li><a class='linkSize'  href='#{$linkStr}'> $translate </a></li>";

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

                    $menuIntoStr = $menuIntoStr . "<li><a class='linkSize' href='{$linkIntoStr}.html'> $translateInto </a></li>";
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
        return $htmlString;
    }



    public function setFontStyle($style, $fonts){

        $textTransform = ['none', 'uppercase'];
        $index = rand(0, 2);


        if(strpos($style, '/*footer_top_li_transform*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*footer_top_li_transform*/', 'text-transform: '.$textTransform[$index].';');
        }

        return $style;
    }

    public function setSpaceStyle($style, $spaces){

        if(strpos($style, '/*footer_b_p*/',0)!==false){
            $style = $this->utilsService->parseStyle($style, '/*footer_b_p*/', 'padding: '.$spaces->footerSmallSpace.';');
        }


        return $style;
    }

    public function setUniqueStyle($styleString, $htmlString, $jsString, $UniqueStyleBuilder, $settings, $id){

        $uniqueStyleBuilder = new $UniqueStyleBuilder();

        return $uniqueStyleBuilder->setUniqueStyle($styleString, $htmlString, $jsString, $settings, $id);

    }
}