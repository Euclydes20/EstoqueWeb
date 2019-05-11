<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

/**
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de classificação
 * ----------------------------------------------------------------------------
 */
Route::get('/classifications', 'ClassificationsController@index')->name('classifications.index');
Route::get('/classifications/create', 'ClassificationsController@create')->name('classifications.create');
Route::post('/classifications', 'ClassificationsController@store')->name('classifications.store');
Route::get('/classifications/{id}', 'ClassificationsController@show')->name('classifications.show');
Route::get('/classifications/{id}/edit', 'ClassificationsController@edit')->name('classifications.edit');
Route::put('/classifications/{id}', 'ClassificationsController@update')->name('classifications.update');
Route::delete('/classifications/{id}/delete', 'ClassificationsController@destroy')->name('classifications.destroy');

/**
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de fornecedores
 * ----------------------------------------------------------------------------
 */
Route::get('/providers', 'ProvidersController@index')->name('providers.index');
Route::get('/providers/create', 'ProvidersController@create')->name('providers.create');
Route::post('/providers', 'ProvidersController@store')->name('providers.store');
Route::get('/providers/{id}', 'ProvidersController@show')->name('providers.show');
Route::get('/providers/{id}/edit', 'ProvidersController@edit')->name('providers.edit');
Route::put('/providers/{id}', 'ProvidersController@update')->name('providers.update');
Route::delete('/providers/{id}/delete', 'ProvidersController@destroy')->name('providers.destroy');

/**
 * ----------------------------------------------------------------------------
 * Rotas para a tabela de produtos
 * ----------------------------------------------------------------------------
 */
Route::get('/products', 'ProductsController@index')->name('products.index');
Route::get('/products/create', 'ProductsController@create')->name('products.create');
Route::post('/products', 'ProductsController@store')->name('products.store');
Route::get('/products/{id}', 'ProductsController@show')->name('products.show');
Route::get('/products/{id}/edit', 'ProductsController@edit')->name('products.edit');
Route::put('/products/{id}', 'ProductsController@update')->name('products.update');
Route::delete('/products/{id}/delete', 'ProductsController@destroy')->name('products.destroy');
