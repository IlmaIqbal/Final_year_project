<?php

use App\Http\Controllers\Auth\HomeController;
use App\Http\Controllers\BouquetController;
use App\Http\Controllers\CalenderController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DecorationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EntertainmentController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeedBackController;
use App\Http\Controllers\Front_officeController;
use App\Http\Controllers\GiftController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReorderController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\WrappingPaperController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('user/product', function () {
    return view('user.product');
})->name('user.product');

Route::get('user/main', function () {
    return view('user.main');
})->name('user.main');

// Admin route
Route::get('admin/home', function () {
    return view('admin/home');
})->middleware(['auth', 'verified', 'admin'])->name('admin.home');

// Customer route
Route::get('user/home', function () {
    return view('user/home');
})->middleware(['auth', 'verified', 'user'])->name('user.home');

// Front Office route
Route::get('front_office/home', function () {
    return view('front_office/home');
})->middleware(['auth', 'verified', 'front_office'])->name('front_office.home');

Route::get('deliver/home', function () {
    return view('deliver/home');
})->middleware(['auth', 'verified', 'deliver'])->name('deliver.home');

Route::get('supplier/home', function () {
    return view('supplier/home');
})->middleware(['auth', 'verified', 'supplier'])->name('supplier.home');

Route::get('cashier/home', function () {
    return view('cashier/home');
})->middleware(['auth', 'verified', 'cashier'])->name('cashier.home');

Route::get('productManager/home', function () {
    return view('productManager/home');
})->middleware(['auth', 'verified', 'product_manager'])->name('productManager.home');

Route::get('stockKeeper/home', function () {
    return view('stockKeeper/home');
})->middleware(['auth', 'verified', 'stock_keeper'])->name('stockKeeper.home');

Route::get('user/order-confirmation', function () {
    return view('user.order-confirmation');
})->name('order_confirmation');

Route::get('user/online-confirmation', function () {
    return view('user.online-confirmation');
})->name('online_confirmation');

Route::get('user/order-details', function () {
    return view('user.order-details');
})->name('order-details');

Route::get('admin/admin-order-details', function () {
    return view('admin.admin-order-details');
})->name('admin-order-details');

Route::get('user/delivery_detail', function () {
    return view('user.delivery_detail');
})->middleware('auth')->name('user.delivery_detail');

Route::get('report/inventoryReport/inventoryReport', function () {
    return view('report.inventoryReport.inventoryReport');
})->name('report.inventoryReport.inventoryReport');


Route::get('/order/{order}', [OrderController::class, 'show_invoice'])->name('user.order-confirmation');
Route::get('/user/online-confirmation', [OrderController::class, 'onlineConfirmation'])->name('user.online-confirmation');

Route::get('/orders/{orderId}', [OrderController::class, 'show_details'])->name('user.order-details');
Route::get('/user/bank_recipe/{orderId}', [OrderController::class, 'bank_recipe'])->name('user.bank_recipe');

Route::get('/admin/orders/{orderId}', [OrderController::class, 'admin_order_details'])->name('admin.order-details');



Route::get('role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('role/create', [RoleController::class, 'store'])->name('role.store');

Auth::routes();

// Dashboard route
Route::get('admin/dashboard', [HomeController::class, 'index'])->middleware('auth')->name('admin.dashboard');


// Route::get('role\index', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
// Route::post('role\index', [App\Http\Controllers\Auth\RegisterController::class, 'register']);



// Employee Route

Route::get('employee/index', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('employee/create', [EmployeeController::class, 'store'])->name('employee.store');

//customers Route

Route::get('customers/index', [CustomerController::class, 'index'])->name('customers.index');
Route::post('customers/addNewCustomer', [CustomerController::class, 'store'])->name('customers.store');
Route::get('customers/addNewCustomer', function () {
    return view('customers.addNewCustomer');
})->name('customer.addNew');

//supplier route

Route::get('supplier/index', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
Route::post('supplier/create', [SupplierController::class, 'store'])->name('supplier.store');
Route::get('edit/{user}', [SupplierController::class, 'edit'])->name('supplier.edit');
Route::put('update/{user}', [SupplierController::class, 'update'])->name('supplier.update');
Route::delete('/user/{user}/disable', [SupplierController::class, 'disable'])->name('supplier.disable');
Route::post('/user/{user}/enable', [SupplierController::class, 'Enable'])->name('supplier.enable');



// Route::post('/edit', [App\Http\Controllers\PermissionController::class, 'edit'])->name('permission.edit');


// Route::get('admin/home', [App\Http\Controllers\Auth\HomeController::class, 'index'])->name('admin.home');
// Route::get('user/home', [App\Http\Controllers\user\HomeController::class, 'index'])->name('user.home');




// Profile Route

Route::get('/profiles/index', [ProfileController::class, 'index'])->name('profile.index')->middleware('auth');
Route::post('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile');
Route::delete('/users/{id}', [ProfileController::class, 'destroy'])->name('users.index');
Route::get('/pages/page01', [ProfileController::class, 'page01'])->name('page.page01');
Route::get('profile/password', [ProfileController::class, 'showChangePasswordForm'])->name('user.password.change');
Route::post('profile/password', [ProfileController::class, 'changePassword'])->name('user.password.update');

// Gift Route

Route::get('products/index', [ProductController::class, 'index'])->name('products.index');
Route::get('products/store', [ProductController::class, 'create'])->name('products.store');
Route::post('store/', [ProductController::class, 'store'])->name('product.store');
Route::get('show/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('gift_edit/{product}', [ProductController::class, 'edit'])->name('products.edit');
Route::put('gift_edit/{product}', [ProductController::class, 'update'])->name('product.update');
Route::delete('/product/{product}/disable', [ProductController::class, 'product_destroy'])->name('product.destroy');
Route::post('/products/{product}/enable', [ProductController::class, 'Enable'])->name('product.enable');
Route::post('/store-order', [OrderController::class, 'store'])->name('store_order');
Route::get('/products/by-type/{type}', [InventoryController::class, 'getProductsByType']);


//find product
Route::get('/product/find', [ProductController::class, 'find_product'])->name('find-gift');

// Display in customer interface 

Route::get('user/products/gift', [ProductController::class, 'customer_gift'])->name('user.products.gift');
Route::get('cart', [ProductController::class, 'cart_qty'])->name('cart');
Route::get('user/products/bouquet', [ProductController::class, 'customer_bouquet'])->name('user.products.bouquet');
Route::get('user/products/wrapping_paper', [ProductController::class, 'customer_wrapping'])->name('user.products.wrapping_paper');
Route::get('/product/{id}', [ProductController::class, 'item_details'])->name('user.products.item_details');

// add to cart Gifts
Route::post('/add_cart_gift/{id}', [ProductController::class, 'add_cart_gift'])->name('products.add_cart_gift');

// Search Route for gifts

Route::get('/search', [ProductController::class, 'search'])->name('search');

//Wrapping Paper Route

Route::get('wrapping/wrapping', [WrappingPaperController::class, 'index'])->name('wrapping.wrapping');
Route::get('wrapping/wrapping_store', [WrappingPaperController::class, 'create'])->name('wrapping.wrapping_store');
Route::post('wrapping/store/', [WrappingPaperController::class, 'store'])->name('wrapping.store');
Route::get('wrapping_show/{wrapping_paper}', [WrappingPaperController::class, 'show'])->name('wrapping.wrapping_show');
Route::get('wrapping_edit/{wrapping_paper}', [WrappingPaperController::class, 'edit'])->name('wrapping.wrapping_edit');
Route::put('wrapping_edit/{wrapping_paper}', [WrappingPaperController::class, 'update'])->name('wrapping.update');
Route::post('/wrapping/{wrapping_paper}/enable', [WrappingPaperController::class, 'wrappingEnable'])->name('wrapping_paper.enable');
Route::delete('/wrapping_paper/{wrapping_paper}', [WrappingPaperController::class, 'destroy'])->name('wrapping.destroy');



// add to cart boxes
Route::post('/add_cart_wrapping/{id}', [WrappingPaperController::class, 'add_cart_wrapping'])->name('products.add_cart_wrapping');

// Search Route for wrapping paper

Route::get('wrapping/search', [WrappingPaperController::class, 'search'])->name('wrapping.search');

//Wrapping Paper Route

Route::get('bouquet/bouquet', [BouquetController::class, 'index'])->name('bouquet.bouquet');
Route::get('bouquet/bouquet_store', [BouquetController::class, 'create'])->name('bouquet.bouquet_store');
Route::post('bouquet/store/', [BouquetController::class, 'store'])->name('bouquet.store');
Route::get('bouquet_show/{bouquet}', [BouquetController::class, 'show'])->name('bouquet.bouquet_show');
Route::get('bouquet_edit/{bouquet}', [BouquetController::class, 'edit'])->name('bouquet.bouquet_edit');
Route::put('bouquet_edit/{bouquet}', [BouquetController::class, 'update'])->name('bouquet.update');
Route::delete('/bouquet/{bouquet}', [BouquetController::class, 'bouquetDestroy'])->name('bouquet.destroy');
Route::post('/bouquet/{bouquet}/enable', [BouquetController::class, 'bouquetEnable'])->name('bouquet1.enable');


Route::post('/add-cart-ajax', [CartController::class, 'addCartAjax'])->name('products.add_cart_gift_ajax');
// add to cart Bouquet
Route::post('/add_cart_bouquet/{id}', [BouquetController::class, 'add_cart_bouquet'])->name('products.add_cart_bouquet');

// Search Route for wrapping paper

Route::get('bouquet/search', [BouquetController::class, 'search'])->name('bouquet.search');

// Calender

Route::get('calendar', [CalenderController::class, 'index'])->name('calendar');
Route::post('calendar', [CalenderController::class, 'store'])->name('calendar.store');

// Resource controller for catering services

Route::resource('services', ServiceController::class);
Route::post('/services/{service}/enable', [ServiceController::class, 'enable'])->name('services.enable');
Route::post('/services/{service}/disable', [ServiceController::class, 'disable'])->name('services.destroy');

// Route for service selection view
// Route::get('events/service_selection', [ServiceController::class, 'showServiceSelection'])->name('events.service_selection');

// Route for Customer interface for services
Route::get('customers/services/catering', [ServiceController::class, 'catering_index'])->name('customers.services.catering');

Route::get('customers/customerService', function () {
    return view('customers.customerService');
})->name('customers.customerService');

Route::get('events/payment', function () {
    return view('events.payment');
})->name('events.payment');

//  Resource controller for decoration
Route::resource('decorations', DecorationController::class);

//  Resource controller for invitation
Route::resource('invitations', InvitationController::class);
Route::get('services/invitation/index', [InvitationController::class, 'index'])->name('services.invitation.index');
Route::get('services/invitation/create', [InvitationController::class, 'create'])->name('services.invitation.create');
Route::post('services/invitation/create', [InvitationController::class, 'store'])->name('services.invitation.store');
Route::get('/invitations/{invitation}/edit', [InvitationController::class, 'edit'])->name('services.invitation.edit');
Route::put('/invitations/{invitation}', [InvitationController::class, 'update'])->name('services.invitation.update');
Route::post('/invitations/{invitation}/enable', [InvitationController::class, 'enable'])->name('invitation.enable');
Route::post('/invitations/{invitation}/disable', [InvitationController::class, 'disable'])->name('services.invitation.disable');


// Route for Customer interface for services
Route::get('customers/services/invitation', [InvitationController::class, 'invitation_index'])->name('customers.services.invitation');

// Route for decoration in admin panel
Route::get('services/decoration/index', [DecorationController::class, 'index'])->name('services.decoration.index');
Route::get('services/decoration/create', [DecorationController::class, 'create'])->name('services.decoration.create');
Route::post('services/decoration/create', [DecorationController::class, 'store'])->name('services.decoration.store');
Route::get('/decorations/{decoration}/edit', [DecorationController::class, 'edit'])->name('services.decoration.edit');
Route::put('/decorations/{decoration}', [DecorationController::class, 'update'])->name('services.decoration.update');
Route::post('/decorations/{decoration}/enable', [DecorationController::class, 'enable'])->name('decoration.able');
Route::post('/decorations/{decoration}/disable', [DecorationController::class, 'disable'])->name('services.decoration.able');

// Route for Customer interface for services
Route::get('customers/services/decoration', [DecorationController::class, 'decoration_index'])->name('customers.services.decoration');

// Route for entertainment in admin panel
Route::get('services/entertainment/index', [EntertainmentController::class, 'index'])->name('services.entertainment.index');
Route::get('services/entertainment/create', [EntertainmentController::class, 'create'])->name('services.entertainment.create');
Route::post('services/entertainment/create', [EntertainmentController::class, 'store'])->name('services.entertainment.store');
Route::get('/entertainments/{entertainment}/edit', [EntertainmentController::class, 'edit'])->name('services.entertainment.edit');
Route::put('/entertainments/{entertainment}', [EntertainmentController::class, 'update'])->name('services.entertainment.update');
Route::post('/entertainments/{entertainment}/enable', [EntertainmentController::class, 'enable'])->name('entertainment.enable');
Route::post('/entertainments/{entertainment}/disable', [EntertainmentController::class, 'disable'])->name('services.entertainment.disable');

// Route for Customer interface for services
Route::get('customers/services/entertainment', [EntertainmentController::class, 'entertainment_index'])->name('customers.services.entertainment');

// Resource controller for Venue

Route::resource('venues', VenueController::class);
Route::post('/venues/{venue}/enable', [VenueController::class, 'enable'])->name('venues.enable');

// Route for Customer interface for venue
Route::get('customers/customerVenue', [VenueController::class, 'customer_index'])->name('customers.customerVenue');

// Resource controller for events

Route::get('events/index', [EventController::class, 'index'])->name('events.index');
Route::post('events/create', [EventController::class, 'store'])->name('events.store');
Route::get('/events/show', [EventController::class, 'show'])->name('events.show');
Route::post('/events/{event}/approve', [EventController::class, 'approve'])->name('events.approve');
Route::post('/events/{event}/reject', [EventController::class, 'reject'])->name('events.reject');
Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

Route::get('services/select', [ServiceController::class, 'select_catering'])->name('services.select');
Route::post('services/select', [ServiceController::class, 'store_catering'])->name('services.store');


Route::get('/events/{event}/decoration', [DecorationController::class, 'decoration.select']);
Route::post('/events/{event}/decoration', [DecorationController::class, 'decoration.store']);

Route::get('/events/{event}/invitation', [InvitationController::class, 'invitation.select']);
Route::post('/events/{event}/invitation', [InvitationController::class, 'invitation.store']);

Route::get('/events/{event}/entertainment', [EntertainmentController::class, 'entertainment.select']);
Route::post('/events/{event}/entertainment', [EntertainmentController::class, 'entertainment.store']);

Route::get('/events/{event}/payment', [PaymentController::class, 'payment.create']);
Route::post('/events/{event}/payment', [PaymentController::class, 'payment.store']);

Route::get('/events/service-selection', [EventController::class, 'showServiceSelection'])->name('events.service_selection');

// Notification

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

//Product Manager
Route::get('productManager/notification', [NotificationController::class, 'manager_index'])->name('productManager.notification');
Route::get('productManager/notification/{id}', [NotificationController::class, 'managerRead'])->name('productManager.notifications.read');

// Stock keeper notification
Route::get('stockKeeper/notification', [NotificationController::class, 'stock_index'])->name('stockKeeper.notification');
Route::get('stockKeeper/notification/{id}', [NotificationController::class, 'stockKeeperRead'])->name('stockKeeper.notifications.read');

// Deliver Notification
Route::get('deliver/deliverNotify', [NotificationController::class, 'deliver_index'])->name('deliver.deliverNotify');
Route::get('deliver/notification/{id}', [NotificationController::class, 'deliverRead'])->name('deliver.notifications.read');

// Cashier notification
Route::get('cashier/notification', [NotificationController::class, 'cashier_index'])->name('cashier.notification');
Route::get('cashier/notification/{id}', [NotificationController::class, 'cashierRead'])->name('cashier.notifications.read');
Route::post('cashier/confirmPayment/{orderId}', [PaymentController::class, 'confirmPayment'])->name('cashier.confirmPayment');
Route::get('cashier/payment', [PaymentController::class, 'payments'])->name('cashier.payment');
Route::get('cashier/pending', [PaymentController::class, 'pending'])->name('cashier.pending');
Route::get('cashier/invoice/{order}', [PaymentController::class, 'invoice'])->name('cashier.invoice');

// Supplier notification
Route::post('/product_manager/send-to-supplier/{reorder}', [ReorderController::class, 'sendToSupplier'])->middleware('auth')->name('reorder.sendToSupplier');
Route::get('supplier/notification', [NotificationController::class, 'supplier_index'])->name('supplier.notification');
Route::get('supplier/notification/{id}', [NotificationController::class, 'supplierRead'])->name('supplier.notifications.read');

// Contact Us
Route::get('contactUs/contact_us', [ContactController::class, 'show'])->name('contactUs.contact_us');
Route::post('contactUs/contact_us', [ContactController::class, 'send'])->name('contact_us.send');

// Shopping cart
Route::get('cart/', [CartController::class, 'index'])->name('cart');
Route::get('/remove_cart/{id}', [CartController::class, 'remove_cart'])->name('remove_cart');

// customer payment route
Route::get('user/payment', [PaymentController::class, 'index'])->name('user.payment');
Route::get('/store_order', [PaymentController::class, 'store_order'])->name('store_order');
Route::get('/return', [PaymentController::class, 'handleReturn']);

//Order route for admin
Route::get('admin/order', [OrderController::class, 'view_order'])->name('admin.order');
Route::get('/delivered/{id}', [OrderController::class, 'delivered'])->name('delivered');
Route::put('/order/{order}/update-status', [OrderController::class, 'update_order_status'])->name('update_order_status');
Route::put('/order/{order}/issue-update', [OrderController::class, 'update_issue_status'])->name('update_issue_status');
Route::put('/order/{order}/update_delivery', [OrderController::class, 'update_delivery'])->name('update_delivery');
Route::put('/order/{order}/order_delivered', [OrderController::class, 'order_delivered'])->name('order_delivered');
Route::put('/order/{order}/recipe_update', [OrderController::class, 'recipe_update'])->name('recipe_update');

//Order route for customer
Route::get('user/order', [OrderController::class, 'customer_order'])->name('user.order');
Route::post('/store_order', [OrderController::class, 'store'])->name('store_order');

// order route deliver
Route::get('deliver/order', [OrderController::class, 'deliver_order'])->name('deliver.order');

//Showing invoice after payment
Route::get('emails/invoice', [RoleController::class, 'invoice'])->name('emails.invoice');

//Send request to check weather venue available or not
Route::get('user/venue_select', [VenueController::class, 'customer_select'])->name('user.venue_select');

//Notification to admin
Route::post('/notifyAdmin', [NotificationController::class, 'notifyAdmin'])->name('notifyAdmin');
Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');

//Email notification for user about venue
Route::get('/send_email/{id}', [NotificationController::class, 'send_email'])->name('send_email');
Route::get('/unavailable_venue/{id}', [NotificationController::class, 'unavailable_venue'])->name('unavailable_venue');

Route::post('/send_user_email/{id}', [NotificationController::class, 'send_user_email'])->name('send_user_email');


// Route for the admin panel
Route::get('events/create', [EventController::class, 'showEventBooking'])
    ->name('events.create')
    ->defaults('view', 'events.create');

Route::get('user/event', [EventController::class, 'customer_event'])->name('user.event');

// Route for the user interface
Route::get('user/event_book', [EventController::class, 'showEventBooking'])
    ->name('user.event_book')
    ->defaults('view', 'user.event_book');

Route::get('customer_bookings/bookings', [EventController::class, 'showBookingForm'])->name('customer_bookings.bookings');

Route::get('events/checkOut', [EventController::class, 'showCheckOut'])->name('events.checkOut');


Route::post('/add_Booking', [EventController::class, 'add_Booking'])->name('add_Booking');

Route::get('customer_bookings/payment', [EventController::class, 'event_payment'])->name('customer_bookings.payment');

// Route for customer page
Route::get('customer_bookings/bill', [EventController::class, 'payment'])->name('customer_bookings.bill');

// Route for admin page
Route::get('events/adminBill', function () {
    return view('events.adminBill');
})->name('events.adminBill');

Route::post('/download-invoice', [InvoiceController::class, 'downloadInvoice'])->name('download.invoice');
Route::post('/store-booking', [PaymentController::class, 'storeEventData'])->name('store.booking');
Route::post('/store-admin-booking', [PaymentController::class, 'storeAdminData'])->name('store.admin.booking');

Route::post('/store-invoice', [InvoiceController::class, 'store'])->name('store.invoice');
Route::get('/invoice/{id}', [InvoiceController::class, 'showInvoice'])->name('invoice.show');

Route::get('front_office/employee', [Front_officeController::class, 'show_emp'])->name('front_office.employee');
Route::get('front_office/customer', [Front_officeController::class, 'show_cus'])->name('front_office.customer');

Route::get('front_office/catering', [Front_officeController::class, 'catering_view'])->name('front_office.catering');
Route::get('front_office/invitation', [Front_officeController::class, 'invitation_view'])->name('front_office.invitation');
Route::get('front_office/decoration', [Front_officeController::class, 'decoration_view'])->name('front_office.decoration');
Route::get('front_office/entertainment', [Front_officeController::class, 'entertainment_view'])->name('front_office.entertainment');


// route for feedbacks
Route::get('user/feedBack', [FeedBackController::class, 'create'])->name('user.feedBack');
Route::post('user/feedBack', [FeedBackController::class, 'store'])->name('feedBack.store');
Route::get('admin/feeds', [FeedBackController::class, 'view_admin'])->name('admin.feeds');

//route for inventory
Route::get('/inventory', [InventoryController::class, 'index'])->name('inventory.index');


// Show inventory form (with checkboxes)
Route::get('/inventory/create', [InventoryController::class, 'create'])->name('inventory.create');

// Store inventory from form
Route::post('/inventory/store', [InventoryController::class, 'store'])->name('inventory.store');

//For Stock page
Route::get('/inventory/stock', [InventoryController::class, 'stock_index'])->name('inventory.stock');
Route::get('stockKeeper/order', [OrderController::class, 'stockKeeper_view_order'])->name('stockKeeper.order');

//Inventory searching 
Route::get('/inventory/search', [InventoryController::class, 'search'])->name('inventory.search');

//Reorder Form create
Route::get('/reorder/{inventoryId}', [ReorderController::class, 'create'])->name('reorders.create');
Route::post('/reorder/store', [ReorderController::class, 'store'])->name('reorders.store');
Route::get('productManager/reorder', [ReorderController::class, 'manager_index'])->name('productManager.reorder');
Route::get('supplier/reorder', [ReorderController::class, 'supplier_index'])->name('supplier.reorder');

Route::put('/reorder/reject/{id}', [ReorderController::class, 'manager_reject'])->name('manager.reject');

Route::post('/reorder/approval/{id}', [ReorderController::class, 'supplier_approve'])->name('supplier.approve');
Route::put('supplier/reject/{id}', [ReorderController::class, 'supplier_reject'])->name('supplier.reject');

// Sales report
Route::get('report/sale', [ReportController::class, 'saleReport'])->name('report.saleReport');
// View filtered report table
Route::get('/report/sale/view', [ReportController::class, 'viewFilteredReport'])->name('report.saleReport.view');

// Download PDF
Route::get('/report/sale/pdf', [ReportController::class, 'downloadReport'])->name('report.saleReport.pdf');

Route::get('/report/inventory/redirect', [ReportController::class, 'redirectToReport'])->name('report.inventoryReport.redirect');
Route::get('/report/inventory/stock', [ReportController::class, 'stockLevel'])->name('report.inventoryReport.stockLevel');
Route::get('/report/inventory/top-sell', [ReportController::class, 'topSellProduct'])->name('report.inventoryReport.topSellProduct');
Route::get('/report/inventory/reorder', [ReportController::class, 'reorder'])->name('report.inventoryReport.reorderReport');

Route::get('/report/inventory/pdf', [ReportController::class, 'downloadInventoryReport'])->name('report.inventoryReport.pdf');
Route::get('/report/topSell/pdf', [ReportController::class, 'downloadTopSellProductReport'])->name('report.topSellReport.pdf');
Route::get('/report/reorder/pdf', [ReportController::class, 'downloadReorderReport'])->name('report.reorderReport.pdf');

Route::get('/user/review/{order}', [FeedBackController::class, 'rateProduct'])->name('user.review');
Route::post('/user/add-rating', [FeedBackController::class, 'add_rating'])->name('add-rating');
