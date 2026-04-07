<?php

namespace Framework;

class Router
{
    protected $routes = [];

    public function registerRoute($method, $uri, $controller)
    {
        $this->routes[] = [
            'method' => $method,
            'uri' => $uri,
            'controller' => $controller,
            'controllerMethod' => 'tmp'
        ];
    }

    public function get($uri, $controller)
    {
        $this->registerRoute('GET', $uri, $controller);
    }

    public function post($uri, $controller)
    {
        $this->registerRoute('POST', $uri, $controller);
    }

    public function put($uri, $controller)
    {
        $this->registerRoute('PUT', $uri, $controller);
    }

    public function delete($uri, $controller)
    {
        $this->registerRoute('DELETE', $uri, $controller);
    }

    public function route($uri)
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            if ($route['method'] == $requestMethod && $route['uri'] == $uri) {
                $controller = 'App\\Controllers\\' . $route['controller'];
                $controllerMethod = $route['controllerMethod'];

                $controllerInstance = new $controller();
                $controllerInstance->$controllerMethod();

                return;
            }
        }
    }
}
