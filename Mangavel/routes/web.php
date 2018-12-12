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
/*
Route::get('templates/{any}',function()
{
	return "error";
})->where('any', '.*');
*/

Route::group(['namespace' => 'Home'], function()
{
 	Route::get('/home', 'MangaController@index');

 	Route::get('/home/manga/{id}', 'MangaController@mangaView')->name('manga-view');

 	Route::get('/home/manga/read/{id}', 'MangaController@chapterRead')->name('chapter-read');
});
Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function()
{
	Route::get('/', 'AdminController@index');

	Route::group(['prefix' => 'manga'], function ()
	{
		Route::get('/', 'AdminController@mangaIndex')->name('manga-index');

		Route::get('/add', 'AdminController@mangaAdd')->name('manga-add');

		Route::post('/save', 'AdminController@mangaSave')->name('manga-save');

		Route::get('/edit/{id}', 'AdminController@mangaEdit')->name('manga-edit');

		Route::post('/update/{id}', 'AdminController@mangaUpdate')->name('manga-update');

		Route::get('/delete/{id}', 'AdminController@mangaDelete')->name('manga-delete');
	});

	Route::group(['prefix' => 'chapter'], function()
	{
		Route::get('/', 'ChapterController@index')->name('chapter-index');

		Route::get('/manga/{id}', 'ChapterController@view')->name('chapter-view');

		Route::get('/add', 'ChapterController@add')->name('chapter-add');

		Route::post('/save', 'ChapterController@save')->name('chapter-save');
		
		Route::get('/{id}', 'ChapterController@edit')->name('chapter-edit');

		Route::get('delete/{id}', 'ChapterController@delete')->name('chapter-delete');

		Route::post('/update', 'ChapterController@update')->name('chapter-update');
	});

	Route::group(['prefix' => 'image'], function()
	{
		route::post('/delete', 'ImageController@delete')->name('image-delete');
	});
});
