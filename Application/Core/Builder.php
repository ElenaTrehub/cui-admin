<?php


namespace Application\Core;



use Application\Core\Blocks\About\AboutBuilder;
use Application\Core\Color\ColorBuilder;
use Application\Core\Blocks\Contact\ContactBuilder;
use Application\Core\Blocks\Feature\FeatureBuilder;
use Application\Core\Blocks\Feedback\FeedbackBuilder;
use Application\Core\Font\FontBuilder;
use Application\Core\Blocks\Footer\FooterBuilder;
use Application\Core\GlobalStyle\GlobalStyleBuilder;
use Application\Core\Blocks\Header\HeaderBuilder;
use Application\Core\Blocks\Scroll\ScrollBuilder;
use Application\Core\Blocks\Service\ServiceBuilder;
use Application\Core\Blocks\Main\MainBuilder;
use Application\Core\Pages\AboutPage\AboutPageBuilder;
use Application\Core\Pages\IndexPage\IndexPageBuilder;
use Application\Core\Settings\Settings;
use Application\Core\Space\SpaceBuilder;
use Application\Services\UtilsService;


class Builder
{
//ызов всех классов для построения сайта

    public $headerBuilder;
    public $colorBuilder;
    public $fontBuilder;
    public $spaceBuilder;
    public $globalStyleBuilder;
    public $sliderBuilder;
    public $aboutBuilder;
    public $featureBuilder;
    public $serviceBuilder;
    public $feedbackBuilder;
    public $contactBuilder;
    public $footerBuilder;
    public $scrollBuilder;

    public $utilsService;
    public $settings;

    public $indexPageBuilder;
    public $aboutPageBuilder;

    public function __construct()
    {
        $this->headerBuilder = new HeaderBuilder();
        $this->colorBuilder = new ColorBuilder();
        $this->fontBuilder = new FontBuilder();
        $this->fontBuilder = new FontBuilder();
        $this->spaceBuilder = new SpaceBuilder();
        $this->globalStyleBuilder = new GlobalStyleBuilder();
        $this->sliderBuilder = new MainBuilder();
        //$this->aboutBuilder = new AboutBuilder();
        $this->featureBuilder = new FeatureBuilder();
        $this->serviceBuilder = new ServiceBuilder();
        $this->feedbackBuilder = new FeedbackBuilder();
        $this->contactBuilder = new ContactBuilder();
        $this->footerBuilder = new FooterBuilder();
        $this->scrollBuilder = new ScrollBuilder();

        $this->utilsService = new UtilsService();
        $this->settings = new Settings();


        $this->indexPageBuilder = new IndexPageBuilder();
        $this->aboutPageBuilder = new AboutPageBuilder();

    }

    public function getGlobalsettings($id, $theme){
        $colors = $this->colorBuilder->getColorObj($id);
        $fonts = $this->fontBuilder->getFontObj($id);
        $spaces = $this->spaceBuilder->getSpaceObj($id);


        $settings = new \stdClass();

        $withBgBlock = array();
        $indexBg = 0;

        if($theme === 'any'){
            $themes = ['light', 'normal', 'dark'];
            $index = rand(0, 2);

            $withBgBlock= ['withBg', 'withoutBg'];
            $indexBg = rand(0, 1);
            //$indexBg = 0;
            $settings->theme = $themes[$index];
        }
        else{
            $settings->theme = $theme;
        }

        $settings->withBg = $withBgBlock[$indexBg];
        $settings->colors = $colors;
        $settings->fonts = $fonts;
        $settings->spaces = $spaces;
        $settings->libs = [];

        return $settings;
    }
    public function getLandingTemplateObjCore($id, $style, $theme, $lang): \stdClass
    {

        $menu = $this->settings->getLandingMenu($id, $lang);
        $currentSettings = $this->getGlobalsettings($id, $theme);




        $headerObj = $this->headerBuilder->getTemplate($id, $style, $currentSettings, $menu, true, $lang);

        $sliderObj = $this->sliderBuilder->getTemplate($id, $style, $headerObj->set, 'main', true, $lang);

        $childIframe = new \stdClass();
        $childIframe->html = '';
        $childIframe->css = '';
        $childIframe->js = '';
        $childIframe->libs = '';

        $currentSettings = $sliderObj->set;

        for ($i = 1; $i < count($menu); $i++){

            $builderStr = "Application\Core\Blocks\\$menu[$i]\\{$menu[$i]}Builder";

            $builder = new $builderStr();

            $nextObj = $builder->getTemplate($id, $style, $currentSettings, $menu[$i], true);
            $childIframe->html = $childIframe->html.$nextObj->html;
            $childIframe->css = $childIframe->css.'/*index-'.lcfirst($menu[$i]).'-start'.'*/'.$nextObj->css.'/*index-'.lcfirst($menu[$i]).'-end*/';
            $childIframe->js = $childIframe->js.'/*index-'.lcfirst($menu[$i]).'-start'.'*/'.'/*libs-start*/'.$nextObj->libs.'/*libs-end*/'.$nextObj->js.'/*index-'.lcfirst($menu[$i]).'-end*/';



            $currentSettings = $nextObj->set;

        }

        $footerObj = $this->footerBuilder->getTemplate($id, $style, $currentSettings, $menu, true);

        $scrollObj = $this->scrollBuilder->getTemplate($footerObj->set);

        $globalStyle = $this->globalStyleBuilder->getGlobalStyle($currentSettings->fonts, $currentSettings->spaces, $currentSettings->colors);

        //$globalFontSizeStyle = $this->globalStyleBuilder->getFontSizeStyle($settings->fonts);

        $jsStr = "let links = document.querySelectorAll('ul.menu-sitemap li a');
    links.forEach((item) =>{
        item.addEventListener('click', ()=> {

            links.forEach((itemLink) =>{
                if(itemLink.classList.contains('active')){
                    itemLink.classList.remove('active');
                }
            });

            item.classList.add('active');
        })
    })";

        $html = $headerObj->html.$sliderObj->html.$childIframe->html.$footerObj->html.$scrollObj->html;
        $css = '/*header-start*/'.$headerObj->css.'/*header-end'.'*/'.'/*main-start*/'.$sliderObj->css.'/*main-end*/'.$childIframe->css.'/*footer-start*/'.$footerObj->css.'/*footer-end*/'.$scrollObj->css;
        $js = '(function() { "use strict"; '.$jsStr.'/*header-start'.'*/'.'/*libs-start*/'.$headerObj->libs.'/*libs-end*/'.$headerObj->js.'/*header-end'.'*/'.'/*main-start'.'*/'.'/*libs-start*/'.$sliderObj->libs.'/*libs-end*/'.$sliderObj->js.'/*main-end'.'*/'.$childIframe->libs.$childIframe->js.'/*footer-start'.'*/'.'/*libs-start*/'.$footerObj->libs.'/*libs-end*/'.$footerObj->js.'/*footer-end'.'*/'.$scrollObj->js.'new WOW().init();})();';




        $iframe = new \stdClass();

        $this->cleanHtmlStr($html);

        $obj = new \stdClass();
        $obj->name = 'Index';
        $obj->html = $html;


        $iframe->html = [$obj];
        $iframe->css = $globalStyle.$css;
        $iframe->script = $js;
        $iframe->fontStyle = $currentSettings->fonts;
        $iframe->set = $scrollObj->set;

//print_r($iframe->script );
        return $iframe;
    }
    public function getManyPageSiteTemplateObjCore($id, $style, $theme, $lang): \stdClass
    {

        $menu = $this->settings->getSiteMenu($id);
        $currentSettings = $this->getGlobalsettings($id, $theme);

        $headerObj = $this->headerBuilder->getTemplate($id, $style, $currentSettings, $menu, false);
        $footerObj = $this->footerBuilder->getTemplate($id, $style,  $headerObj->set, $menu, false);

        $sliderObj = $this->sliderBuilder->getTemplate($id, $style, $footerObj->set, 'main', true);




        $pagesArray = new \stdClass();
        $pagesArray->html = [];
        $pagesArray->css = '';
        $pagesArray->js = '';


        $currentSettings = $sliderObj->set;

        foreach($menu as $key => $value){

            $builderStr = "Application\Core\Pages\\{$key}Page\\{$key}PageBuilder";
            $builder = new $builderStr();

            $nextPage = $builder->getPageTemplate($id, $style, $currentSettings, $key, false);
            $pagesArray->html  += [$key=>$nextPage->html];
            $pagesArray->css = $pagesArray->css.$nextPage->css;
            $pagesArray->js = $pagesArray->js.$nextPage->js;

            $currentSettings = $nextPage->set;

            if (count($value) > 0) {
                foreach ($value as $keyInto => $valueInto) {
                    $builderStr = "Application\Core\Pages\\{$keyInto}Page\\{$keyInto}PageBuilder";
                    $builder = new $builderStr();

                    $nextIntoPage = $builder->getPageTemplate($id, $style, $currentSettings, $keyInto, false);
                    $pagesArray->html += [$keyInto=>$nextIntoPage->html];
                    $pagesArray->css = $pagesArray->css.$nextIntoPage->css;
                    $pagesArray->js = $pagesArray->js.$nextIntoPage->js;

                    $currentSettings = $nextIntoPage->set;

                    if (count($valueInto) > 0) {
                        foreach ($valueInto as $keyIntoSecond => $valueIntoSecond) {

                            $builderStr = "Application\Core\Pages\\{$keyIntoSecond}Page\\{$keyIntoSecond}PageBuilder";
                            $builder = new $builderStr();

                            $nextIntoSecondPage = $builder->getPageTemplate($id, $style, $currentSettings, $keyIntoSecond, false);
                            $pagesArray->html += [$keyIntoSecond=>$nextIntoSecondPage->html];
                            $pagesArray->css = $pagesArray->css.$nextIntoSecondPage->css;
                            $pagesArray->js = $pagesArray->js.$nextIntoSecondPage->js;

                            $currentSettings = $nextIntoSecondPage->set;
                        }
                    }


                }
            }


        }





        $scrollObj = $this->scrollBuilder->getTemplate($footerObj->set);
        $globalStyle = $this->globalStyleBuilder->getGlobalStyle($currentSettings->fonts, $currentSettings->spaces, $currentSettings->colors);

        $jsStr = "let links = document.querySelectorAll('ul.menu-sitemap li a');
    links.forEach((item) =>{
        item.addEventListener('click', ()=> {

            links.forEach((itemLink) =>{
                if(itemLink.classList.contains('active')){
                    itemLink.classList.remove('active');
                }
            });

            item.classList.add('active');
        })
    })";

        //$indexObj = $this->indexPageBuilder->getPageTemplate($id, $settings);

        //$aboutObj = $this->aboutPageBuilder->getPageTemplate($id, $settings);



        $htmlArray = $pagesArray->html;
        $css = $headerObj->css.$footerObj->css.$sliderObj->css.$pagesArray->css;
        $js = '(function() { "use strict"; '.$jsStr.'/*header-start'.'*/'.'/*libs-start*/'.$headerObj->libs.'/*libs-end*/'.$headerObj->js.'/*header-end'.'*/'.'/*footer-start'.'*/'.'/*libs-start*/'.$footerObj->libs.'/*libs-end*/'.$footerObj->js.'/*footer-end'.'*/'.    '/*main-start'.'*/'.'/*libs-start*/'.$sliderObj->libs.'/*libs-end*/'.$sliderObj->js.'/*main-end'.'*/'.$pagesArray->js.'new WOW().init();})();';


//        $objFont = new \stdClass();
//        $objFont->name = $settings->fonts->nameFont;
//        $objFont->link = $settings->fonts->link;


        foreach($htmlArray as $key => &$value){
            $value = $this->addFooter($value, $footerObj->html);

            $value = $this->addHeader($value, $headerObj->html);



            $value = $this->addSlider($value, $sliderObj->html);
        }


        $iframe = new \stdClass();
        $iframeArray = [];

        foreach($htmlArray as $key => $valueIframe){

            $obj = new \stdClass();
            $obj->name = $key;
            $obj->html = $valueIframe;

            $iframeArray[]= $obj;

        }


        $this->cleanHtmlArray($iframeArray);



        $iframe->html = $iframeArray;
        $iframe->css = $globalStyle.$css;
        $iframe->script = $js;
        $iframe->fontStyle = $currentSettings->fonts;
        $iframe->set = $currentSettings;

        return $iframe;
    }

    public function cleanHtmlArray($htmlArray){
        foreach($htmlArray as $key => &$value){
            $value->html = str_replace(["\r\n", "  "], '', $value->html);
        }
    }
    public function cleanHtmlStr($htmlStr){

        return str_replace(["\r\n", "  "], '', $htmlStr);

    }
    public function addHeader($html, $headerHtml){
        if(strpos($html, '<!--header-->',0)!==false){
            $html = $this->utilsService->parseStyle($html, '<!--header-->', $headerHtml);
        }

        return $html;
    }
    public function addFooter($html, $footerHtml){

        if(strpos($html, '<!--footer-->',0)!==false){
            $html = $this->utilsService->parseStyle($html, '<!--footer-->', $footerHtml);
        }


        return $html;
    }

    public function addSlider($html, $sliderHtml){
        if(strpos($html, '<!--slider-->',0)!==false){
            $html = $this->utilsService->parseStyle($html, '<!--slider-->', $sliderHtml);
        }


        return $html;
    }

    public function getSectionsByName($id, $sectionName, $styleName){
        $name = ucfirst($sectionName);
        $builderStr = "Application\Core\Blocks\\{$name}\\{$name}Builder";

        $builder = new $builderStr();


        $nextObj = $builder->getSectionsByName($id, $styleName);


        return $nextObj;
    }

    public function getChooseSection($id, $sectionName, $styleName, $theme, $sectionId, $typeSite){
        $name = ucfirst($sectionName);
        $builderStr = "Application\Core\Blocks\\{$name}\\{$name}Builder";


        $builder = new $builderStr();

        $currentSettings = $this->getGlobalsettings($id, $theme);

        if($sectionName === 'header' || $sectionName === 'footer'){
            if($typeSite === 'landing'){
                $menu = $this->settings->getLandingMenu($id);
                $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $menu, true, $sectionId);
            }
            else{
                $menu = $this->settings->getSiteMenu($id);
                $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $menu, false, $sectionId);
            }


        }
        else{
            $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $sectionName, true, $sectionId);
        }




        return $nextObj;
    }

    public function getAddSection($id, $sectionName, $styleName, $typeSite, $theme){

        $name = ucfirst($sectionName);
        $builderStr = "Application\Core\Blocks\\{$name}\\{$name}Builder";

        $builder = new $builderStr();

        $currentSettings = $this->getGlobalsettings($id, $theme);


        if($sectionName === 'header' || $sectionName === 'footer'){
            if($typeSite === 'landing'){
                $menu = $this->settings->getLandingMenu($id);
                $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $menu, true);
            }
            else{
                $menu = $this->settings->getSiteMenu($id);
                $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $menu, false);
            }


        }
        else{
            $nextObj = $builder->getTemplate($id, $styleName, $currentSettings, $sectionName, true);

        }



        return $nextObj;

    }

    public function getSectionNames(){
        $this->settings = new Settings();

        return $this->settings->getSectionNames();
    }
}