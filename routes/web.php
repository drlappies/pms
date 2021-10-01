<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::any('{slug}', function () {
    return view('index');
});
