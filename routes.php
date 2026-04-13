<?php

use App\Controllers\DashboardController;

$router->get('/', 'HomeController@index');
$router->get('/dashboard', 'DashboardController@index');
$router->get('/dashboard/import', 'DashboardController@import');
$router->post('/breaches', 'BreachesController@getBreaches');
