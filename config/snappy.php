<?php

return array(


    'pdf' => array(
        'enabled' => true,
        'binary' => base_path('vendor/profburial/wkhtmltopdf-binaries-osx/bin/wkhtmltopdf-amd64-osx'),//base_path('vendor/h4cc/wkhtmltopdf-amd64/bin/wkhtmltopdf-amd64'),
        'timeout' => false,
        'options' => array(),
        'env' => array(),
    ),
    'image' => array(
        'enabled' => true,
        'binary' => base_path('vendor/profburial/wkhtmltopdf-binaries-osx/bin/wkhtmltoimage-amd64-osx'),//'/usr/local/bin/wkhtmltoimage',
        'timeout' => false,
        'options' => array(),
        'env' => array(),
    ),


);
