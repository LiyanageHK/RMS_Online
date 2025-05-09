<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GRNController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;

// Homepage
Route::get('/', function () {
    return view('welcome');
})->name('client.home');

// Core resources
Route::resource('suppliers', SupplierController::class);
Route::resource('purchase_orders', PurchaseOrderController::class);
Route::resource('employees', EmployeeController::class);
Route::resource('grns', GRNController::class);

// Order Status Management
Route::get('orders', [OrderController::class, 'index'])->name('orders.index');
Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');

// Static client views
Route::view('about', 'client.about')->name('client.about');
Route::view('menu', 'client.menu')->name('client.menu');

// Contact Us (Client Side)
Route::get('/contact', [ContactController::class, 'show'])->name('client.contact');
Route::post('/contact/submit', [ContactController::class, 'submit'])->name('client.contact.submit');

// Feedback (Client Side)
Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('client.feedback.submit');

// Admin routes for Contact Us & Feedback Management
Route::prefix('admin')->group(function () {
    // Contact Messages
    Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contacts/{id}', [ContactController::class, 'showMessage'])->name('contact.show');
    Route::post('/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply');

    // Feedback Messages
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');
});
