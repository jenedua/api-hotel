<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
   // return ['Laravel' => 'Hello world!'];
    return ['Laravel' => app()->version()];
});

require __DIR__.'/auth.php';
