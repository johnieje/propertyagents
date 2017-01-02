<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('/home', 'HomeController@index');

Route::get('/account', [
	'uses' => 'HomeController@account',
	'as' => 'account'
	]);

Route::get('/account-image/{filename}',[
	'uses' => 'HomeController@getUserImage',
    'as' => 'account-image'
]);

Route::get('/account-settings/',[
	'uses' => 'HomeController@getAccountSettings',
    'as' => 'account-settings'
]);

Route::post('/accountupdate', [
	'uses' => 'HomeController@postAccountUpdate',
	'as' => 'account-update'
]);

Route::get('/account/delete-image/{filename}', [
    'uses' => 'HomeController@getImageDelete',
    'as' => 'delete-image'
]);

Route::get('/delete-account/{id}',[
    'uses' => 'HomeController@getDeleteAccount',
    'as' => 'delete-account'
]);

Route::get('/agents',[
    'uses' => 'AgentController@getAgents',
    'as' => 'agents'
]);

Route::post('/agent-save',[
	'uses' => 'AgentController@postSaveAgent',
	'as' => 'agent-save'
]);

Route::get('/agent-logo/{filename}',[
	'uses' => 'AgentController@getAgentLogo',
	'as' => "agent-logo"
]);

Route::get('/add-agent',[
	'uses' => 'AgentController@getAddAgent',
	'as' => "add-agent"
]);

Route::get('/edit-agent/{id}',[
	'uses' => 'AgentController@getEditAgent',
	'as' => "edit-agent"
]);

Route::post('/agent-update',[
	'uses' => 'AgentController@postUpdateAgent',
	'as' => "update-agent"
]);

Route::get('/delete-agent/{id}',[
        'uses' => 'AgentController@getDeleteAgent',
        'as' => 'delete-agent'
]);

Route::get('users',[
	'uses' => 'HomeController@getUsersList',
	'as' => 'users-list'
]);