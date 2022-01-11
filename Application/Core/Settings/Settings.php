<?php


namespace Application\Core\Settings;


use Application\Services\UtilsService;

class   Settings
{
    public $photoDir;
    public $siteMenu;
    public $landingMenu;
    public $translateForMenu;

    public function __construct()
    {
        $this->photoDir = [
           6 => 'auto'
        ];

        $this->siteMenu = [
            //6 => ['Index'=>[], 'About'=>[], 'Service'=>['Service1'=>[], 'Service2'=>[]], 'Contact'=>[]]
            6 => ['Index'=>[], 'About'=>['Service'=>[] ]]
        ];

        $this->landingMenu = [
            //6 => ['Main', 'About', 'Feature', 'Service', 'Feedback', 'Contact']
            6 => ['Main', 'About', 'Feedback', 'Contact']
        ];

        $this->sectionNames = [
            'main'=>['ru'=> 'Главная', 'en'=>'Main'],
            'about'=>['ru'=> 'О нас', 'en'=>'About'],
            'feature'=>['ru'=> 'Преимущества', 'en'=>'Feature'],
            'service'=>['ru'=> 'Услуги', 'en'=>'Service'],
            'feedback'=>['ru'=> 'Отзывы', 'en'=>'Feedback'],
            'contact'=>['ru'=> 'Контакты', 'en'=>'Contact'],
            'header'=>['ru'=> 'Шапка сайта', 'en'=>'Header'],
            'footer'=>['ru'=> 'Подвал сайта', 'en'=>'Footer'],
        ];

        $this->translateForMenu = [
            'Index'=>['ru'=> 'Главная', 'en'=>'Main'],
            'Main'=>['ru'=> 'Главная', 'en'=>'Main'],
            'About'=>['ru'=> 'О нас', 'en'=>'About'],
            'Feature'=>['ru'=> 'Преимущества', 'en'=>'Feature'],
            'Service'=>['ru'=> 'Наши услуги', 'en'=>'Service'],
            'ServiceSingle'=>['ru'=> 'Услуга', 'en'=>'Service'],
            'Feedback'=>['ru'=> 'Отзывы', 'en'=>'Feedback'],
            'Contact'=>['ru'=> 'Контакты', 'en'=>'Contact']
        ];
    }
    public function getPhotoFolderName($rubricId){
        return $this->photoDir[$rubricId];
    }
    public function getSiteMenu($rubricId){
        return $this->siteMenu[$rubricId];
    }
    public function getLandingMenu($rubricId){
        return $this->landingMenu[$rubricId];
    }
    public function getTranslateForMenu($page, $lang){
        return $this->translateForMenu[$page][$lang];
    }
    public function getSectionNames(){
        return $this->sectionNames;
    }
}