<?php

use Illuminate\Support\Facades\Route;


Route::get('/counter', function () {
    return response('Counter page');
});
