<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\ItemController;
use App\Http\Controllers\Admin\ItemCategoryController;
use App\Http\Controllers\Admin\ProductionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\InventoryController;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');
Auth::routes();





Route::middleware(['auth'])->prefix('admin')->group(function () {

    // 🔸 Category CRUD
    Route::get('categories', [ItemCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [ItemCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories/store', [ItemCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/edit/{id}', [ItemCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id}', [ItemCategoryController::class, 'update'])->name('admin.categories.update');
    Route::get('categories/delete/{id}', [ItemCategoryController::class, 'destroy'])->name('admin.categories.destroy');

    // 🔸 Item CRUD
    Route::get('items', [ItemController::class, 'index'])->name('admin.items.index');
    Route::get('items/create', [ItemController::class, 'create'])->name('admin.items.create');
    Route::post('items/store', [ItemController::class, 'store'])->name('admin.items.store');
    Route::get('items/edit/{id}', [ItemController::class, 'edit'])->name('admin.items.edit');
    Route::post('items/update/{id}', [ItemController::class, 'update'])->name('admin.items.update');
    Route::get('items/delete/{id}', [ItemController::class, 'destroy'])->name('admin.items.destroy');

    // Production CRUD
    Route::get('production', [ProductionController::class, 'index'])->name('admin.production.index');
    Route::get('production/create', [ProductionController::class, 'create'])->name('admin.production.create');
    Route::post('production/store', [ProductionController::class, 'store'])->name('admin.production.store');
    Route::get('production/edit/{id}', [ProductionController::class, 'edit'])->name('admin.production.edit');
    Route::post('production/update/{id}', [ProductionController::class, 'update'])->name('admin.production.update');
    Route::get('production/delete/{id}', [ProductionController::class, 'destroy'])->name('admin.production.destroy');
    Route::delete('production/image/delete/{id}', [ProductionController::class, 'deleteImage'])->name('admin.production.image.delete');

    // Role CRUD
    Route::get('role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');

    // Product Categories CRUD
    Route::prefix('productcategories')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('admin.productcategories.index');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('admin.productcategories.create');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('admin.productcategories.store');
        Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.productcategories.edit');
        Route::post('/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.productcategories.update');
        Route::get('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.productcategories.destroy');
    });
    Route::resource('employees', EmployeeController::class);
    Route::get('profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::put('profile', [EmployeeController::class, 'updateProfile'])->name('employees.updateProfile');
    Route::get('change-password', [EmployeeController::class, 'showChangePasswordForm'])->name('employees.changePasswordForm');
    Route::post('change-password', [EmployeeController::class, 'changePassword'])->name('employees.changePassword');

    Route::get('/user_permissions', [AuthController::class, 'getUserPermissions']);
    Route::post('/update_permission', [AuthController::class, 'updatePermission'])->name('admin.update.permission');

    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventory.index');
        Route::get('/{id}', [InventoryController::class, 'show'])->name('admin.inventory.show');
        Route::get('/low-stock', [InventoryController::class, 'lowStock'])->name('admin.inventory.low-stock');
    });

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Employee Routes

// Inventory Routes


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



Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');



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


//Route::get('/profile', [UserController::class, 'showProfile'])->name('profile');


Route::get('/profile', [ProfileController::class, 'show'])->name('profile');

Route::put('/profile/update/{user}', [UserController::class, 'updateProfile'])->name('profile.update');

Route::get('/profile/orders', [UserController::class, 'showOrderHistory'])->name('profile.orders');



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



//Loyalty program
Route::get('/customers/{userid}/loyalty', [CustomerController::class, 'loyalty'])->name('customer.loyalty');
Route::post('/loyalty/redeem', [CustomerController::class, 'redeem'])->name('loyalty.redeem');



Route::get('/admin/customer/loyalty-program', [CustomerController::class, 'showLoyaltyProgram'])->name('loyalty-program');


//Display Driver List in Admin Panel
Route::get('/drivers', [DriverController::class, 'driverListView'])->name('driver.list');


//to display drivers on ride
Route::get('/drivers-on-ride', [DriverController::class, 'showDriversOnRide']);


Route::get('/drivers', [DriverController::class, 'driverListView'])->name('driver.list');

//delivery History

Route::get('/delivery-history', [DriverController::class, 'deliveryHistory'])->name('delivery.history');


//customer Email Service


Route::get('/customer/email-service', [CustomerController::class, 'customerEmail'])->name('customer.email');
Route::post('/customer/send-emails', [CustomerController::class, 'sendCustomerEmails'])->name('customer.sendEmails');


// Route for email service
Route::get('/customer/email-service', [CustomerController::class, 'showEmailService'])->name('customer.emailService');
