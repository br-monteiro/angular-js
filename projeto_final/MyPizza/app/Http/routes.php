<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

/*$app->get('/', function () use ($app) {
    return $app->version();
});*/

$app->get('/', [
    'as' => 'index.index',
    'uses' => 'IndexController@index'
]);

// rota que retorna todos os registros
$app->get('/all', [
    'as' => 'index.all',
    'uses' => 'IndexController@findAllAction'
]);

// rota para adição de novos clientes
$app->post('/add', [
    'as' => 'index.add',
    'uses' => 'IndexController@addAction'
]);

// rota para deletar um registro do banco
$app->delete('/del/{id}', [
    'as' => 'index.del',
    'uses' => 'IndexController@deleteAction'
]);

// rota para alteração de registros

$app->put('/put/{id}', [
    'as' => 'index.update',
    'uses' => 'IndexController@updateAction'
]);
