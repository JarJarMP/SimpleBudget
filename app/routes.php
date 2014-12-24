<?php

// Homepage
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@getIndex'))->before('auth');

// Login
Route::get('/login', array('as' => 'login', 'uses' => 'AuthController@getLogin'))->before('guest');
Route::post('login', array('uses' => 'AuthController@postLogin'))->before('csrf');

// Logout
Route::get('/logout', array('as' => 'logout', 'uses' => 'AuthController@getLogout'));

// Register
Route::get('/register', array('as' => 'register', 'uses' => 'AuthController@getRegister'))->before('guest');
Route::post('register', array('uses' => 'AuthController@postRegister'))->before('csrf');