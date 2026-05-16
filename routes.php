<?php

$router->get('/', 'HomeController@index');

$router->get('/dashboard', 'DashboardController@index', ['auth']);
$router->get('/dashboard/import/{file}', 'DashboardController@importForm', ['auth']);
$router->post('/dashboard/import', 'DashboardController@add', ['auth']);

$router->post('/breaches', 'BreachesController@getBreaches');

$router->get('/admin/login', 'UserController@login', ['guest']);
$router->post('/admin/login', 'UserController@authenticate', ['guest']);
$router->get('/admin/logout', 'UserController@logout', ['auth']);
