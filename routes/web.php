<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaypalController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('go-payement' , [PaypalController::class,'goPayement']);
Route::get('payement',  [PaypalController::class , 'payment'])->name('payment');
Route::get('cancel',  [PaypalController::class , 'cancel'])->name('payment.cancel');
Route::get('payement/success',  [PaypalController::class , 'success'])->name('payment.success');
