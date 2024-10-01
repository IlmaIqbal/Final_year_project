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
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\WrappingPaperController;
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

Route::get('products/gift', [GiftController::class, 'index'])->name('products.gift');
Route::get('products/gift_store', [GiftController::class, 'create'])->name('products.gift_store');
Route::post('store/', [GiftController::class, 'store'])->name('gift.store');
Route::get('gift_show/{gift}', [GiftController::class, 'show'])->name('products.gift_show');
Route::get('gift_edit/{gift}', [GiftController::class, 'edit'])->name('products.gift_edit');
Route::put('gift_edit/{gift}', [GiftController::class, 'update'])->name('gift.update');
Route::delete('/{gift}', [GiftController::class, 'destroy'])->name('destroy');
Route::post('/products/{gift}/enable', [GiftController::class, 'enable'])->name('gift.enable');

// Display in customer interface 

Route::get('user/products/gift', [GiftController::class, 'customer_gift'])->name('user.products.gift');

// add to cart Gifts
Route::post('/add_cart_gift/{id}', [GiftController::class, 'add_cart_gift'])->name('products.add_cart_gift');

// Search Route for gifts

Route::get('/search', [GiftController::class, 'search'])->name('search');

//Wrapping Paper Route

Route::get('products/wrapping', [WrappingPaperController::class, 'index'])->name('products.wrapping');
Route::get('products/wrapping_store', [WrappingPaperController::class, 'create'])->name('products.wrapping_store');
Route::post('wrapping/store/', [WrappingPaperController::class, 'store'])->name('wrapping.store');
Route::get('wrapping_show/{wrapping_paper}', [WrappingPaperController::class, 'show'])->name('products.wrapping_show');
Route::get('wrapping_edit/{wrapping_paper}', [WrappingPaperController::class, 'edit'])->name('products.wrapping_edit');
Route::put('wrapping_edit/{wrapping_paper}', [WrappingPaperController::class, 'update'])->name('wrapping.update');
Route::delete('/wrapping_paper/{wrapping_paper}', [WrappingPaperController::class, 'destroy'])->name('wrapping.destroy');
Route::post('/products/{wrapping_paper}/enable', [WrappingPaperController::class, 'enable'])->name('wrapping_paper.enable');


Route::get('user/products/wrapping_paper', [WrappingPaperController::class, 'customer_box'])->name('user.products.wrapping_paper');

// add to cart boxes
Route::post('/add_cart_wrapping/{id}', [WrappingPaperController::class, 'add_cart_wrapping'])->name('products.add_cart_wrapping');

// Search Route for wrapping paper

Route::get('wrapping/search', [WrappingPaperController::class, 'search'])->name('wrapping.search');

//Wrapping Paper Route

Route::get('products/bouquet', [BouquetController::class, 'index'])->name('products.bouquet');
Route::get('products/bouquet_store', [BouquetController::class, 'create'])->name('products.bouquet_store');
Route::post('bouquet/store/', [BouquetController::class, 'store'])->name('bouquet.store');
Route::get('bouquet_show/{bouquet}', [BouquetController::class, 'show'])->name('products.bouquet_show');
Route::get('bouquet_edit/{bouquet}', [BouquetController::class, 'edit'])->name('products.bouquet_edit');
Route::put('bouquet_edit/{bouquet}', [BouquetController::class, 'update'])->name('bouquet.update');
Route::delete('/bouquet/{bouquet}', [BouquetController::class, 'destroy'])->name('bouquet.destroy');
Route::post('/products/{bouquet}/enable', [BouquetController::class, 'enable'])->name('bouquet.enable');

Route::get('user/products/bouquet', [BouquetController::class, 'customer_bouquet'])->name('user.products.bouquet');

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
Route::post('/services/{service}/enable', [ServiceController::class, 'enable'])->name('services.enable');

//  Resource controller for invitation
Route::resource('invitations', InvitationController::class);
Route::get('services/invitation/index', [InvitationController::class, 'index'])->name('services.invitation.index');
Route::get('services/invitation/create', [InvitationController::class, 'create'])->name('services.invitation.create');
Route::post('services/invitation/create', [InvitationController::class, 'store'])->name('services.invitation.store');
Route::get('/invitations/{invitation}/edit', [InvitationController::class, 'edit'])->name('services.invitation.edit');
Route::put('/invitations/{invitation}', [InvitationController::class, 'update'])->name('services.invitation.update');
Route::post('/invitations/{invitation}/enable', [InvitationController::class, 'enable'])->name('invitation.enable');
Route::delete('/invitations/{invitation}/disable', [InvitationController::class, 'disable'])->name('services.invitation.disable');


// Route for Customer interface for services
Route::get('customers/services/invitation', [InvitationController::class, 'invitation_index'])->name('customers.services.invitation');

// Route for decoration in admin panel
Route::get('services/decoration/index', [DecorationController::class, 'index'])->name('services.decoration.index');
Route::get('services/decoration/create', [DecorationController::class, 'create'])->name('services.decoration.create');
Route::post('services/decoration/create', [DecorationController::class, 'store'])->name('services.decoration.store');
Route::get('/decorations/{decoration}/edit', [DecorationController::class, 'edit'])->name('services.decoration.edit');
Route::put('/decorations/{decoration}', [DecorationController::class, 'update'])->name('services.decoration.update');
Route::post('/decorations/{decoration}/enable', [DecorationController::class, 'enable'])->name('decoration.enable');
Route::delete('/decorations/{decoration}/disable', [DecorationController::class, 'disable'])->name('services.decoration.disable');

// Route for Customer interface for services
Route::get('customers/services/decoration', [DecorationController::class, 'decoration_index'])->name('customers.services.decoration');

// Route for entertainment in admin panel
Route::get('services/entertainment/index', [EntertainmentController::class, 'index'])->name('services.entertainment.index');
Route::get('services/entertainment/create', [EntertainmentController::class, 'create'])->name('services.entertainment.create');
Route::post('services/entertainment/create', [EntertainmentController::class, 'store'])->name('services.entertainment.store');
Route::get('/entertainments/{entertainment}/edit', [EntertainmentController::class, 'edit'])->name('services.entertainment.edit');
Route::put('/entertainments/{entertainment}', [EntertainmentController::class, 'update'])->name('services.entertainment.update');
Route::post('/entertainments/{entertainment}/enable', [EntertainmentController::class, 'enable'])->name('entertainment.enable');
Route::delete('/entertainments/{entertainment}/disable', [EntertainmentController::class, 'disable'])->name('services.entertainment.disable');

// Route for Customer interface for services
Route::get('customers/services/entertainment', [EntertainmentController::class, 'entertainment_index'])->name('customers.services.entertainment');

// Resource controller for Venue

Route::resource('venues', VenueController::class);
Route::post('/venues/{venue}/enable', [VenueController::class, 'enable'])->name('venues.enable');

// Route for Customer interface for venue
Route::get('customers/customerVenue', [VenueController::class, 'customer_index'])->name('customers.customerVenue');

// Resource controller for events

Route::get('events/index', [EventController::class, 'index'])->name('events.index');
Route::get('events/create', [EventController::class, 'create'])->name('events.create');
Route::post('events/create', [EventController::class, 'store'])->name('events.store');
Route::post('/show', [EventController::class, 'show'])->name('events.show');
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

Route::get('events/payment', [PaymentController::class, 'process'])->name('events.payment');
Route::get('/events/service-selection', [EventController::class, 'showServiceSelection'])->name('events.service_selection');

// Notification

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

// Contact Us
Route::get('contactUs/contact_us', [ContactController::class, 'show'])->name('contactUs.contact_us');
Route::post('contactUs/contact_us', [ContactController::class, 'send'])->name('contact_us.send');

// Shopping cart
Route::get('cart/', [CartController::class, 'index'])->name('cart');
Route::get('/remove_cart/{id}', [CartController::class, 'remove_cart'])->name('remove_cart');

// customer payment route
Route::get('user/payment', [PaymentController::class, 'index'])->name('user.payment');
Route::get('/store_order', [PaymentController::class, 'store_order'])->name('store_order');

//Order route for admin
Route::get('admin/order', [OrderController::class, 'view_order'])->name('admin.order');
Route::get('/delivered/{id}', [OrderController::class, 'delivered'])->name('delivered');

//Order route for customer
Route::get('user/order', [OrderController::class, 'customer_order'])->name('user.order');

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


Route::get('user/event_book', [EventController::class, 'showEventBooking'])->name('user.event_book');

Route::get('customer_bookings/bookings', [EventController::class, 'showBookingForm'])->name('customer_bookings.bookings');
Route::post('/add_Booking', [EventController::class, 'add_Booking'])->name('add_Booking');

Route::get('customer_bookings/payment', [EventController::class, 'event_payment'])->name('customer_bookings.payment');

Route::get('customer_bookings/bill', [EventController::class, 'payment'])->name('customer_bookings.bill');

Route::get('/download-invoice', [InvoiceController::class, 'downloadInvoice'])->name('download.invoice');

Route::post('/store-invoice', [InvoiceController::class, 'store'])->name('store.invoice');
Route::get('/invoice/{id}', [InvoiceController::class, 'show'])->name('invoice.show');

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
