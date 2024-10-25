<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('1')->name('1.')->group(
	base_path('routes/1/api.php'),
);