<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'homeController@home');

// Feed management
Route::get('manage', 'manageController@index');
Route::post('feed/add', 'feedController@add');
Route::get('feed/delete/{id}', 'feedController@delete')->where('id', '[0-9]+');
Route::post('feed/edit/{id}', 'feedController@edit')->where('id', '[0-9]+');
Route::get('feed/form/{id}', 'feedController@form')->where('id', '[0-9]+');

// Sections
Route::post('section/add', 'sectionController@add');
Route::get('section/delete/{id}', 'sectionController@delete')->where('id', '[0-9]+');
Route::post('section/edit/{id}', 'sectionController@edit')->where('id', '[0-9]+');
Route::get('section/form/{id}', 'sectionController@form')->where('id', '[0-9]+');

// Ajax call
Route::get('rss/pull', 'rssController@pull');
Route::get('rss/unread', 'rssController@unread');
Route::get('feed/unread', 'feedController@unread');

// Feed view
Route::get('all', 'entryController@all');
Route::get('all/feed/{id}', 'entryController@feed')->where('id', '[0-9]+');
Route::get('all/section/{id}', 'entryController@section')->where('id', '[0-9]+');
/*
Route::get('all/{id}/{start}', 'entryController@all')->where('id', '[0-9]+');
Route::get('all/{id}/{start}/{end}', 'entryController@all')->where('id', '[0-9]+');*/

// Feed update
Route::get('entry/{id}/read', 'entryController@read')->where('id', '[0-9]+');

Route::get('entry/readall/{id}', 'entryController@readall');

