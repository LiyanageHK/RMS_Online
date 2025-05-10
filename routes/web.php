<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as AuthLogin;
use App\Http\Controllers\Auth\UserController as RegUser;
use App\Http\Controllers\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\PageController;


// Public routes

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/login', [LoginController::class, 'create'])->name('login');
Route::post('/login', [LoginController::class, 'login']);


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');


Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');

Route::get('/home', function () {
    return view('homepage');
})->name('homepage');


Route::get('/menu', function () {
    return view('menu');
})->name('menu');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

// Auth routes
Route::get('/login', [AuthLogin::class, 'create'])->name('login');
Route::post('/login', [AuthLogin::class, 'store']);
Route::post('/logout', [AuthLogin::class, 'destroy'])->name('logout');

Route::get('/register', [RegUser::class, 'create'])->name('register');
Route::post('/register', [RegUser::class, 'store']);




Route::get('/', [HomeController::class, 'index'])->name('home');


Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');




Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');


//customer adimin panel
Route::prefix('admin/customer')->group(function () {
   // Route::get('/overview', function () {
     //   return view('customer.cusOverview');
    //})->name('customer.overview');

    Route::get('/loyalty', function () {
        return view('customer.cusLoyalty');
    })->name('customer.loyalty');

    Route::get('/email', function () {
        return view('customer.cusEmailService');
    })->name('customer.email');
});



Route::get('/admin/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/admin/customer/overview', [CustomerController::class, 'index'])->name('customer.overview');
Route::post('/admin/customer', [CustomerController::class, 'store'])->name('customer.store');

Route::get('/customer/{user_id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::delete('/customer/{user_id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

// Define the route for updating a customer
Route::put('/customer/{user_id}', [CustomerController::class, 'update'])->name('customer.update');

// Example assuming you're using CustomerController and the show() method
Route::get('/customer/{user_id}', [CustomerController::class, 'show'])->name('customer.show');

;

Route::get('/admin/customer/loyalty-program', [CustomerController::class, 'showLoyaltyProgram'])->name('loyalty-program');

//page controller
// Route for Customer Center
Route::get('/customer-center', [PageController::class, 'customerCenter'])->name('customer-center');

// Route for Delivery Center
Route::get('/delivery-center', [PageController::class, 'deliveryCenter'])->name('delivery-center');




//driver


// Route to display pending allocation
Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('driver.pendingAllocation');



// Route for Driver Allocation Details
Route::get('/driver-allocation-details', [DriverController::class, 'driverAllocationDetails'])->name('driver.allocationDetails');






//Route::get('allocate-driver/{order_id}', [DriverController::class, 'allocateDriver'])->name('driver.allocate');
//Route::post('store-allocation', [DriverController::class, 'storeAllocation'])->name('driver.storeAllocation');

Route::get('/driver/allocate/{order_id}', [DriverController::class, 'allocateDriver'])->name('driver.allocate');

Route::post('/driver/store-allocation', [DriverController::class, 'storeAllocation'])->name('driver.storeAllocation');
Route::get('/driver/allocate', [DriverController::class, 'allocateDriver'])->name('driver.allocate');



Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('pending-allocation');

Route::get('/driver/allocate', [DriverController::class, 'allocateDriver'])->name('driver.allocate');




Route::get('/driver/allocation/details', [DriverController::class, 'allocationDetails'])->name('driver.allocation.details');

Route::get('/pending-allocations', [DriverController::class, 'pendingAllocation'])->name('pendingAllocation');



Route::get('/driver/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('driver.pendingAllocation');
Route::get('/pending-allocations', [DriverController::class, 'pendingAllocation']);

Route::get('/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('pendingAllocation');


//Route::get('/driver/edit/{delivery_id}', [DriverController::class, 'edit'])->name('driver.edit.delivery');
Route::delete('/driver/delete/delivery/{delivery_id}', [DriverController::class, 'deleteDelivery'])->name('driver.delete.delivery');



//Route::put('/driver/edit-delivery/{delivery_id}', [DriverController::class, 'updateDelivery'])->name('driver.edit.delivery');
Route::match(['get', 'put'], '/driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])->name('driver.edit.delivery');


//Route::get('driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])->name('driver.edit.delivery');
Route::post('driver/update/delivery/{delivery_id}', [DriverController::class, 'updateDelivery'])->name('driver.update.delivery');
// Route to show the delivery edit form
Route::get('/driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])->name('driver.edit.delivery');

// Route to update the delivery
Route::put('/driver/edit/delivery/{delivery_id}', [DriverController::class, 'updateDelivery'])->name('driver.update.delivery');
