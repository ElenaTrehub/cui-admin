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
use Application\Core\Blocks\Slider\SliderBuilder;
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
        $this->sliderBuilder = new SliderBuilder();
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

    public function getGlobalsettings($id){
        $colors = $this->colorBuilder->getColorObj($id);
        $fonts = $this->fontBuilder->getFontObj($id);
        $spaces = $this->spaceBuilder->getSpaceObj($id);

        $themes = ['light', 'normal', 'dark'];
        $index = rand(0, 2);

        $withBgBlock= ['withBg', 'withoutBg'];
        $indexBg = rand(0, 1);
        $indexBg = 0;

        $settings = new \stdClass();
        $settings->theme = $themes[$index];
        $settings->withBg = $withBgBlock[$indexBg];
        $settings->colors = $colors;
        $settings->fonts = $fonts;
        $settings->spaces = $spaces;

        return $settings;
    }
    public function getLandingTemplateObjCore($id): \stdClass
    {

        $menu = $this->settings->getLandingMenu($id);
        $settings = $this->getGlobalsettings($id);




        $headerObj = $this->headerBuilder->getTemplate($id, $settings, $menu, true);

        $sliderObj = $this->sliderBuilder->getTemplate($id, $headerObj->set);

        $childIframe = new \stdClass();
        $childIframe->html = '';
        $childIframe->css = '';
        $childIframe->js = '';

        $currentSettings = $sliderObj->set;

        for ($i = 1; $i < count($menu); $i++){

            $builderStr = "Application\Core\Blocks\\$menu[$i]\\{$menu[$i]}Builder";

            $builder = new $builderStr();

            $nextObj = $builder->getTemplate($id, $currentSettings, $menu[$i], true);
            $childIframe->html = $childIframe->html.$nextObj->html;
            $childIframe->css = $childIframe->css.$nextObj->css;
            $childIframe->js = $childIframe->js.$nextObj->js;

            $currentSettings = $nextObj->set;

        }

        //$aboutObj = $this->aboutBuilder->getTemplate($id, $sliderObj->set);

        //$featureObj = $this->featureBuilder->getTemplate($id, $aboutObj->set);

        //$serviceObj = $this->serviceBuilder->getTemplate($id, $featureObj->set);

        //$feedbackObj = $this->feedbackBuilder->getTemplate($id, $serviceObj->set);

        //$contactObj = $this->contactBuilder->getTemplate($id, $feedbackObj->set);

        $footerObj = $this->footerBuilder->getTemplate($id, $currentSettings, $menu, true);

        $scrollObj = $this->scrollBuilder->getTemplate($footerObj->set);

        $globalStyle = $this->globalStyleBuilder->getGlobalStyle($settings->fonts, $settings->spaces, $settings->colors);

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
        $css = $headerObj->css.$sliderObj->css.$childIframe->css.$footerObj->css.$scrollObj->css;
        $js = '(function() { "use strict"; '.$jsStr.$headerObj->js.$sliderObj->js.$childIframe->js.$footerObj->js.$scrollObj->js.'new WOW().init();})();';


        $objFont = new \stdClass();
        $objFont->name = $settings->fonts->nameFont;
        $objFont->link = $settings->fonts->link;


        $iframe = new \stdClass();

        $this->cleanHtmlStr($html);

        $obj = new \stdClass();
        $obj->name = 'Index';
        $obj->html = $html;


        $iframe->html = [$obj];
        $iframe->css = $globalStyle.$css;
        $iframe->script = $js;
        $iframe->fontStyle = $settings->fonts;
        $iframe->set = $scrollObj->set;

        return $iframe;
    }
    public function getManyPageSiteTemplateObjCore($id): \stdClass
    {

        $menu = $this->settings->getSiteMenu($id);
        $settings = $this->getGlobalsettings($id);

        $headerObj = $this->headerBuilder->getTemplate($id, $settings, $menu, false);
        $footerObj = $this->footerBuilder->getTemplate($id, $settings, $menu, false);

        $sliderObj = $this->sliderBuilder->getTemplate($id, $settings);




        $pagesArray = new \stdClass();
        $pagesArray->html = [];
        $pagesArray->css = '';
        $pagesArray->js = '';


        foreach($menu as $key => $value){

            $builderStr = "Application\Core\Pages\\{$key}Page\\{$key}PageBuilder";
            $builder = new $builderStr();

            $nextPage = $builder->getPageTemplate($id, $settings, $key, false);
            $pagesArray->html  += [$key=>$nextPage->html];
            $pagesArray->css = $pagesArray->css.$nextPage->css;
            $pagesArray->js = $pagesArray->js.$nextPage->js;

            if (count($value) > 0) {
                foreach ($value as $keyInto => $valueInto) {
                    $builderStr = "Application\Core\Pages\\{$keyInto}Page\\{$keyInto}PageBuilder";
                    $builder = new $builderStr();

                    $nextIntoPage = $builder->getPageTemplate($id, $settings, $keyInto, false);
                    $pagesArray->html += [$keyInto=>$nextIntoPage->html];
                    $pagesArray->css = $pagesArray->css.$nextIntoPage->css;
                    $pagesArray->js = $pagesArray->js.$nextIntoPage->js;
                }
            }


        }





        $scrollObj = $this->scrollBuilder->getTemplate($footerObj->set);
        $globalStyle = $this->globalStyleBuilder->getGlobalStyle($settings->fonts, $settings->spaces, $settings->colors);

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
        $js = '(function() { "use strict"; '.$jsStr.$headerObj->js.$footerObj->js.$sliderObj->js.$pagesArray->js.'new WOW().init();})();';


        $objFont = new \stdClass();
        $objFont->name = $settings->fonts->nameFont;
        $objFont->link = $settings->fonts->link;


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
        $iframe->fontStyle = $settings->fonts;
        //$iframe->set = $indexObj->set;

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
}