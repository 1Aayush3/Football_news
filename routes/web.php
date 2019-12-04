<?php
Auth::routes();
Route::get('/','GuzzleContoller@welcome'); 
Route::get('/home', 'HomeController@index');
Route::group(['middleware' => ['auth']], function () {
    // Route::resource('roles','RoleController');
    Route::resource('teams', 'TeamController');
    Route::resource('players', 'PlayerController');
    Route::resource('matches', 'MatchController');
    Route::resource('goals', 'GoalController');
    Route::get('/matches/{match}/add-scores', 'MatchController@addScore')->name('matches.add_scores');
    Route::post('/matches/{match}/update-scores', 'MatchController@updateScore')->name('matches.update_scores');
    Route::get('/fixtures', 'GuzzleContoller@getRemoteData')->name('premier.index');
    Route::get('/fixtures/Superliga', 'GuzzleContoller@getData')->name('sliga.index');
});
?>


