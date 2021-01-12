<?php

require __DIR__ . "/../core/Router.php";

$router = new Router();

$router->get("/", "index");

$router->post("/", function () {
    echo "You have accessed this page using POST Method";
});

$router->get("/function", function () {
    echo "This is a FuNcTiOn!";
});

$router->resolve();
