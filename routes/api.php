<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\CompanyController;
use App\Http\Controllers\API\DepartmentController;
use App\Http\Controllers\API\ProductController;

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


//Basic Routing
Route::get('/', [CompanyController::class, 'index']);

//Multiple routers
Route::get('/staff', function () {
    return 'Hello staff';
});

//Route Parameters
Route::get('/staff/{id}', [CompanyController::class, 'show']);


Route::apiResource('/product', ProductController::class);
Route::apiResource('/department', DepartmentController::class);