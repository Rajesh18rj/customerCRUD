<?php

use App\Livewire\Customers;
use App\Livewire\ViewCustomer;
use Illuminate\Support\Facades\Route;
use App\Livewire\CreateCustomer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers/create', CreateCustomer::class);
Route::get('/customers', Customers::class);
Route::get('/customers/{customer}', ViewCustomer::class);



