<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\adminController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get("admin/showAll", [adminController::class, 'index']);
Route::get("admin/book/edit/{id}", [adminController::class, 'edit']);
Route::get("admin/author/edit/{id}", [adminController::class, 'editAuthor']);
Route::get("admin/publisher/edit/{id}", [adminController::class, 'editPublisher']);