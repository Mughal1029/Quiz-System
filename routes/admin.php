<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Usercontroller;

Route::get('/', function () {
    return "moona";
});

Route::get('/hell', function () {
    return "Hello World";
});


route::get('/user', [Usercontroller::class, 'getUser']);
Route::get('/abouts', [Usercontroller::class, 'aboutUser']);
route::get('users/{name}', [Usercontroller::class, 'name']);
route::get('paper', [Usercontroller::class, 'hello1']);
route::get('paper/{x}', [Usercontroller::class, 'hello']);
route::get('welcome', [Usercontroller::class, 'wel1']);
route::get('welcome/{y}', [Usercontroller::class, 'wel']);

route::get('user-about/', [Usercontroller::class, 'userAbout']);
route::get('user-home/', [Usercontroller::class, 'Home']);
