<?php

return array(

    'get' => [
        '/rubrics' => 'RubricController@rubricListAction',
        '/iframe/(\d+)' => 'IframeController@getTemplateByRubricIdAction',
        //'/' => 'RubricController@rubricAction',
    ],
    'post' => [

    ],
    'put' => [

    ],
    'delete' => [

    ]

);
