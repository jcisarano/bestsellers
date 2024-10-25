<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('nyt')->name('nyt.best-sellers')->group(function () {
    Route::get('best-sellers', 'App\Http\Controllers\Api\BestsellersController@index');
});
