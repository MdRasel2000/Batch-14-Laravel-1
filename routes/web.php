<?php

use App\Http\Controllers\Backend\adminController;
use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\MessageController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\SiteSettingController;
use App\Http\Controllers\Backend\SubcategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

//frontend

Route::get('/', [FrontendController::class, 'index']);
Route::get('/product/dateils/{slug}', [FrontendController::class, 'productDateils']);
Route::get('view-cart', [FrontendController::class, 'viewCart']);
Route::get('checkout', [FrontendController::class, 'checkout']);
Route::get('add-to-cart/{id}', [FrontendController::class, 'addToCart']);
Route::get('add-to-cart/delete/{id}', [FrontendController::class, 'addToCartDelete']);
Route::post('add-to-cart/details/{id}', [FrontendController::class, 'addToCartDetails']);
Route::post('/confirm-order', [FrontendController::class, 'confirmOrder']);
Route::get('/order-confirmed/{invoiceId}', [FrontendController::class, 'thankYouPage']);
Route::get('/shop-products', [FrontendController::class, 'shopProducts']);
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy']);
Route::get('/terms-conditions', [FrontendController::class, 'termsConditions']);
Route::get('/refund-policy', [FrontendController::class, 'refundPolicy']);
Route::get('/payment-policy', [FrontendController::class, 'paymentPolicy']);
Route::get('/about-us', [FrontendController::class, 'aboutUs']);
Route::get('/search-products', [FrontendController::class, 'searchProduct']);



//category product

Route::get('/category-products/{slug}/{id}', [FrontendController::class, 'categoryProduct']);
Route::get('/subcategory-products/{slug}/{id}', [FrontendController::class, 'subCategoryProduct']);

Route::get('/type-products/{type}', [FrontendController::class, 'typeProduct']);


//return policy-about us-contact us

Route::get('/return-product', [FrontendController::class, 'showReturnForm']);
Route::post('/return-product-request/store', [FrontendController::class, 'storeReturnRequest']);
Route::get('/contact-us', [FrontendController::class, 'showContactForm']);
Route::post('/contact-form/store', [FrontendController::class, 'storeContactForm']);






Auth::routes();

//admin login url

Route::get('/admin/login', [AuthController::class, 'adminLogin'])->name('adminLogin');
Route::get('/admin/logout', [AuthController::class, 'adminLogout'])->name('adminLogout');

//admin dashboard

Route::middleware(['role:admin,employee,editor'])->group(function () {

    Route::get('/admin/dashboard', [adminController::class, 'dashboard'])->name('admindashboard');
});


Route::middleware(['role:admin,employee,editor'])->group(function () {

    //products routes

    Route::get('/admin/product-create', [ProductController::class, 'create'])->name('create-products');
    Route::post('/admin/product-store', [ProductController::class, 'store'])->name('store-products');
    Route::get('/admin/product-show', [ProductController::class, 'show'])->name('show-products');
    Route::get('/admin/product-delete/{id}', [ProductController::class, 'delete'])->name('delete-products');
    Route::get('/admin/product-edit/{id}', [ProductController::class, 'edit'])->name('edit-products');
    Route::post('/admin/product-update/{id}', [ProductController::class, 'update'])->name('update-products');

    //Review Routes

    Route::get('/admin/create-review', [ProductController::class, 'createReview'])->name('review-create');
    Route::post('/admin/store-review', [ProductController::class, 'storeReview'])->name('review-store');
    Route::get('/admin/show-reviews', [ProductController::class, 'showReview'])->name('review-show');
    Route::get('/admin/delete-review/{id}', [ProductController::class, 'deleteReview'])->name('review-delete');
    Route::get('/admin/edit-review/{id}', [ProductController::class, 'editReview'])->name('review-edit');
    Route::post('/admin/update-review/{id}', [ProductController::class, 'updateeReview'])->name('review-update');

});





Route::middleware(['role:admin'])->group(function () {


    //category routes

    Route::get('/admin/product-category', [CategoryController::class, 'create'])->name('category-products');
    Route::post('/admin/store-category', [CategoryController::class, 'store'])->name('store-products');
    Route::get('/admin/show-category', [CategoryController::class, 'show'])->name('list-products');
    Route::get('/admin/deete-category/{id}', [CategoryController::class, 'delete'])->name('delete-products');
    Route::get('/admin/edit-category/{id}', [CategoryController::class, 'edit'])->name('edit-products');
    Route::post('/admin/update-category/{id}', [CategoryController::class, 'update'])->name('update-products');



    //sub category routes

    Route::get('/admin/create-subcategory', [SubcategoryController::class, 'create'])->name('create-subproducts');
    Route::post('/admin/store-subcategory', [SubcategoryController::class, 'store'])->name('store-subproducts');
    Route::get('/admin/show-subcategory', [SubcategoryController::class, 'show'])->name('show-subproducts');
    Route::get('/admin/delete-subcategory/{id}', [SubcategoryController::class, 'delete'])->name('delete-subproducts');
    Route::get('/admin/edit-subcategory/{id}', [SubcategoryController::class, 'edit'])->name('edit-subproducts');
    Route::post('/admin/update-subcategory/{id}', [SubcategoryController::class, 'update'])->name('update-subproducts');
});




//Site Setting Policy

Route::middleware(['role:admin,editor'])->group(function () {

    Route::get('/admin/site-setting', [SiteSettingController::class, 'showSettings']);
    Route::post('/admin/site-setting/update', [SiteSettingController::class, 'updateSettings']);


    Route::get('/admin/show/privacy-policy', [SiteSettingController::class, 'showPrivacyPolicy']);
    Route::post('/admin/update/privacy-policy', [SiteSettingController::class, 'updatePrivacyPolicy']);


    Route::get('/admin/show/terms-conditions', [SiteSettingController::class, 'termsConditions']);
    Route::post('/admin/update/terms-conditions', [SiteSettingController::class, 'updateTermsConditions']);


    Route::get('/admin/show/refund-policy', [SiteSettingController::class, 'showRefundPolicy']);
    Route::post('/admin/update/refund-policy', [SiteSettingController::class, 'updateRefundPolicy']);


    Route::get('/admin/show/payment-policy', [SiteSettingController::class, 'showPaymentPolicy']);
    Route::post('/admin/update/payment-policy', [SiteSettingController::class, 'updatePaymentPolicy']);

    Route::get('/admin/show/about-us', [SiteSettingController::class, 'showAboutUs']);
    Route::post('/admin/update/about-us', [SiteSettingController::class, 'updateAboutUs']);
});





//orders route...


Route::middleware(['role:admin,employee,editor'])->group(function () {

    Route::get('/admin/all-orders', [OrderController::class, 'showAllOrders']);
    Route::get('/admin/order/status/{order_id}/{status_type}', [OrderController::class, 'updateStatus']);
    Route::get('/admin/all-orders/{status_type}', [OrderController::class, 'statusWiseOrder']);
    Route::get('/admin/order/edit/{id}', [OrderController::class, 'editOrder']);
    Route::post('/admin/order/update/{id}', [OrderController::class, 'updateOrder']);
});




//Credentials Route

Route::middleware(['role:admin,employee,editor'])->group(function () {

    Route::get('/admin/show-credentials', [AuthController::class, 'showCredentials']);
    Route::post('/admin/update-credentials', [AuthController::class, 'updateCredentials']);
});


//Eymployee Route

Route::middleware(['role:admin'])->group(function () {

    Route::get('/admin/show-employees', [RoleController::class, 'showEmployee']);
    Route::get('/admin/create-employees', [RoleController::class, 'createEmployee']);
    Route::post('/admin/store-employees', [RoleController::class, 'storeEmployee']);
    Route::get('/admin/edit-employees/{id}', [RoleController::class, 'editEmployee']);
    Route::post('/admin/update-employees/{id}', [RoleController::class, 'updateEmployee']);
});


//messages

Route::middleware(['role:admin,editor'])->group(function () {

    Route::get('/admin/show-contact-messages', [MessageController::class, 'showContactMessages']);
    Route::get('/admin/delete-contact-message/{id}', [MessageController::class, 'deleteContactMessages']);
    Route::get('/admin/show-return-req-messages', [MessageController::class, 'showReturnReqMessages']);
    Route::get('/admin/delete-return-req-messages/{id}', [MessageController::class, 'deleteReturnReqMessages']);

});


