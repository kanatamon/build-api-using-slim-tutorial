<?php
// DIC configuration

$container = $app->getContainer();

// view renderer
$container['renderer'] = function ($c) {
    $settings = $c->get('settings')['renderer'];
    return new Slim\Views\PhpRenderer($settings['template_path']);
};

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['pdo'] = function ($c) {
    $db = $c['settings']['db'];

    $dsn = 'mysql:host=' . $db['host'] . ';dbname=' . $db['dbname'];
    $user = $db['user'];
    $pass = $db['pass'];

    $options = array(
        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES ' . $db['charset_name'] .'COLLATE ' . $db['collation_name'],
    );
    $pdo = new PDO($dsn, $user, $pass, $options);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};
