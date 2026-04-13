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
 * @param array $data
 * 
 * @return void
 */
function loadView($view, $data = [])
{
    $path = basePath('App/views/' . $view . '.view.php');

    if (file_exists($path)) {
        extract($data);
        require basePath('App/views/' . $view . '.view.php');
    } else {
        echo 'Partial not found: ' . $path;
    }
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

/**
 * Redirects to a given url
 * 
 * @param string url
 * 
 * @return void
 */
function redirect($url)
{
    header("Location: {$url}");
    exit;
}
