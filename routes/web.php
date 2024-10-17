<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AdminController;
use App\Http\Controllers\Auth\UserController;

Route::get('/', function () {
    return view('welcome');
});
//admin
Route::get('/admin/login', [AdminController ::class, 'index']);
Route::post('/admin/login', [AdminController ::class, 'adminlogin'])->name('admin.login');
Route::get('/admin/register', [AdminController ::class, 'adminView'])->name('admin.view');
Route::post('/admin/register', [AdminController ::class, 'adminRegister'])->name('admin.register');
Route::get('/dashboard', [AdminController ::class, 'adminDashboard'])->name('admin.dashboard');
Route::get('/admin/logout', [UserController ::class, 'logout'])->name('admin.logout');


//user
Route::get('/user/login', [UserController ::class, 'index']);
Route::post('/user/login', [UserController ::class, 'userlogin'])->name('user.login');
Route::get('/user/register', [UserController ::class, 'userView'])->name('user.view');
Route::post('/user/register', [UserController ::class, 'userRegister'])->name('user.register');
Route::get('/home', [UserController ::class, 'userDashboard'])->name('user.dashboard');
Route::get('/user/logout', [UserController ::class, 'logout'])->name('user.logout');






