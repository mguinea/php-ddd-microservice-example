<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'auth/api/v1/users'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'create', 'uses' => 'CreateUserController']);
    }
);
