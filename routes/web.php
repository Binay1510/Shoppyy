<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BrandsController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Cart;
use Illuminate\Support\Facades\Route;

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

//user routes

Route::controller(App\Http\Controllers\HomeController::class)->group(function () {
    Route::get('/', 'index')->name('home');  // Route for displaying the home page
    Route::get('/view-product/{product}', 'productInfo')->name('product_info'); // Route for viewing detailed product information
});

//login-register auth

Route::controller(App\Http\Controllers\AuthenticationController::class)->group(function () {
    // Route for displaying the registration form
    Route::get('/register', 'register')->name('register');

    // Route for storing user registration data
    // This route handles the form submission from the registration form
    Route::post('/register', 'storeUser')->name('store_user');

    // Route for displaying the login form
    Route::get('/login', 'login')->name('login');

    // Route for authenticating user login
    // This route handles the form submission from the login form
    Route::post('/login', 'authenticate')->name('authenticate');
    // Route for logging out the user
    Route::get('/logout', 'logout')->name('logout');
});


// Define routes for managing the cart
Route::resource('cart', App\Http\Controllers\CartController::class);

// Route for adding a product to the cart
Route::post('add-to-cart', [App\Http\Controllers\CartController::class, 'addToCart'])->name('add_to_cart');

// Route for storing the order after checkout
Route::get('store-order', [CartController::class, 'storeOrder'])->name('store_order');


//profile user update

// Define routes for managing user profiles
Route::controller(App\Http\Controllers\UserController::class)->group(function () {
    // Route for displaying the user profile
    Route::get('/profile', 'userProfile')->name('user_profile');

    // Route for updating the user profile information
    Route::put('/profile', 'userProfileUpdate')->name('user_profile_update');

    // Route for updating the user profile image
    Route::post('/user-image-update', 'userProfileImageUpdate')->name('user_profile_image_update');
});

//admin routes 

//ADDING PREFIX   -> to access the admin so well not write admin/abc on everypage so adding for all as a grp
// Define routes for the admin section with a prefix of '/admin' and middleware for role-based access control
Route::group(['prefix' => '/admin', 'middleware' => ['CheckRoles']], function () {
    // Controller routes for admin actions
    Route::controller(App\Http\Controllers\AdminController::class)->group(function () {
        Route::get('/', 'index')->name('admin_home');
        Route::get('/user_list', 'usersList')->name('admin_user_list');
        // Route::get('/edit-user/{id}','editUsers')->name('admin_user_edit');
        Route::get('/change-user-status/{id}/{status?}', 'changeUserStatus')->name('admin_change_user_status');

    });

    // Define resource routes for managing brands
    Route::resource('brands', App\Http\Controllers\BrandsController::class);
    // Group routes for additional brand actions
    Route::controller(BrandsController::class)->group(function () {
        // Route for changing brand image
        Route::post('/change-brand-image/{id}', 'changeBrandImage')->name('admin_brand_image_change');
        // Route for changing brand status
        Route::get('/change-brand-status/{id}/{status?}', 'changeBrandStatus')->name('admin_change_brand_status');

    });

    // Define routes for managing orders
    Route::controller(OrderController::class)->group(function () {
        Route::get('/orders', 'index')->name('list_orders');
        Route::get('/line_items/{id}', 'getLineItems')->name('get_line_items');

    });
    // Define routes for managing products
        Route::resource('product', App\Http\Controllers\ProductController::class);
        Route::controller(ProductController::class)->group(function () {
        Route::post('/change-product-image/{id}', 'changeProductImage')->name('admin_product_image_change');
        Route::get('/change-product-status/{id}/{status?}', 'changeProductStatus')->name('admin_change_product_status');
    });
});


