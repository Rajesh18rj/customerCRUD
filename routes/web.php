<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\CreateCustomer;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers/create', CreateCustomer::class);
Route::get('/customers', \App\Livewire\Customers::class);



