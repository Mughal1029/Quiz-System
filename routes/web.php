<?php

use Illuminate\Support\Facades\Route;

require __DIR__.'/01_Laravel_Project/adminRoute.php';

Route::get('/', function () {
    return redirect('admin');  
});