<?php
use Framework\Routing\Router;

$router = new Router();

$router->get("/",function (){

    echo "<h1>Hello World from / Route </h1>";

});


$router->get("/contact-us",function (){

    echo "<h1>Hello World from Contact Us Route </h1>";

});

$router->get("/about-us",function (){

    echo "<h1>Hello World from About Us Route </h1><br>";

});

$router->RunApplication($_SERVER["REQUEST_METHOD"],$_SERVER["REQUEST_URI"]);



