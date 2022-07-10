<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function () {
//     return "hi";
// });
Route::get('/user', function () {
    return "hi";
});

