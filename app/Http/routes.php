<?php

Route::get('/', 'HomeController@index');

Route::pattern('static_page', '^(about|contact|privacy)$');
Route::get('/{static_page}', 'HomeController@staticPage');

Route::get('facebook/login', 'Auth\FacebookController@authorize');
Route::get('facebook/callback', 'Auth\FacebookController@callback');

Route::controllers([
  'auth'     => 'Auth\AuthController',
  'password' => 'Auth\PasswordController',
]);

$adminOpts = [
  'namespace' => 'Admin',
  'before' => 'auth',
  'prefix' => 'admin',
];
Route::group($adminOpts, function() {
    Route::get('/', ['as' => 'admin.home', 'uses' => 'EventController@index']);
    Route::get('event/import', 'EventController@import');
    Route::resource('event', 'EventController');
});
