<?php

class Router
{
    private static array $routes = [];

    public static function route($url)
    {
        foreach (static::$routes as $route) {
            if ($route->match($url)) {
                $route->resolve();
                return;
            }
        }
    }

    public static function view($url, $view)
    {
        static::$routes[] = new Route(
            url: $url,
            view: $view,
        );
    }
}
