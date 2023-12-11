<?php

class Route
{
    private string $url, $view;
    private array $auth;

    /**
     * @param string $url
     * @param string $view
     * @param array $auth
     */
    public function __construct($url, $view, $auth)
    {
        $this->url = $url;
        $this->view = $view;
        $this->auth = $auth;
    }

    /**
     * @param string $url
     * @return bool
     */
    public function match($url)
    {
        if ($this->url == $url) {
            if (count($this->auth)) {
                if (isset($_SESSION["user"]["level"])) {
                    $level = $_SESSION["user"]["level"];

                    foreach ($this->auth as $auth) {
                        if ($auth == $level) {
                            return true;
                        }
                    }


                    switch ($level) {
                        case "user":
                            header("Location: /");
                            break;
                        case "admin" || "superadmin":
                            header("Location: /admin");
                            break;
                    }
                }

                header("Location: /login");
                return false;
            }
            return true;
        }
        return false;
    }

    public function resolve()
    {
        $routeView = explode(".", $this->view);
        $targetView = ucfirst(end($routeView)) . ".php";
        $targetDirectory = implode("/", array_slice($routeView, 0, -1));

        require_once 'assets/views/' . $targetDirectory . '/' . $targetView;
    }
}
