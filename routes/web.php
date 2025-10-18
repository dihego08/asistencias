<?php

/** @var \Laravel\Lumen\Routing\Router $router */

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/relojes', 'RelojController@lista');
$router->post('/relojes', 'RelojController@insertar');
$router->get('/relojes/{id}', 'RelojController@editar');
$router->put('/relojes/{id}', 'RelojController@actualizar');
$router->delete('/relojes/{id}', 'RelojController@eliminar');
$router->put('/relojes/{id}/estado', 'RelojController@editarEstado');

$router->get('/feriados', 'FeriadoController@lista');
$router->post('/feriados', 'FeriadoController@insertar');
$router->get('/feriados/{id}', 'FeriadoController@editar');
$router->put('/feriados/{id}', 'FeriadoController@actualizar');
$router->delete('/feriados/{id}', 'FeriadoController@eliminar');
$router->put('/feriados/{id}/estado', 'FeriadoController@editarEstado');

$router->get('/permisos', 'PermisoController@lista');
$router->post('/permisos', 'PermisoController@insertar');
$router->get('/permisos/{id}', 'PermisoController@editar');
$router->put('/permisos/{id}', 'PermisoController@actualizar');
$router->delete('/permisos/{id}', 'PermisoController@eliminar');
$router->put('/permisos/{id}/estado', 'PermisoController@editarEstado');

$router->get('/tipos_permisos', 'TipoPermisoController@lista');
$router->post('/tipos_permisos', 'TipoPermisoController@insertar');
$router->get('/tipos_permisos/{id}', 'TipoPermisoController@editar');
$router->put('/tipos_permisos/{id}', 'TipoPermisoController@actualizar');
$router->delete('/tipos_permisos/{id}', 'TipoPermisoController@eliminar');

$router->get('/colaboradores', 'ColaboradorController@lista');
$router->put('/colaboradores/{id}/estado', 'ColaboradorController@editarEstado');
$router->put('/colaboradores/{id}/marcacion', 'ColaboradorController@editarMarcacion');


$router->get('/horarios', 'HorarioController@lista');
$router->post('/horarios', 'HorarioController@insertar');
$router->get('/horarios/{id}', 'HorarioController@editar');
$router->put('/horarios/{id}', 'HorarioController@actualizar');
$router->delete('/horarios/{id}', 'HorarioController@eliminar');
$router->put('/horarios/{id}/estado', 'HorarioController@editarEstado');

$router->get('/horario_dias', 'HorarioDiasController@lista');
$router->post('/horario_dias', 'HorarioDiasController@insertar');
$router->get('/horario_dias/{id}', 'HorarioDiasController@editar');
$router->put('/horario_dias/{id}', 'HorarioDiasController@actualizar');
$router->delete('/horario_dias/{id}', 'HorarioDiasController@eliminar');

$router->get('/colaborador_horario', 'ColaboradorHorarioController@lista');
$router->post('/colaborador_horario', 'ColaboradorHorarioController@insertar');
$router->get('/colaborador_horario/{id}', 'ColaboradorHorarioController@editar');
$router->put('/colaborador_horario/{id}', 'ColaboradorHorarioController@actualizar');
$router->delete('/colaborador_horario/{id}', 'ColaboradorHorarioController@eliminar');
$router->put('/colaborador_horario/{id}/estado', 'ColaboradorHorarioController@editarEstado');