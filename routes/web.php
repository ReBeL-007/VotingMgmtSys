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
Route::group(['namespace' => 'User'], function(){

    Route::get('/','PagesController@index');
    Route::get('org/vote/{id}','PagesController@castvoteorgn');
});


Route::group(['namespace'=>'Admin'], function(){
    
    Route::get('/admin','PagesController@index');

    // Route::resource('/admin/position','PositionController');
    // Route::resource('/admin/candidate','CandidateController');
    // Route::resource('/admin/organization','OrganizationController');

    Route::get('admin/candidate' , 'CandidateController@index')->name('candidate.index');
    Route::get('admin/candidate/create' , 'CandidateController@create')->name('candidate.create');
    Route::post('admin/candidate/store' , 'CandidateController@store')->name('candidate.store');
    Route::get('admin/candidate/{candidate}/edit' , 'CandidateController@edit')->name('candidate.edit');
    Route::get('admin/candidate/{candidate}/delete' , 'CandidateController@destroy')->name('candidate.destroy');
    Route::patch('admin/candidate/{candidate}' , 'CandidateController@update')->name('candidate.update');
    
    Route::get('admin/position' , 'PositionController@index')->name('position.index');
    Route::get('admin/position/create' , 'PositionController@create')->name('position.create');
    Route::post('admin/position/store' , 'PositionController@store')->name('position.store');
    Route::get('admin/position/{position}/edit' , 'PositionController@edit')->name('position.edit');
    Route::get('admin/position/{position}/delete' , 'PositionController@destroy')->name('position.destroy');
    Route::patch('admin/position/{position}' , 'PositionController@update')->name('position.update');

    Route::get('admin/organization' , 'OrganizationController@index')->name('organization.index');
    Route::get('admin/organization/create' , 'OrganizationController@create')->name('organization.create');
    Route::post('admin/organization/store' , 'OrganizationController@store')->name('organization.store');
    Route::get('admin/organization/{organization}/edit' , 'OrganizationController@edit')->name('organization.edit');
    Route::get('admin/organization/{organization}/delete' , 'OrganizationController@destroy')->name('organization.destroy');
    Route::patch('admin/organization/{organization}' , 'OrganizationController@update')->name('organization.update');
});