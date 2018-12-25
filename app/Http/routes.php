<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});
Route::get('admin/dashboard','AdminController@dashboard');
Route::get('admin/about','AdminController@about');
Route::post('admin/updateAbout/{about}','AdminController@updateAbout');
Route::get('admin/printOrder','AdminController@printOrder');
Route::get('admin/exportToPdf/{id}','AdminController@exportToPdf');
Route::get('cancelOrder/{item}','CartController@cancelOrder');
Route::post('getDeliveryCost','CartController@getDeliveryCost'); 
Route::post('getAllCost','CartController@getAllCost');

Route::get('admin/categories','AdminController@categories');
Route::post('admin/add_category','AdminController@addCategory');
Route::get('admin/category/{category}/edit','AdminController@edit_category');
Route::post('admin/category/{category}/update','AdminController@update_category');
Route::get('admin/category/{category}/delete','AdminController@delete_category');
Route::post('admin/getCategories','AdminController@getCategories'); 
Route::post('admin/getSubParent','AdminController@getSubParent');
Route::post('admin/getSubCategory','AdminController@getSubCategory');

Route::get('admin/delivery_settings','AdminController@delivery_settings');
Route::post('admin/add_delivery_settings','AdminController@addDelivery');
Route::get('admin/delivery_settings/{item}/edit','AdminController@edit_delivery');
Route::post('admin/delivery_settings/{item}/update','AdminController@update_delivery');
Route::get('admin/delivery_settings/{item}/delete','AdminController@delete_delivery');
Route::post('admin/getCities','AdminController@getCities'); 
Route::post('getRegions','CartController@getRegions'); 
Route::post('admin/addRegion','AdminController@addRegion');
Route::post('admin/addCity','AdminController@addCity');
Route::get('admin/region/{item}/delete','AdminController@delete_region');
Route::get('admin/city/{item}/delete','AdminController@delete_city');


Route::get('admin/add_product','AdminController@add_product');
Route::post('admin/addproduct','AdminController@addProduct');
Route::get('admin/all_products','AdminController@all_products');
Route::get('admin/{product}/edit_product','AdminController@edit_product');
Route::post('admin/{product}/update_product','AdminController@update_product');
Route::get('admin/{product}/delete_product','AdminController@delete_product');
Route::post('admin/{product}/upload_img','AdminController@upload_imgProduct');

Route::get('admin/new_article','AdminController@new_article');
Route::get('admin/all_articles','AdminController@all_articles');
Route::post('admin/addArticle','AdminController@addArticle');
Route::get('admin/{article}/edit_article','AdminController@edit_article');
Route::post('admin/{article}/update_article','AdminController@update_article');
Route::get('admin/{item}/delete_article','AdminController@delete_article');
Route::post('admin/tbl_actions','AdminController@tbl_actions');

Route::get('admin','MyController@login');
Route::get('admin/login','MyController@login');
Route::get('admin/profile','UsersController@profile');

Route::get('admin/users/add','AdminController@add_user');
Route::post('admin/adduser','AdminController@adduser');
Route::get('admin/users/all','AdminController@all_users');
Route::get('admin/supervisors','AdminController@supervisors');

Route::get('admin/{myUser}/edit_user','AdminController@edit_user');
Route::post('admin/{myUser}/update_user','AdminController@update_user');
Route::get('admin/{myUser}/delete_user','AdminController@delete_user');
Route::post('admin/{myUser}/updateRole','AdminController@updateRole');
//Route::post('admin/{myUser}/update_userPrv','AdminController@update_userPrv');

Route::get('admin/slideshow','AdminController@slideshow');
Route::post('admin/add_slideshow','AdminController@add_slideshow');
Route::get('admin/slideshow/{slideshow}/delete','AdminController@delete_slideshow');
Route::get('admin/slideshow/{slideshow}/edit','AdminController@edit_slideshow');
Route::post('admin/slideshow/{slideshow}/update','AdminController@update_slideshow');


Route::get('admin/site_settings','SiteSettings@site_settings');
Route::post('admin/add_setting','SiteSettings@add_setting');
Route::get('admin/setting/{setting}/delete','SiteSettings@delete_setting');
Route::get('admin/setting/{setting}/edit','SiteSettings@edit_setting');
Route::post('admin/setting/{setting}/update','SiteSettings@update_setting');


Route::get('admin/social_links','SiteSettings@social_links');
Route::post('admin/add_social','SiteSettings@add_social');
Route::get('admin/social/{social}/delete','SiteSettings@delete_social');
Route::get('admin/social/{social}/edit','SiteSettings@edit_social');
Route::post('admin/social/{social}/update','SiteSettings@update_social');

Route::get('admin/orders','AdminController@orders');
Route::get('admin/{order}/order','AdminController@order');
Route::post('admin/{order}/editOrderStatus','AdminController@editOrderStatus');
Route::get('admin/delete_order/{order}','AdminController@delete_order');

Route::get('admin/adsbymail','AdminController@adsbymail');
Route::get('admin/adsbysms','AdminController@adsbysms');
Route::post('admin/sendAdsMail','AdminController@sendAdsMail');
Route::post('admin/sendAdsSms','AdminController@sendAdsSms');
Route::get('admin/{id}/delete_email','AdminController@delete_email');
Route::get('admin/{id}/delete_sms','AdminController@delete_sms');
Route::get('admin/notifications','AdminController@notifications');
Route::post('admin/sendNotification','AdminController@sendNotification');
Route::get('admin/{id}/deleteNotification','AdminController@deleteNotification');

Route::get('products','MyController@products');
Route::get('offers','MyController@offers');
Route::get('product/{item}','MyController@product');
Route::get('category/{category}','MyController@category');
Route::get('subcategory/{subcategory}','MyController@subcategory');
Route::get('most_ordered','MyController@most_ordered');

Route::get('contact','MyController@contact');
Route::get('about','MyController@about');
Route::post('contact_us','MyController@contact_us');

Route::auth();

Route::get('/', 'HomeController@index');
Route::get('search','HomeController@search');
Route::get('register', 'HomeController@register');
Route::post('signup', 'HomeController@signup');
Route::get('profile', 'UsersController@profile');
Route::post('{user}/update_user','UsersController@update_user');
Route::get('article/{article}', 'HomeController@article');
Route::get('articles', 'HomeController@articles');
Route::get('complaints','HomeController@complaints');
Route::post('send_complaint','HomeController@send_complaint');

Route::post('add_tocart','CartController@add_tocart');
Route::get('cart','CartController@cart');
Route::post('removeFromCart/{id}','CartController@removeFromCart');
Route::get('chooseAddress','CartController@chooseAddress');
Route::post('makeOrder','CartController@makeOrder');
Route::get('success','CartController@success');
Route::get('append_cart_items/{prod_id}','CartController@append_cart_items');

Route::group(['middleware' => ['auth']], function() {
    Route::get('track/{order}','CartController@track');
    Route::get('shipping','CartController@shipping');
    Route::get('order/{order}','CartController@order');
    Route::get('follow_order','CartController@follow_order');
});
Route::get('addresses','CartController@addresses');
Route::post('addAddress','CartController@addAddress');

Route::post('add_tofav','CartController@add_tofav');
Route::get('favourite','CartController@favourite');
Route::post('removeFromFav/{id}','CartController@removeFromFav');
Route::post('getCities','MyController@getCities');
Route::post('newsletter','HomeController@newsletter');


//**************** api RestFull **********************
//http://homestead.app/api/Message?with=user&limit=2&order_by=id:DESC&id=1
 Route::group(['middleware' => ['cors']], function (){
Route::get('api','ApiController@index');
Route::post('api/login','ApiController@login');
Route::post('api/mail','ApiController@mail');
Route::get('api/insert_token','ApiController@insert_token');

Route::get('api/join/{table}','ApiController@join');
Route::get('api/{table}','ApiController@select');

Route::post('api/insert/{table}','ApiController@insert');
Route::post('api/update/{table}','ApiController@update');
Route::post('api/delete/{table}','ApiController@delete');
    
 });
 
 //Route::post('api/insert/{table}','ApiController@insert',['middleware' => 'cors']);
 

