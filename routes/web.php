<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
// Show all data 
Route::get('admin/showAll' , 'App\Http\Controllers\admin\adminController@index' )->middleware('auth');
// Route::get('admin/showAllCategory' , 'App\Http\Controllers\admin\adminController@getPublishers' )->middleware('auth');
Route::get('admin/' , 'App\Http\Controllers\admin\adminController@getCategoties' )->middleware('auth');
// modal
Route::post('admin/modal', 'App\Http\Controllers\admin\adminController@AddOrUpdateBook' )->middleware('auth')->name('modal');
// Edit Book
Route::get('admin/book/edit/{id}', 'App\Http\Controllers\admin\AdminController@edit')->middleware('auth')->name('editbook');
// Author
Route::get('admin/showAllAuthor' , 'App\Http\Controllers\admin\adminController@getAuthors' )->middleware('auth');
Route::get('admin/author/edit/{id}', 'App\Http\Controllers\admin\AdminController@editAuthor')->middleware('auth')->name('editauthor');
Route::post('admin/alltypemodal', 'App\Http\Controllers\admin\adminController@AddOrUpdateAuthor' )->middleware('auth')->name('AddOrUpdateAuthor');
Route::delete('admin/author/delete/{id}', 'App\Http\Controllers\admin\AdminController@destroyAuthor')->middleware('auth')->name('destroyauthor');
// Publisher
Route::get('admin/showAllPublisher' , 'App\Http\Controllers\admin\adminController@getPublishers' )->middleware('auth');
Route::get('admin/publisher/edit/{id}', 'App\Http\Controllers\admin\AdminController@editPublisher')->middleware('auth')->name('editPublisher');
Route::post('admin/alltypemodalpubli', 'App\Http\Controllers\admin\adminController@AddOrUpdatePublisher' )->middleware('auth')->name('AddOrUpdatePublisher');
Route::delete('admin/publisher/delete/{id}', 'App\Http\Controllers\admin\AdminController@destroyPublisher')->middleware('auth')->name('destroyPublisher');
// delete
Route::delete('admin/book/delete/{id}', 'App\Http\Controllers\admin\AdminController@destroy')->middleware('auth')->name('destroy');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
