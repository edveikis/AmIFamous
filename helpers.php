<?php

/** 
 * Get the base path
 * 
 * @param string $path
 * 
 * @return string
 */
function basePath($path = '')
{
    return __DIR__ . '/' . $path;
}

/**
 * Loads a view onto the page
 * 
 * @param string $view
 * 
 * @return void
 */
function loadView($view)
{
    require basePath('App/views/' . $view . '.view.php');
}

/**
 * Inspect array of data
 * 
 * @param array $data
 * 
 * @return void
 */
function inspect($data)
{
    echo '<pre>';

    var_dump($data);

    echo '</pre>';
}

/**
 * Inspect array of data
 * 
 * @param array $data
 * 
 * @return void
 */
function inspectAndDie($data)
{
    echo '<pre>';

    var_dump($data);

    echo '</pre>';

    die();
}
