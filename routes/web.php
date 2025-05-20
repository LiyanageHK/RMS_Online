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

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController as AuthLogin;
use App\Http\Controllers\Auth\UserController as RegUser;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
//use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\CustomerController;
use App\Http\Controllers\Auth\PageController;
use App\Models\Order;
use App\Http\Controllers\Auth\UserLoginController;
use App\Http\Controllers\EmailController;


use App\Models\Feedback;


use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PurchaseOrderController;
//use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\GRNController;

use App\Http\Controllers\OrderController;

use App\Http\Controllers\OrderStatusController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CusOrderController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminOrderController;


// Homepage
Route::get('/', function () {
    $feedbacks = Feedback::all();
    $feedbacks = Feedback::all();
    return view('welcome', compact('feedbacks'), compact('feedbacks'));
})->name('welcome');

Route::get('/menu', [App\Http\Controllers\MenuController::class, 'index'])->name('menu');

Route::get('/about', function () {
    return view('client.about');
})->name('about');




Route::get('/contact', [ContactController::class, 'show'])->name('contact');




Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




Route::get('/profile', [ProfileController::class, 'index'])->name('profile');



Route::get('/profile/orders', [ProfileController::class, 'orders'])->name('profile.orders');





Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');




Route::get('/profile', [ProfileController::class, 'index'])->name('profile');



//

Auth::routes();


//Route::get('/contact', function () {
   // return view('contact');
//})->name('contact');



Auth::routes();
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {


//Route::get('/contact', function () {
   // return view('contact');
//})->name('contact');





Route::get('/cart', function () {
    return view('cart'); // Ensure you have a 'cart.blade.php' file in the 'resources/views' directory
})->name('cart');

}); // <-- Close the first Route group here

Auth::routes();
Route::middleware(['auth:admin'])->prefix('admin')->group(function () {

    // 🔸 Category CRUD
    Route::get('categories', [ItemCategoryController::class, 'index'])->name('admin.categories.index');
    Route::get('categories/create', [ItemCategoryController::class, 'create'])->name('admin.categories.create');
    Route::post('categories/store', [ItemCategoryController::class, 'store'])->name('admin.categories.store');
    Route::get('categories/edit/{id}', [ItemCategoryController::class, 'edit'])->name('admin.categories.edit');
    Route::post('categories/update/{id}', [ItemCategoryController::class, 'update'])->name('admin.categories.update');
    Route::delete('categories/delete/{id}', [ItemCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('admin/categories/report', [ItemCategoryController::class, 'downloadReport'])->name('admin.categories.report');
    Route::delete('categories/delete/{id}', [ItemCategoryController::class, 'destroy'])->name('admin.categories.destroy');
    Route::get('admin/categories/report', [ItemCategoryController::class, 'downloadReport'])->name('admin.categories.report');

    // 🔸 Item CRUD
    Route::get('items', [ItemController::class, 'index'])->name('admin.items.index');
    Route::get('items/create', [ItemController::class, 'create'])->name('admin.items.create');
    Route::post('items/store', [ItemController::class, 'store'])->name('admin.items.store');
    Route::get('items/edit/{id}', [ItemController::class, 'edit'])->name('admin.items.edit');
    Route::post('items/update/{id}', [ItemController::class, 'update'])->name('admin.items.update');
    Route::delete('admin/items/delete/{id}', [ItemController::class, 'destroy'])->name('admin.items.destroy');
    Route::get('admin/items/report', [ItemController::class, 'downloadReport'])->name('admin.items.report');
    Route::delete('admin/items/delete/{id}', [ItemController::class, 'destroy'])->name('admin.items.destroy');
    Route::get('admin/items/report', [ItemController::class, 'downloadReport'])->name('admin.items.report');

    // Production CRUD
    Route::get('production', [ProductionController::class, 'index'])->name('admin.production.index');
    Route::get('production/create', [ProductionController::class, 'create'])->name('admin.production.create');
    Route::post('production/store', [ProductionController::class, 'store'])->name('admin.production.store');
    Route::get('production/edit/{id}', [ProductionController::class, 'edit'])->name('admin.production.edit');
    Route::post('production/update/{id}', [ProductionController::class, 'update'])->name('admin.production.update');
    Route::delete('production/delete/{id}', [ProductionController::class, 'destroy'])->name('admin.production.destroy');
    Route::delete('production/delete/{id}', [ProductionController::class, 'destroy'])->name('admin.production.destroy');
    Route::delete('production/image/delete/{id}', [ProductionController::class, 'deleteImage'])->name('admin.production.image.delete');
    Route::get('admin/production/report', [ProductionController::class, 'downloadReport'])->name('admin.production.report');
    Route::get('admin/production/report', [ProductionController::class, 'downloadReport'])->name('admin.production.report');

    // Role CRUD
    Route::get('role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('role/create', [RoleController::class, 'create'])->name('admin.role.create');
    Route::post('role/store', [RoleController::class, 'store'])->name('admin.role.store');
    Route::get('role/edit/{id}', [RoleController::class, 'edit'])->name('admin.role.edit');
    Route::post('role/update/{id}', [RoleController::class, 'update'])->name('admin.role.update');
    Route::get('role/delete/{id}', [RoleController::class, 'destroy'])->name('admin.role.destroy');


    Route::get('grns/report', [GRNController::class, 'downloadReport'])->name('grns.report');
Route::get('purchase_orders/report', [PurchaseOrderController::class, 'downloadReport'])->name('purchase_orders.report');


    // Product Categories CRUD
    Route::prefix('productcategories')->group(function () {
        Route::get('/', [ProductCategoryController::class, 'index'])->name('admin.productcategories.index');
        Route::get('/create', [ProductCategoryController::class, 'create'])->name('admin.productcategories.create');
        Route::post('/store', [ProductCategoryController::class, 'store'])->name('admin.productcategories.store');
        Route::get('/edit/{id}', [ProductCategoryController::class, 'edit'])->name('admin.productcategories.edit');
        Route::post('/update/{id}', [ProductCategoryController::class, 'update'])->name('admin.productcategories.update');
        Route::delete('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.productcategories.destroy');
        Route::delete('/delete/{id}', [ProductCategoryController::class, 'destroy'])->name('admin.productcategories.destroy');
    });
    Route::get('admin/productcategories/report', [ProductCategoryController::class, 'downloadReport'])->name('admin.productcategories.report');
    Route::get('admin/productcategories/report', [ProductCategoryController::class, 'downloadReport'])->name('admin.productcategories.report');
    Route::resource('employees', EmployeeController::class);
    Route::get('profile', [EmployeeController::class, 'profile'])->name('employees.profile');
    Route::put('profile', [EmployeeController::class, 'updateProfile'])->name('employees.updateProfile');
    Route::get('change-password', [EmployeeController::class, 'showChangePasswordForm'])->name('employees.changePasswordForm');
    Route::post('change-password', [EmployeeController::class, 'changePassword'])->name('employees.changePassword');

    Route::get('/user_permissions', [AuthController::class, 'getUserPermissions']);
    Route::post('/update_permission', [AuthController::class, 'updatePermission'])->name('admin.update.permission');
  Route::get('inventory-predictions', [HomeController::class, 'getPredictions'])->name('inventory.predictions');

    Route::prefix('inventory')->group(function () {
        Route::get('/', [InventoryController::class, 'index'])->name('admin.inventory.index');
        Route::get('/{id}', [InventoryController::class, 'show'])->name('admin.inventory.show');
        Route::get('/low-stock', [InventoryController::class, 'lowStock'])->name('admin.inventory.low-stock');
    });


    // Admin Order CRUD
    Route::prefix('/orders')->group(function () {
    Route::get('/', [AdminOrderController::class, 'index'])->name('admin.orders.index');
    Route::delete('/delete/{id}', [AdminOrderController::class, 'delete']);
    Route::delete('/delete-all', [AdminOrderController::class, 'deleteAll']);
    Route::get('/download/{id}', [AdminOrderController::class, 'downloadPDF']);
    Route::get('/download-all', [AdminOrderController::class, 'downloadAllPDF']);
    });




        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

  Route::post('/inventory/low-stock/{item}/alert', [InventoryController::class, 'sendLowStockAlert'])
    ->name('admin.inventory.send-low-stock-alert');

// Order Status Management
// Route::get('/admin/orders', [OrderStatusController::class, 'index'])->name('orders.index');
// Route::post('/admin/orders/{order}/update-status', [OrderStatusController::class, 'updateStatus'])->name('orders.updateStatus');

// Core resources
Route::resource('/admin/suppliers', SupplierController::class);
Route::resource('/admin/purchase_orders', PurchaseOrderController::class);
Route::resource('/admin/grns', GRNController::class);

Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
    Route::get('/contacts/{id}', [ContactController::class, 'showMessage'])->name('contact.show');
    Route::post('/contacts/{id}/reply', [ContactController::class, 'reply'])->name('contact.reply');


Route::get('/driver/allocate', [DriverController::class, 'allocateDriver'])->name('admin.driver.allocate');
//Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.driver.pendingAllocation');
Route::get('/driver/orders/dispatched', [DriverController::class, 'showDispatchedOrders'])->name('admin.driver.orders.dispatched'); //for Delivery Confirmation
Route::get('/delivery-history', [DriverController::class, 'deliveryHistory'])->name('admin.delivery.history');   //delivery History
// Route for Driver Allocation Details
Route::get('/driver-allocation-details', [DriverController::class, 'driverAllocationDetails'])->name('admin.driver.allocationDetails');
Route::post('/driver/store-allocation', [DriverController::class, 'storeAllocation'])->name('admin.driver.storeAllocation');
Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.pending-allocation');
//Route::get('/driver/allocation/details', [DriverController::class, 'allocationDetails'])->name('admin.driver.allocation.details');
Route::get('/pending-allocations', [DriverController::class, 'pendingAllocation'])->name('admin.pendingAllocation');
Route::get('/driver/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.driver.pendingAllocation');
//Route::get('/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.pendingAllocation');
Route::delete('/driver/delete/delivery/{delivery_id}', [DriverController::class, 'deleteDelivery'])->name('admin.driver.delete.delivery');

Route::match(['get', 'put'], '/driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])->name('admin.driver.edit.delivery');

Route::get('/drivers', [DriverController::class, 'driverListView'])->name('admin.driver.list');  //Display Driver List in Admin Panel

Route::get('/driver/allocation/details', [DriverController::class, 'allocationDetails'])->name('admin.driver.allocation.details');

//Route::match(['get', 'put'], '/admin/driver/delivery/{delivery_id}/edit', [DriverController::class, 'editDelivery'])->name('admin.driver.edit');
    // Feedback Messages
    Route::get('/feedback', [FeedbackController::class, 'index'])->name('feedback.index');
    Route::get('/feedback/{id}', [FeedbackController::class, 'show'])->name('feedback.show');


Route::get('/admin/driver/download-report/{orderId}', [DriverController::class, 'downloadReport'])
    ->name('admin.driver.downloadReport');



Route::get('/customer/create', [CustomerController::class, 'create'])->name('customer.create');
Route::get('/customer/overview', [CustomerController::class, 'index'])->name('customer.overview');
Route::post('/customer', [CustomerController::class, 'store'])->name('customer.store');

Route::get('/customer/{user_id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
Route::delete('/customer/{user_id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

Route::get('/send-email', function () {
    $customers = \App\Models\User::paginate(10);
    return view('customer.emailService', compact('customers'));
})->name('email.form');

//Customer Email Notification
Route::post('/send-email', [EmailController::class, 'sendBulkEmail'])->name('send.email');

Route::get('/customers/{userid}/loyalty', [CustomerController::class, 'loyalty'])->name('customer.loyalty');
Route::post('/loyalty/redeem', [CustomerController::class, 'redeem'])->name('loyalty.redeem');
Route::get('/customer/loyalty-program', [CustomerController::class, 'showLoyaltyProgram'])->name('loyalty-program');
Route::get('/loyalty/insert', [CustomerController::class, 'insertLoyalCustomers'])->name('loyalty.insert'); 
Route::get('orders/index', [OrderStatusController::class, 'index'])->name('orders.index');
Route::post('orders/{order}/update-status', [OrderStatusController::class, 'updateStatus'])->name('orders.updateStatus');


});



// Employee Routes

Route::get('/inventory-center', [InventoryController::class, 'index']);

// Route::get('purchase_orders/report', [PurchaseOrderController::class, 'downloadReport'])->name('purchase_orders.report');
// Route::get('grns/report', [GRNController::class, 'downloadReport'])->name('grns.report');













// Static client views
//Route::view('about', 'client.about')->name('client.about');
//Route::view('menu', 'client.menu')->name('client.menu');

// Contact Us (Client Side)

Route::post('/contact/submit', [ContactController::class, 'submit'])->name('client.contact.submit');

// Feedback (Client Side)
Route::post('/feedback/submit', [FeedbackController::class, 'submit'])->name('client.feedback.submit');

// Admin routes for Contact Us & Feedback Management
Route::prefix('admin')->group(function () {
    // Contact Messages

});







// Auth routes
//Route::get('/login', [AuthLogin::class, 'create'])->name('login');
//Route::post('/login', [AuthLogin::class, 'store']);
//Route::post('/logout', [AuthLogin::class, 'destroy'])->name('logout');
Route::get('/admin/register', [RegUser::class, 'create'])->name('admin.register');
Route::post('/register', [RegUser::class, 'store']);
Route::get('/register', [RegUser::class, 'create'])->name('register');
Route::post('/register', [RegUser::class, 'store']);




Route::get('/profile', [ProfileController::class, 'show'])->middleware('auth');
Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
Route::put('/profile/update/{user}', [UserController::class, 'updateProfile'])->name('profile.update');
//Route::get('/profile/orders', [UserController::class, 'showOrderHistory'])->name('profile.orders');



Route::post('/logout', function () {
    Auth::logout();
    return redirect()->route('home');
})->name('logout')->middleware('auth');






// Route::get('/admin/customer/create', [CustomerController::class, 'create'])->name('customer.create');
// Route::get('/admin/customer/overview', [CustomerController::class, 'index'])->name('customer.overview');
// Route::post('/admin/customer', [CustomerController::class, 'store'])->name('customer.store');

// Route::get('/customer/{user_id}/edit', [CustomerController::class, 'edit'])->name('customer.edit');
// Route::delete('/customer/{user_id}', [CustomerController::class, 'destroy'])->name('customer.destroy');

// Define the route for updating a customer
Route::put('/customer/{user_id}', [CustomerController::class, 'update'])->name('customer.update');

// Example assuming you're using CustomerController and the show() method
Route::get('/customer/{user_id}', [CustomerController::class, 'show'])->name('customer.show');

;



//Loyalty program
// Route::get('/customers/{userid}/loyalty', [CustomerController::class, 'loyalty'])->name('customer.loyalty');
// Route::post('/loyalty/redeem', [CustomerController::class, 'redeem'])->name('loyalty.redeem');
// Route::get('/admin/customer/loyalty-program', [CustomerController::class, 'showLoyaltyProgram'])->name('loyalty-program');
// Route::get('/loyalty/insert', [CustomerController::class, 'insertLoyalCustomers'])->name('loyalty.insert');   //add data to loyalty customer table




// Driver Routes

/*

Route::get('/driver/allocate', [DriverController::class, 'allocateDriver'])->name('admin.driver.allocate');
//Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.driver.pendingAllocation');
Route::get('/driver/orders/dispatched', [DriverController::class, 'showDispatchedOrders'])->name('admin.driver.orders.dispatched'); //for Delivery Confirmation
Route::get('/delivery-history', [DriverController::class, 'deliveryHistory'])->name('admin.delivery.history');   //delivery History
// Route for Driver Allocation Details
Route::get('/driver-allocation-details', [DriverController::class, 'driverAllocationDetails'])->name('admin.driver.allocationDetails');
Route::post('/driver/store-allocation', [DriverController::class, 'storeAllocation'])->name('admin.driver.storeAllocation');
Route::get('/driver-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.pending-allocation');
//Route::get('/driver/allocation/details', [DriverController::class, 'allocationDetails'])->name('admin.driver.allocation.details');
Route::get('/pending-allocations', [DriverController::class, 'pendingAllocation'])->name('admin.pendingAllocation');
Route::get('/driver/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.driver.pendingAllocation');
//Route::get('/pending-allocation', [DriverController::class, 'pendingAllocation'])->name('admin.pendingAllocation');
Route::delete('/driver/delete/delivery/{delivery_id}', [DriverController::class, 'deleteDelivery'])->name('admin.driver.delete.delivery');

Route::match(['get', 'put'], '/driver/edit/delivery/{delivery_id}', [DriverController::class, 'admin.editDelivery'])->name('admin.driver.edit.delivery');

Route::get('/drivers', [DriverController::class, 'driverListView'])->name('admin.driver.list');  //Display Driver List in Admin Panel

Route::get('/driver/allocation/details', [DriverController::class, 'allocationDetails'])->name('admin.driver.allocation.details');

//Route::match(['get', 'put'], '/admin/driver/delivery/{delivery_id}/edit', [DriverController::class, 'editDelivery'])->name('admin.driver.edit');



//to display drivers on ride
Route::get('/drivers-on-ride', [DriverController::class, 'showDriversOnRide'])->name('admin.showDriversOnRide');




Route::get('/admin/driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])
    ->name('admin.driver.edit.delivery');


Route::match(['get', 'put'], '/driver/edit/delivery/{delivery_id}', [DriverController::class, 'editDelivery'])->name('admin.driver.edit');
*/

/*


//Customer Side Login
// Show login form
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');

// Handle login
Route::post('/login', [UserLoginController::class, 'login']);

// Handle logout
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');
*/
// Example authenticated route


Route::get('/homepage', function () {
    return view('home');
})->middleware('auth')->name('homepage');

Route::controller(ProductController::class)->middleware(['auth', 'verified'])->group(function(){
Route::get('/productIndex','Index')->name('productindex');
Route::post('/saveproduct', 'storeproduct');
Route::get('/plist','list')->name('productlist');

});

Route::controller(CusOrderController::class)->middleware(['auth', 'verified'])->group(function(){  
Route::post('/confirm-order', 'confirmOrder')->name('confirm.order');
Route::get('/stripe-success', 'stripeSuccess')->name('stripe.success');
Route::get('/my-orders', [CusOrderController::class, 'userOrders'])->name('user.orders');
Route::get('/order-details/{id}', [CusOrderController::class, 'getOrderDetails']);
Route::patch('/cancel-order/{id}', [CusOrderController::class, 'cancelOrder']);
Route::get('/successorder', 'stripeSuccess')->name('stripe.success');
Route::get('/successorder', [CusOrderController::class, 'paymentcomplete'])->name('ordersuccess');
});

Route::controller(CartController::class)->middleware(['auth', 'verified'])->group(function(){
Route::get('/productdetails.', [CartController::class, 'view'])->name('productdetails.view');
Route::get('/cart','showCart')->name('cartview');
Route::get('/checkout', [CartController::class, 'checkout'])->name('checkout');
Route::delete('/cart/{id}', 'removeItem')->name('cart.remove');
Route::post('/add-to-cart', [CartController::class, 'addToCart'])->name('add.to.cart');
Route::post('/cart/update-quantity', [CartController::class, 'updateQuantity'])->name('cart.updateQuantity');

});

//customer profile change password
Route::put('/profile/change-password/{user}', [ProfileController::class, 'changePassword'])->name('profile.changePassword');

// ===================== ADMIN (EMPLOYEE) LOGIN =====================
Route::get('/admin/login', [AuthLogin::class, 'create'])->name('admin.login');
Route::post('/admin/login', [AuthLogin::class, 'store']);
Route::post('/admin/logout', [AuthLogin::class, 'destroy'])->name('admin.logout');

// ===================== USER (CLIENT) LOGIN =====================
Route::get('/login', [UserLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [UserLoginController::class, 'login']);
Route::post('/logout', [UserLoginController::class, 'logout'])->name('logout');








//Mark order as delivered in order table

Route::patch('/driver/orders/{order}/mark-delivered', [DriverController::class, 'markOrderDelivered'])->name('admin.driver.orders.markDelivered');


//Custmer Email Notification
// Route::get('/send-email', function () {
//     $customers = \App\Models\User::paginate(10);
//     return view('customer.emailService', compact('customers'));
// })->name('email.form');

// //Customer Email Notification
// Route::post('/send-email', [EmailController::class, 'sendBulkEmail'])->name('send.email');
