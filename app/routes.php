<?php

// Homepage
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'))->before('auth');

// Homepage content menu
Route::get('/expenses', array('as' => 'expenses', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/incomes', array('as' => 'incomes', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/charts', array('as' => 'charts', 'uses' => 'HomeController@getIndex'))->before('auth');
Route::get('/categories', array('as' => 'categories', 'uses' => 'CategoriesController@getIndex'))->before('auth');

// Login
Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('login', array('uses' => 'AuthController@postLogin'))->before('csrf');

// Logout
Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

// Register
Route::get('/register', array('as' => 'register', 'uses' => 'AuthController@getRegister'))->before('guest');
Route::post('register', array('uses' => 'AuthController@postRegister'))->before('csrf');

// Categories ajax
Route::post('categories', array('uses' => 'CategoriesController@postIndex'))->before('auth');
Route::post('/category_editor', array('as' => 'category_editor', 'uses' => 'CategoriesController@postIndex'))->before('auth');