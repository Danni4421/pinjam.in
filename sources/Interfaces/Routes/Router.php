<?php

class Router
{
    private static array $routes = [];

    public static function route($url, $query, $relativePath)
    {
        if ($url == "/logout") {
            Auth::logout();
        }

        foreach (static::$routes as $route) {
            if ($route->match($url)) {
                $route->resolve($query, $relativePath);
                return;
            }
        }
    }

    public static function view($url, $view, $auth = [])
    {
        static::$routes[] = new Route(
            url: $url,
            view: $view,
            auth: $auth
        );
    }
}
