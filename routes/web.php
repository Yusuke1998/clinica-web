<?php

Auth::routes();
// sin estar autenticados
Route::view('/','web.inicio')->name('website');
Route::view('servicios','web.servicios');
Route::view('noticias','web.noticias');
Route::view('eventos','web.eventos');
Route::view('convenios','web.convenios');

// estando autenticados
Route::group(['prefix'=>'web', 'middleware'=>'auth'],function(){
	// usuario
	Route::view('/usuario','web.user');
	// usuario

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

// register	
Route::post('/web/user-store','UsersController@user_store');
Route::post('/web/user-login','Auth\LoginController@web_login');
Route::post('/web/user-pass','UsersController@updatePassword');
// register	

// utilidades
Route::get('/get-documents', 'DocumentController@getAll');
Route::get('/get-ethnics', 'EthnicController@getAll');
Route::get('/get-post/{filtro?}/{numero?}', 'HomeController@getAll');
Route::post('/get-post-paginate/{filtro?}', 'HomeController@getAllPaginate');
Route::get('/leer-mas/{slug?}','HomeController@showPost');
Route::post('/get-comments-paginate/{slug?}','HomeController@showPostComments');
Route::post('/post-commented/{slug?}','HomeController@postCommented');
