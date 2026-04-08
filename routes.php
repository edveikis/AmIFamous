<?php

$router->get('/', 'HomeController@index');
$router->post('/breaches', 'BreachesController@getBreaches');
