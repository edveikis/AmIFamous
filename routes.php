<?php

$router->get('/', 'HomeController@index');

$router->get('/dashboard', 'DashboardController@index');
$router->get('/dashboard/import/{file}', 'DashboardController@importForm');
$router->post('/dashboard/import', 'DashboardController@add');

$router->post('/breaches', 'BreachesController@getBreaches');
