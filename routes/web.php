<?php

$router->get('/', 'App\Controllers\BlogController@welcome');
$router->get('/posts', 'App\Controllers\BlogController@index');
$router->get('/posts/:id', 'App\Controllers\BlogController@show');

$router->get('/tags/:id', 'App\Controllers\TagController@show');

$router->get('/admin/posts', 'App\Controllers\Admin\PostController@index');
$router->get('/admin/posts/:id/edit', 'App\Controllers\Admin\PostController@edit');

$router->post('/admin/posts/:id/update', 'App\Controllers\Admin\PostController@update');
$router->post('/admin/posts/:id/delete', 'App\Controllers\Admin\PostController@destroy');

$router->get('/admin/posts/create', 'App\Controllers\Admin\PostController@create');
$router->post('/admin/posts/store', 'App\Controllers\Admin\PostController@store');

$router->get('/login', 'App\Controllers\UserController@login');
$router->post('/login', 'App\Controllers\UserController@authenticate');
$router->post('/logout', 'App\Controllers\UserController@logout');
