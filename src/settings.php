<?php
return [
    'settings' => [
        'displayErrorDetails' => true, // set to false in production
        'addContentLengthHeader' => false, // Allow the web server to send the content-length header

        // Renderer settings
        'renderer' => [
            'template_path' => __DIR__ . '/../templates/',
        ],

        // Monolog settings
        'logger' => [
            'name' => 'slim-app',
            'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
            'level' => \Monolog\Logger::DEBUG,
        ],

        // Database settings
        'db' => [
            'host' => '<HOST_NAME>',
            'user' => '<USERNAME>',
            'pass' => '<PASSWORD',
            'dbname' => '<DABASE_NAME>',
            'charset_name' => 'utf8',
            'collation_name' => 'utf8_unicode_ci',
        ],
    ],
];
