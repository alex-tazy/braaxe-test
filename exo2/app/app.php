<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use Silex\Provider\FormServiceProvider;

ErrorHandler::register();
ExceptionHandler::register();


$app->register(new Silex\Provider\DoctrineServiceProvider(), array(
    'db.options' => array(
            'driver'   => 'pdo_mysql',
            'charset'  => 'utf8',
            'host'     => 'localhost',
            'port'     => '3306',
            'dbname'   => 'IMDB',
            'user'     => 'alex',
            'password' => 'alex',
    )
));

$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

$app->register(new Silex\Provider\AssetServiceProvider(), array(
    'assets.version' => 'v1'
));

$app->register(new FormServiceProvider());