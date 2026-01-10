<?php

use Illuminate\Support\Facades\Route;
require __DIR__.'/admin.php';


Route::get('/', function () {
    return view('home');
});

Route::get('/about', function () {
    return view('welcome');
});

// PASS DATA WITH ROUTING METHOD
Route::get('/test/{name}', function($name){
    return view('paper', ['name'=>$name]);
});

// ONLY VIEW NOT DATA RELATED SHOWING ROUTING METHOD
Route::view('/abc', 'home');

// REDIRECTING ROUTING METHOD
// route::redirect('/about', '/');
