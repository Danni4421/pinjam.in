<?php

require_once 'autoload.php';

if (isset($_SERVER["REQUEST_URI"])) {
    $uri = $_SERVER["REQUEST_URI"];
    Router::route($uri);
}
