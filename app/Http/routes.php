<?php

/**
 * Home
 */
Route::get('/', [
		'as' => 'home',
		'uses' => 'HomeController@index'
	]);

/**
 * Authentication
 */

Route::get('/signup', [
	'as'         =>  'auth.signup',
	'uses'       =>  'AuthController@getSignup',
	'middleware' =>  ['guest']
	]);

Route::post('/signup', [

	'uses'       =>  'AuthController@postSignup',
	'middleware' =>  ['guest']
	]);

Route::get('/signin', [
	'as'    => 'auth.signin',
	'uses'  => 'AuthController@getSignin',
	'middleware' =>  ['guest']	
	]);

Route::post('/signin', [
	'uses'  => 'AuthController@postSignin',
	'middleware' =>  ['guest']		
	]);

Route::get('/signout', [
	'as'    => 'auth.signout',
	'uses'  => 'AuthController@getSignout',
	]);


/**
 *  Search
 */

Route::get('/search', [
	'as'    => 'search.results',
	'uses'  => 'SearchController@getResults',
	]);


/**
 * User Profile
 */

Route::get('/user/{username}', [
	'as'    => 'profile.index',
	'uses'  => 'ProfileController@getProfile',
	]);


/**
 * Update Profile
 */

Route::get('/profile/edit', [
	'as'    => 'profile.edit',
	'uses'  => 'ProfileController@getEdit',
	'middleware' =>  ['auth']
	]);

Route::post('/profile/edit', [
	'uses'  => 'ProfileController@postEdit',
	'middleware' =>  ['auth']
	]);