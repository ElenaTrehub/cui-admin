<?php

return array(

    'get' => [
        '/rubrics/(\w+)' => 'RubricController@rubricListAction',
        '/subrubrics/(\d+)/(\w+)' => 'RubricController@subrubricListAction',
        '/landing/(\d+)/(\w+)/(\w+)/(\w+)' => 'IframeController@getLandingByRubricIdAction',
        '/manyPage/(\d+)/(\w+)/(\w+)/(\w+)' => 'IframeController@getManyPageSiteByRubricIdAction',
        '/fonts' => 'FontController@fontListAction',
        //'/' => 'RubricController@rubricAction',
        '/sections' => 'SectionController@getSectionNames',
        '/sections/(\d+)/(\w+)/(\w+)' => 'SectionController@getSectionsByName',
        '/choose-section/(\d+)/(\w+)/(\w+)/(\w+)/(\d+)/(\w+)' => 'SectionController@getChooseSection',
        '/add-section/(\d+)/(\w+)/(\w+)/(\w+)/(\w+)' => 'SectionController@getAddSection'
    ],
    'post' => [

    ],
    'put' => [

    ],
    'delete' => [

    ]

);
