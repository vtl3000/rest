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

//$app->get('/', function () use ($app) {
//    return $app->welcome();
//});

$app->get('/', 'Controller@index');
//$qwe = \App\Models\User::first()->where('name', 'Bob')->get();
//foreach ($qwe as $user) {
////    $app->get('/'.strtolower($user->name), 'Controller@index');
//    $app->get('/'.$user->name, 'Controller@index');
//}

/**
 * Settings app collections
 */
$app->get('settings', 'Settings@getCollectionNames');
$app->post('settings', 'Settings@createCollection');
$app->get('settings/{name}', 'Settings@getCollectionFields');
$app->put('settings/{name}', 'Settings@editCollection');
$app->delete('settings/{name}', 'Settings@deleteCollection');

