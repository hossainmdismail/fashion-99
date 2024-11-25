<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AdminOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SEOController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\AttrSizeController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FeaturesController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\AttrColorController;
use App\Http\Controllers\CustomLinkController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CampaignProduct;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\CampaignController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\VariationController;
use App\Http\Controllers\Backend\AttributeController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController as ControllersProductController;
use App\Http\Controllers\CategoryController as ControllersCategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Frontend\ProfileController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ThemesController;

//Frontend
Auth::routes();

Route::get('/', [FrontendController::class, 'home'])->name('index');
Route::get('/products/{slugs}', [ControllersProductController::class, 'single'])->name('product.view');
//Cart Route
Route::post('/add/cart', [ControllersProductController::class, 'cart'])->name('addtocart');
Route::get('/cart/items', [ControllersProductController::class, 'cartitems'])->name('cart.items');
Route::get('/cart/item/remove/{inventory}', [CartController::class, 'remove'])->name('cart.item.remove');
Route::get('/cart/item/increment/{inventory}', [CartController::class, 'increment'])->name('cart.item.increment');
Route::get('/cart/item/decrement/{inventory}', [CartController::class, 'decrement'])->name('cart.item.decrement');


Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');
Route::get('/checkout/data', [CheckoutController::class, 'checkoutitems'])->name('checkout.items');
Route::post('/checkout/confirm', [CheckoutController::class, 'checkoutconfirm'])->name('checkout.confirm');

//Landing
Route::get('/step/{slugs}', [LandingController::class, 'landingView'])->name('landing.view');
Route::get('/flow/premium-semi-hoodies/step/premium-semi-hoodies', [LandingController::class, 'one']);
Route::get('/public/flow/premium-semi-hoodies-2/step/premium-semi-hoodies-2', [LandingController::class, 'two']);
Route::post('/checkout/landing/confirm', [LandingController::class, 'order'])->name('landing.order');

Route::get('/categories/{slugs}', [ControllersCategoryController::class, 'index'])->name('front.category');
Route::get('/shop', [ShopController::class, 'shop'])->name('shop');
Route::get('/features', [FeaturesController::class, 'features'])->name('features');
Route::get('/hot-deal', [FeaturesController::class, 'hot'])->name('hot');
Route::post('/order', [OrderController::class, 'order'])->name('user.order');
Route::get('/thankyou/{order_id}', [OrderController::class, 'thankyou'])->name('thankyou');
Route::get('/about', [HomeController::class, 'aboutus'])->name('aboutus');
Route::get('/contact', [HomeController::class, 'contact'])->name('contact');
Route::get('/campaign/{id}', [HomeController::class, 'campaign'])->name('campaign.product.list');
Route::get('/privacy-policy', [HomeController::class, 'privacy'])->name('privacy');
Route::post('/comment', [CommentController::class, 'store'])->name('comment.post');
Route::get('/sitemap', [SEOController::class, 'sitemap'])->name('sitemap');

Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::get('/profile/{id}', [ProfileController::class, 'editOrder'])->name('profile.order.edit');
Route::post('/profile', [ProfileController::class, 'update'])->name('profile.order.update');

Route::middleware(['admin'])->prefix('euphoriadmin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('/country', CountryController::class);
    Route::get('/create/admin', [AdminController::class, 'create_admin'])->name('create.admin');
    Route::post('/create/role/admin', [AdminController::class, 'create_role_admin'])->name('create.role.admin');
    Route::get('/order', [AdminOrder::class, 'order'])->name('admin.order');
    Route::post('/order/payment', [AdminOrder::class, 'payment'])->name('add.payment');
    Route::get('/order/view/{id}', [AdminOrder::class, 'orderView'])->name('admin.order.view');
    Route::post('/order/view/modify', [AdminOrder::class, 'orderViewModify'])->name('admin.order.modify');
    Route::get('/order/history/{id}', [AdminOrder::class, 'orderHistory'])->name('admin.order.history');

    // Route::post('/csv/download', [AdminOrder::class, 'csvDownload'])->name('csv.download');
    Route::post('/csv/download', [AdminOrder::class, 'xlsxDownload'])->name('csv.download');
    Route::post('/campaign/product', [CampaignProduct::class, 'destroy'])->name('campaign.product');
    // attributes
    Route::group(['prefix' => 'attr'], function () {
        Route::get('index', function () {
            return view('backend.attributes.index');
        })->name('attr');
        Route::resource('/size', AttrSizeController::class);
        Route::resource('/color', AttrColorController::class);
    });
    Route::resource('/category', CategoryController::class);
    Route::resource('/banner', BannerController::class);
    Route::resource('/config', ConfigController::class);
    Route::resource('/customlink', CustomLinkController::class);
    Route::resource('/campaign', CampaignController::class);
    Route::resource('/variation', VariationController::class);
    Route::resource('/product', App\Http\Controllers\Admin\ProductController::class);
    Route::resource('/coupon', App\Http\Controllers\Backend\CouponController::class);
    Route::resource('/shipping', ShippingController::class);
    Route::resource('/attributes', AttributeController::class);
    Route::resource('/campaign-product', CampaignController::class);
    Route::resource('/employee', EmployeeController::class);
    Route::resource('/themes', ThemesController::class);
});

//admin login
Route::prefix('euphoriadmin')->group(function () {
    Route::get('/register', [AdminController::class, 'admin_register'])->name('admin.register');
    Route::post('/store', [AdminController::class, 'admin_store'])->name('admin.store');
    Route::get('/login', [AdminController::class, 'admin_login'])->name('admin.login');
    Route::POST('/logout', [AdminController::class, 'admin_logout'])->name('admin.logout');
    Route::post('/adminlogin', [AdminController::class, 'adminlogin'])->name('adminlogin');
});
