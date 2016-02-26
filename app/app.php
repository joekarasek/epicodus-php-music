<?php
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Genre.php";

    // create silex object with twig templating
    $app = new Silex\Application();
    $app->register(new Silex\Provider\TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views'
    ));

    // setup server for database
    $server = 'mysql:host=localhost:8889;dbname=music';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);

    $app->get("/", function() use ($app) {
        return $app['twig']->render('index.html.twig', array(
            'genres' => Genre::getAll()
        ));
    });

    return $app;
?>
