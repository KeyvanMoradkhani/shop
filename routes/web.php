<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Route::prefix('api')->group(function (){
    Route::get('/categories','Admin\CategoryController@apiIndex');
    Route::post('/categories/attribute','Admin\CategoryController@apiIndexAttribute');
    Route::get('/province','Frontend\ProvinceController@getAllProvince');
    Route::get('/cities/{province_id}','Frontend\ProvinceController@getAllCities');
    Route::get('/products/{category_id}','Frontend\ProductController@getApiProduct');
    Route::get('/sort-products/{category_id}/{SortByPrice}/{pagination}','Frontend\ProductController@getApiSortProduct');
    Route::get('/attribute-groups/{category_id}','Frontend\ProductController@getApiAttributeGroups');
    Route::get('/filter-product/{category_id}/{SortByPrice}/{pagination}/{attribute}','Frontend\ProductController@getApiFilterProduct');
//    Route::get('/orders','Admin\OrderController@AllOrderList')->name('allorderslist.adminPanel');
    Route::get('/search/{search_text}', 'Frontend\SearchController@ApiSearchIndex')->name('ApiSearch.index');

});

Route::prefix('administrator')->group(function (){
    Route::get('/','Admin\MainController@index');
    Route::resource('/categories','Admin\CategoryController');
    Route::get('/categories/{id}/setting','Admin\CategoryController@indexSetting')->name('categories.indexSetting');
    Route::post('/categories/{id}/setting','Admin\CategoryController@saveSetting')->name('categories.saveSetting');
    Route::resource('/atrributes','Admin\AtrributeGroupController');
    Route::resource('/atrributes-value','Admin\AtrributeValueController');
    Route::resource('/brands','Admin\BrandController');
    Route::resource('/photos','Admin\PhotoController');
    Route::post('/photos/upload','Admin\PhotoController@upload')->name('photos.upload');
    Route::resource('/products','Admin\ProductController');
    Route::resource('/coupons','Admin\CouponController');
    Route::get('/orders','Admin\OrderController@index')->name('orders.adminPanel');
    Route::get('/orders/list/{id}','Admin\OrderController@getListOrder')->name('orders.list');
});

Route::post('/user_register','Frontend\UserController@UserRegister')->name('user_register');

Route::resource('/', 'Frontend\HomeController');

Route::get('/add-to-cart/{id}', 'Frontend\CartController@AddToCart')->name('add.cart');
Route::post('/remove-cart/{id}', 'Frontend\CartController@RemoveCart')->name('remove.cart');
Route::get('/cart', 'Frontend\CartController@Cart')->name('cart.cart');
Route::get('/product/{slug}', 'Frontend\ProductController@getProduct')->name('single.product');
Route::get('/category/{id}/{page?}', 'Frontend\ProductController@GetAllProductByCategory')->name('category.index');
Route::post('/search', 'Frontend\SearchController@index')->name('search.index');


Route::group(['middleware' => ['auth']], function () {
    Route::get('/profile', 'Frontend\UserController@profile')->name('profile');
    Route::get('/profile/order/{id}', 'Frontend\UserController@AllOrderUser')->name('profile.order');
    Route::get('/profile/order/list/{id}', 'Frontend\UserController@getListOrder')->name('profile.order.list');
    Route::post('/coupon', 'Frontend\CouponController@addcoupon')->name('add.coupon');
    Route::get('/order-verify','Frontend\OrderController@OrderVerify')->name('orders.user');
    Route::get('/payment-verify/{order_id?}','Frontend\PaymentController@PaymentVerify')->name('payment.verify');
});

Auth::routes();

