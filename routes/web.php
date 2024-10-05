<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});
// Route::get('users',[UserController::class,'users']);
// Route::get('users', function (Request $request) {
//     if ($request->expectsJson()) {
//         $users = \App\Models\User::select(['id', 'name', 'email', 'created_at']);
//         return DataTables::of($users)->make(true);
//     }

//     return view('index');
// });

Route::get('users', [UserController::class, 'index']);
Route::get('users/filters', [UserController::class, 'filters']);  // For fetching unique filter options
