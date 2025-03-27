<?php

class PageNotFoundException extends Exception {}
$params = $router->match($path);
    try {
        
        if ($params === false) {
            throw new PageNotFoundException("No route matched for '$path'");
        }
    } catch (PageNotFoundException $e) {
        echo $e->getMessage();
    }

$path = parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH);
if ($path === false) {
    throw new UnexpectedValueException("Malformed URL: {$_SERVER["REQUEST_URI"]}");
}


?>
