<?php

class Router
{
    /** @var Route[] */
    private static $routes = [];

    public static function route($uri, $query, $relativePath)
    {
        if ($uri == "/logout") {
            Auth::logout();
        }

        foreach (static::$routes as $route) {
            if ($route->match($uri)) {
                $route->resolve(uri: $uri, query: $query, relativePath: $relativePath);
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
