<?php

Auth::routes();
// sin estar autenticados
Route::view('/','web.inicio')->name('website');
Route::view('servicios','web.servicios');
Route::view('noticias','web.noticias');
Route::view('eventos','web.eventos');
Route::view('contactos','web.contactos');
Route::view('convenios','web.convenios');

// estando autenticados
Route::group(['prefix'=>'web', 'middleware'=>'auth'],function(){
	Route::view('/usuario','web.user');
	Route::view('/historial','web.record');
});

Route::group(['prefix'=>'administracion', 'middleware'=>'auth'],function(){
	// siendo administrador
	Route::view('/inicio', 'admin.dashboard')
		->name('dashboard')
		->middleware('auth');
		
	// usuarios
	Route::get('/usuarios', 'UsersController@index')
		->name('users.index')
		->middleware('auth');
	Route::post('/get-users','UsersController@userDataTable');
	Route::post('/store-user','UsersController@store');
	Route::post('/update-user','UsersController@update');
	Route::post('/delete-user','UsersController@destroy');
	Route::get('/perfil/{username?}','UsersController@profile')->name('profile');
});

// utilidades
Route::get('/get-documents', 'DocumentController@getAll');
Route::get('/get-post/{filtro?}/{numero?}', 'HomeController@getAll');
Route::post('/get-post-paginate/{filtro?}', 'HomeController@getAllPaginate');
