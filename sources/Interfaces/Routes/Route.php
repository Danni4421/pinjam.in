<?php

class Route
{
    private string $url, $view;

    public function __construct($url, $view)
    {
        $this->url = $url;
        $this->view = $view;
    }

    public function match($url)
    {
        return $url == $this->url;
    }

    public function resolve()
    {
        $routeView = explode(".", $this->view);
        $targetView = ucfirst(end($routeView)) . ".php";
        $targetDirectory = implode("/", array_slice($routeView, 0, -1));

        require_once 'assets/views/' . $targetDirectory . '/' . $targetView;
    }
}
