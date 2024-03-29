<?php

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api){

    $api->group([
        //  'middleware' => 'api',
        'namespace' => 'App\Http\Controllers\api',
    ], function ($router) {
        $router->get("/invoice", "invoice\InvoiceController@getInvoices")->name("invoice.list");
    });

    $api->group([
        //'middleware' => 'store',
        'prefix' => 'store',
        'namespace' => 'App\Http\Controllers\store',
    ], function ($router) {
        $router->post("/user/login", "login\LoginController@loginIn");
    });
});