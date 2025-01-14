<?php

use App\Livewire\Customers;
use App\Livewire\EditCustomer;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\ViewCustomer;
use Illuminate\Support\Facades\Route;
use App\Livewire\CreateCustomer;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/customers/create', CreateCustomer::class);
    Route::get('/customers', Customers::class);
    Route::get('/customers/{customer}', ViewCustomer::class);
    Route::get('/customers/{customer}/edit', EditCustomer::class);
});


Route::get('/register', Register::class);
Route::get('/login', Login::class)->name('login');



