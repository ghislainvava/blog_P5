<?php
require '../vendor/autoload.php';

$router = new AltoRouter();
$router->map('GET', '/', 'home', 'home');
$router->map('GET','/form-article' , 'form-article', 'form-article');
$router->map('GET','/article' , 'article', 'article');
$router->map('GET','/blog/[$:slug]-[i:id]' , 'show-article', 'show-article');

$match = $router->match();
if ($match !== null) {
    require '../Views/template.php';
    if (is_callable($match['target'], $match['params'])) {
        call_user_func_array($match['target'], $match['params']);
    }
    $params = $match['params'];
    require "../Views/{$match['target']}.php";
}

