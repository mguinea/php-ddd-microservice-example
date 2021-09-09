<?php

use Laravel\Lumen\Routing\Router;

/** @var Router $router */

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'lumen/api/v1/users'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'create_user', 'uses' => 'CreateUserController']);
        $router->patch('/{id}', ['as' => 'update_user', 'uses' => 'UpdateUserController']);
        $router->get('/{id}', ['as' => 'get_user', 'uses' => 'GetUserController']);
        $router->delete('/{id}', ['as' => 'delete_user', 'uses' => 'DeleteUserController']);
    }
);

$router->group(
    [
        'namespace' => 'User',
        'prefix' => 'lumen/api/v1/roles'
    ],
    function (Router $router) {
        $router->post('/', ['as' => 'create_role', 'uses' => 'CreateRoleController']);
        $router->patch('/{id}', ['as' => 'update_role', 'uses' => 'UpdateRoleController']);
        $router->get('/{id}', ['as' => 'get_role', 'uses' => 'GetRoleController']);
        $router->delete('/{id}', ['as' => 'delete_role', 'uses' => 'DeleteRoleController']);
    }
);
