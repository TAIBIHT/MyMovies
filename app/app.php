<?php

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();

// Register service providers
$app->register(new Silex\Provider\DoctrineServiceProvider());
$app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));
$app->register(new Silex\Provider\UrlGeneratorServiceProvider());
$app->register(new Silex\Provider\SessionServiceProvider());


// Register services

$app->register(new Silex\Provider\FormServiceProvider());

$app->register(new Silex\Provider\TranslationServiceProvider());


$app['dao.MyMovies'] = $app->share(function ($app) {
    return new MyMovies\DAO\MyMoviesDAO($app['db']);
});
$app['dao.user'] = $app->share(function ($app) {
    return new MyMovies\DAO\UserDAO($app['db']);
});
$app['dao.comment'] = $app->share(function ($app) {
    $commentDAO = new MyMovies\DAO\CommentDAO($app['db']);
    $commentDAO->setMyMoviesDAO($app['dao.MyMovies']);
    $commentDAO->setUserDAO($app['dao.user']);
    return $commentDAO;
});
