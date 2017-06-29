<?php

use Symfony\Component\HttpFoundation\Request;

/**
 * HOME
 */
$app->get('/', function () use ($app) {
    $sql = "SELECT * FROM movie ORDER BY movie_date DESC";
    $movies = $app['db']->fetchAll($sql);
    return $app['twig']->render('index.html.twig', array('movies' => $movies));
})->bind('home');

/**
 * SHOW MOVIE
 */
$app->get('/movie/{id}', function ($id) use ($app) {
    $sql = "SELECT * FROM movie WHERE movie_id = ?";
    $movie = $app['db']->fetchAssoc($sql, array((int) $id));
    $director_id = "";
    foreach ($movie as $key => $value) {
        if ($key == 'movie_director') {
            $director_id = $value;
        }
    }
    $director = $app['db']->fetchAssoc("SELECT person_name, person_firstName FROM person WHERE person_id = ?", array((int) $director_id));
    return $app['twig']->render('show.html.twig', array('movie' => $movie, 'director' => $director));
})->bind('show');

/**
 * NEW MOVIE
 */
$app->get('/new-movie', function () use ($app) {
    $sql = "SELECT * FROM person";
    $directors = $app['db']->fetchAll($sql);
    return $app['twig']->render('new.html.twig', array('directors' => $directors));
})->bind('new-movie');

/**
 * ADD A MOVIE
 */
$app->get('/add', function (Request $request) use ($app) {
    $title = $request->get('title');
    $synopsis = $request->get('synopsis');
    $date = $request->get('date');
    $poster = $request->get('poster');
    $director = $request->get('director');
    move_uploaded_file($poster, "/web/uploads" );
    $app['db']->insert('movie', array('movie_title' => $title, 'movie_synopsis' => $synopsis, 'movie_date' => $date, 'movie_poster' =>$poster, 'movie_director' => $director));
    return $app->redirect($app['url_generator']->generate('home'));
})->bind('add');

/**
 * EDIT A MOVIE
 */
$app->get('/movie/{id}/edit', function ($id) use ($app) {
    $sql = "SELECT * FROM movie WHERE movie_id = ?";
    $movie = $app['db']->fetchAssoc($sql, array((int)$id));
    return $app['twig']->render('edit.html.twig', array('movie' => $movie));
})->bind('edit');

/**
 * UPDATE A MOVIE
 */
$app->get('/movie/{id}/update', function ($id, Request $request) use ($app) {
    $title = $request->get('title');
    $synopsis = $request->get('synopsis');
    $app['db']->update('movie', array('movie_title' => $title, 'movie_synopsis' => $synopsis), array('movie_id' => $id));
    return $app->redirect($app['url_generator']->generate('home'));
})->bind('update');
/**
 * DELETE A MOVIE
 */
$app->get('/movie/{id}/delete', function ($id) use ($app) {
    $app['db']->delete('movie', array("movie_id" => $id));
    return $app->redirect($app['url_generator']->generate('home'));
})->bind('delete');

/**
 * NEW DIRECTOR
 */
$app->get('/new-director', function () use ($app) {
    return $app['twig']->render('new_director.html.twig');
})->bind('new-director');

/**
 * ADD A DIRECTOR
 */
$app->get('/add-director', function (Request $request) use ($app) {
    $name = $request->get('name');
    $firstName = $request->get('first_name');
    $born = $request->get('born_date');
    $app['db']->insert('person', array('person_name' => $name, 'person_firstName' => $firstName, 'person_birthDate' => $born));
    return $app->redirect($app['url_generator']->generate('home'));
})->bind('add-director');