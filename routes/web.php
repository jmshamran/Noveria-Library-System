<?php

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
//HomeController
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::post('/profile/edit/{id}', 'HomeController@editprofile')->name('editprofile');
Route::get('/users', 'HomeController@users')->name('users');
Route::get('/users/edituser/{id}', 'HomeController@edituser')->name('edituser');
Route::post('/books/edituser/userupdate/{id}', 'HomeController@userupdate')->name('userupdate');
Route::post('/users/promote/{id}', 'HomeController@promote')->name('promote');
Route::get('/users/{id}', 'HomeController@userpage')->name('userpage');
Route::get('/users/deleteuser/{id}', 'HomeController@deleteuser')->name('deleteuser');

//BooksController
Route::get('/books', 'BooksController@index')->name('books');
Route::get('/books/addbook', 'BooksController@addbook')->name('addbook');
Route::post('/books/addbook/store', 'BooksController@store')->name('store');
Route::get('/books/{id}', 'BooksController@bookpage')->name('bookpage');
Route::get('/books/editbook/{id}', 'BooksController@editbook')->name('editbook');
Route::post('/books/editbook/bookupdate/{id}', 'BooksController@bookupdate')->name('bookupdate');
Route::get('/books/deletebook/{id}', 'BooksController@deletebook')->name('deletebook');

//ReserveBookController
Route::get('/books/reserve/{id}', 'ReserveBookController@reserve')->name('reserve');
Route::get('/mybooks/rescancel/{id}', 'ReserveBookController@rescancel')->name('rescancel');
Route::get('/mybooks', 'ReserveBookController@mybooks')->name('mybooks');
Route::get('/autho', 'ReserveBookController@autho')->name('autho');
Route::get('/autho/accept/{id}', 'ReserveBookController@accept')->name('accept');
Route::get('/autho/decline/{id}', 'ReserveBookController@decline')->name('decline');
Route::get('/lent', 'ReserveBookController@lent')->name('lent');
Route::get('/lent/recieve/{id}', 'ReserveBookController@recieve')->name('recieve');
Route::get('/fines', 'ReserveBookController@fines')->name('fines');
Route::get('/fines/collect/{id}', 'ReserveBookController@collect')->name('collect');

//SettingsController
Route::get('/settings', 'SettingsController@settings')->name('settings');
Route::get('/settings/apply', 'SettingsController@apply')->name('apply');

// Genre Controller (happens in settings page)
Route::post('/settings/add_genre', 'GenreController@addBookGenre')->name('addBookGenre');
Route::post('/settings/remove_genre', 'GenreController@removeBookGenre')->name('removeBookGenre');
