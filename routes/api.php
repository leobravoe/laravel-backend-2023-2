<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/example', function () {
    return response()->json(['message' => 'Hello from Laravel!']);
});
