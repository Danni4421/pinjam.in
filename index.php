<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require_once 'autoload.php';

if (isset($_SERVER["REQUEST_URI"])) {
    $uri = parse_url($_SERVER["REQUEST_URI"]);
    $queries = [];

    if (isset($uri["query"])) {
        parse_str($uri["query"], $query);
        $queries = $query;
    }

    $pathCount = count(array_filter(explode('/', $uri["path"])));
    $relativePath = $pathCount == 0 ? "" : str_repeat('../', $pathCount);

    Router::route($uri["path"], $queries, $relativePath);
}
