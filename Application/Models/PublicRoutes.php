<?php

return array(

    'get' => [
        '/rubrics' => 'RubricController@rubricListAction',
        '/landing/(\d+)' => 'IframeController@getLandingByRubricIdAction',
        '/manyPage/(\d+)' => 'IframeController@getManyPageSiteByRubricIdAction',
        '/fonts' => 'FontController@fontListAction',
        //'/' => 'RubricController@rubricAction',
    ],
    'post' => [

    ],
    'put' => [

    ],
    'delete' => [

    ]

);
