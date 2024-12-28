<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', 'App\Http\Controllers\PagesController@index')->name('index.page');


//Resort none auth grouped routes
Route::group(['prefix' => '/resorts', 'as' => 'resorts.'], function () {
Route::get('/', 'App\Http\Controllers\PagesController@resorts')->name('resorts.page');
Route::get('/resort/{id}', 'App\Http\Controllers\PagesController@resort')->name('resort.page');
Route::get('/resort/{resort_id}/{id}', 'App\Http\Controllers\PagesController@rooms')->name('rooms.page');

Route::post('/load_resort_data', 'App\Http\Controllers\AjaxRequestController@load_resort_data');

});

//Boat none auth grouped routes
Route::group(['prefix' => '/boats', 'as' => 'boats.'], function () {
Route::get('/', 'App\Http\Controllers\PagesController@boat_page')->name('boats.page');
Route::get('/boat/{id}', 'App\Http\Controllers\PagesController@boat_single')->name('boat.page');
});
//Services none auth grouped routes
Route::group(['prefix' => '/services', 'as' => 'services.'], function () {
Route::get('/', 'App\Http\Controllers\PagesController@services')->name('services.page');
Route::get('/service/{id}', 'App\Http\Controllers\PagesController@service')->name('service.page');
});
// Route::get('login', 'App\Http\Controllers\PagesController@login');
// Route::get('register', 'App\Http\Controllers\PagesController@register');

// Route::get('user_activation/{id}', 'App\Http\Controllers\UsersController@activate');
//shop none auth grouped routes
Route::group(['prefix' => '/shop', 'as' => 'shop.'], function () {
Route::get('/', 'App\Http\Controllers\PagesController@shop')->name('shop.page');
Route::get('/{category}/{id}', 'App\Http\Controllers\PagesController@shop_item')->name('shop_category.page');
Route::get('/cart', 'App\Http\Controllers\PagesController@shop_cart')->name('shop_cart.page');
Route::get('/cart_checkout', 'App\Http\Controllers\PagesController@cart_checkout')->name('cart_checkout.page');
});
//Pages none auth grouped routes
Route::group(['prefix' => '/pages', 'as' => 'pages.'], function () {
// Route::get('/blogs', 'App\Http\Controllers\PagesController@blog');
// Route::get('/blogs/{id}', 'App\Http\Controllers\PagesController@blog_detail');
// Route::get('/blogs/category/{category}', 'App\Http\Controllers\PagesController@blog_category');
Route::get('/contact', 'App\Http\Controllers\PagesController@contact')->name('contact.page');
Route::get('/about_us', 'App\Http\Controllers\PagesController@about_us')->name('about_us.page');
});
//Shop landing pages view routes

Route::group(['prefix' => '/countries', 'as' => 'countries.'], function () {
Route::get('/', 'App\Http\Controllers\AjaxRequestController@fetch_countries')->name('fetch_countries.api');
Route::get('/populate_states_by_country/{country_id}', 'App\Http\Controllers\AjaxRequestController@populate_states_by_country')->name('populate_states_by_country.api');
Route::get('/populate_cities_by_state/{state_id}', 'App\Http\Controllers\AjaxRequestController@populate_cities_by_state')->name('populate_cities_by_state.api');
});

Route::get('payment/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking_payment');
Route::get('payment/reservations/{id}', 'App\Http\Controllers\PagesController@reservation_payment');

//auth post routes
Route::group(['prefix' => '/auth', 'as' => 'auth.'], function () {

    Route::post('/user/login', 'App\Http\Controllers\API\RegisterController@login');
    Route::post('/user/forgot_password', 'App\Http\Controllers\API\RegisterController@forgot_password');
    Route::post('/user/verify_email_code', 'App\Http\Controllers\API\RegisterController@verify_email_code');
    
    });




//customer middleware protected group routes
Route::group(['middleware' => 'customer'], function () {

Route::group(['prefix' => '/auth/customer', 'as' => 'customer.'], function () {
Route::get('/dashboard', 'App\Http\Controllers\CustomerController@index')->name('customer_dashboard.auth');
Route::get('users/profile/{id}', 'App\Http\Controllers\PagesController@user_profile')->name('customer_profile.page');;
Route::get('admin/reservations', 'App\Http\Controllers\PagesController@reservations');
Route::get('admin/service_bookings', 'App\Http\Controllers\PagesController@service_bookings');
Route::get('admin/reservation/{id}', 'App\Http\Controllers\PagesController@reservation');
Route::get('admin/print_reservation/{id}', 'App\Http\Controllers\PagesController@print_reservation');
Route::get('admin/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking');
Route::get('admin/print_booking/{id}', 'App\Http\Controllers\PagesController@print_booking');

});

});




//admin middleware protected groupped routes
Route::group(['middleware' => 'admin'], function () {

    Route::group(['prefix' => '/auth/admin', 'as' => 'admin.'], function () {
     Route::get('/dashboard', 'App\Http\Controllers\AdminController@index');
    
    Route::get('/profile/{id}', 'App\Http\Controllers\PagesController@user_profile');
    Route::get('admin/reservations', 'App\Http\Controllers\PagesController@reservations');
    Route::get('admin/service_bookings', 'App\Http\Controllers\PagesController@service_bookings');
    Route::get('admin/reservation/{id}', 'App\Http\Controllers\PagesController@reservation');
    Route::get('admin/print_reservation/{id}', 'App\Http\Controllers\PagesController@print_reservation');
    Route::get('admin/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking');
    Route::get('admin/print_booking/{id}', 'App\Http\Controllers\PagesController@print_booking');
    Route::get('admin/members', 'App\Http\Controllers\PagesController@members');
    Route::get('admin/site_visitors', 'App\Http\Controllers\PagesController@visitors');
    Route::get('admin/site_activities', 'App\Http\Controllers\PagesController@site_activities');
    
//content management grouped routes
Route::group(['prefix' => '/content_managment', 'as' => 'content_managment.'], function () {

//view routes
Route::get('/news_letter', 'App\Http\Controllers\AdminController@news_letter');
Route::get('/index_slider', 'App\Http\Controllers\AdminController@index_slider');
Route::get('/edit_contents', 'App\Http\Controllers\AdminController@edit_contents');
Route::get('/settings', 'App\Http\Controllers\AdminController@settings');
Route::get('/mail_template', 'App\Http\Controllers\AdminController@mail_template');
Route::get('/mail_template/{id}', 'App\Http\Controllers\AdminController@edit_mail_template');

//post routes
Route::post('admin/room_image_upload', 'App\Http\Controllers\AjaxRequestController@room_image_upload');
Route::post('admin/post_service', 'App\Http\Controllers\AjaxRequestController@post_service');
Route::post('admin/load_content', 'App\Http\Controllers\AjaxRequestController@load_content');
Route::post('admin/update_content', 'App\Http\Controllers\AjaxRequestController@update_content');
Route::post('admin/create_content_name', 'App\Http\Controllers\AjaxRequestController@create_content_name');
Route::post('admin/create_user', 'App\Http\Controllers\AjaxRequestController@create_user');
Route::post('/update_settings', 'App\Http\Controllers\AdminController@update_settings');
Route::post('/upload_site_logo', 'App\Http\Controllers\AdminController@upload_site_logo');

Route::post('/load_slider_category', 'App\Http\Controllers\AdminController@load_slider_category');
Route::post('/add_to_slide', 'App\Http\Controllers\AdminController@add_to_slide');
Route::post('/update_index_slide', 'App\Http\Controllers\AdminController@update_index_slide');
Route::delete('/delete_service_slide/{id}', 'App\Http\Controllers\AdminController@delete_service_slide');

Route::post('admin/delete_user', 'App\Http\Controllers\AjaxRequestController@delete_user');
//Route::post('admin/delete_service', 'App\Http\Controllers\AjaxRequestController@delete_service');
//delete routes

    
});

//admin business main grouped routes
Route::group(['prefix' => '/business', 'as' => 'business.'], function () {
    //resort grouped routes
    Route::group(['prefix' => '/resorts', 'as' => 'resorts.'], function () {
    Route::get('/', 'App\Http\Controllers\AdminResortController@index');
    Route::post('/create_resort_feature', 'App\Http\Controllers\AdminResortController@create_resort_feature');
    Route::delete('/remove_resort_feature/{id}', 'App\Http\Controllers\AdminResortController@remove_resort_feature');
    
    });
    //boats grouped routes
    Route::group(['prefix' => '/boats', 'as' => 'boats.'], function () {
        Route::get('/', 'App\Http\Controllers\AdminBoatController@index');
       Route::post('/create_boat_category', 'App\Http\Controllers\AdminBoatController@create_categories');
       Route::delete('/remove_boat_category/{id}', 'App\Http\Controllers\AdminBoatController@remove_boat_category');
       
       });
    //service grouped routes
    Route::group(['prefix' => '/services', 'as' => 'services.'], function () {

       });

    });
    
    });
    
    });



//business middleware protected group routes
Route::group(['middleware' => 'business'], function () {

Route::group(['prefix' => '/auth/business', 'as' => 'business.'], function () {
Route::get('/business_verification_form', 'App\Http\Controllers\BusinessController@business_verification_form')->name('business_verification.auth');
Route::get('/dashboard', 'App\Http\Controllers\BusinessController@index');



Route::post('/upload_business_verification', 'App\Http\Controllers\BusinessController@upload_business_verification');

Route::get('users/profile/{id}', 'App\Http\Controllers\PagesController@user_profile');
Route::get('admin/reservations', 'App\Http\Controllers\PagesController@reservations');
Route::get('admin/service_bookings', 'App\Http\Controllers\PagesController@service_bookings');
Route::get('admin/reservation/{id}', 'App\Http\Controllers\PagesController@reservation');
Route::get('admin/print_reservation/{id}', 'App\Http\Controllers\PagesController@print_reservation');
Route::get('admin/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking');
Route::get('admin/print_booking/{id}', 'App\Http\Controllers\PagesController@print_booking');


//boat_manager view controller routes
Route::group(['prefix' => '/boats', 'as' => 'boats.'], function () {
Route::get('/', 'App\Http\Controllers\BoatController@index');
Route::get('/edit_boat/{id}', 'App\Http\Controllers\BoatController@edit_boat_services');
Route::get('/edit_boat_img/{id}', 'App\Http\Controllers\BoatController@edit_boat_img');
Route::get('/booking_calendar/{id}', 'App\Http\Controllers\BoatController@boat_bookings');
Route::get('/booking_list/{id}', 'App\Http\Controllers\BoatController@boat_bookings');
Route::get('/print_booking/{id}', 'App\Http\Controllers\BoatController@boat_bookings');

Route::post('/create_new_boat', 'App\Http\Controllers\BoatController@create_new_boat');
Route::delete('/delete_boat', 'App\Http\Controllers\BoatController@delete_boat');
Route::put('/update_boat\{id}', 'App\Http\Controllers\BoatController@update_boat');
Route::post('/update_boat_img', 'App\Http\Controllers\BoatController@update_boat_img');
Route::post('/remove_boat_img', 'App\Http\Controllers\BoatController@remove_boat_img');

});

//resort_manager view controller routes
Route::group(['prefix' => '/resorts', 'as' => 'resorts.'], function () {
Route::get('/', 'App\Http\Controllers\ResortController@index');
Route::get('/fetch_country_currency_list', 'App\Http\Controllers\ResortController@fetch_country_currency_list');
Route::get('/edit_resort/{resort_id}', 'App\Http\Controllers\ResortController@edit_resort_form');
Route::get('/edit_resort_img/{resort_id}', 'App\Http\Controllers\ResortController@edit_resort_img');
Route::get('/edit_resort_features/{resort_id}', 'App\Http\Controllers\ResortController@edit_resort_features');
Route::get('/book_resort/{resort_id}', 'App\Http\Controllers\ResortController@resort_owner_resort_booking_page');
Route::get('/create_room/{reosrt_id}', 'App\Http\Controllers\ResortController@create_room_form');
Route::get('/edit_room/{resort_id}/{room_id}', 'App\Http\Controllers\ResortController@update_room_page');
Route::get('/edit_room_img/{resort_id}/{room_id}', 'App\Http\Controllers\ResortController@edit_room_img');
Route::get('/room_booking_calendar/{resort_id}/{room_id}', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');
Route::get('/room_booking_list/{resort_id}/{room_id}', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');
Route::get('/room_booking_reciept/{resort_id}/{room_id}/{room_num_id}', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');
Route::get('/facility_booking_calendar/{resort_id}/', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');
Route::get('/facility_booking_list/{resort_id}/', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');
Route::get('/facility_booking_reciept/{resort_id}/{facility_id}', 'App\Http\Controllers\ResortController@resort_owner_room_booking_page');



Route::post('/create_new_resort', 'App\Http\Controllers\ResortController@create_new_resort');
Route::post('/update_resort_img', 'App\Http\Controllers\ResortController@update_resort_img');
Route::post('/remove_resort_img', 'App\Http\Controllers\ResortController@remove_resort_img');
Route::post('/update_resort_features', 'App\Http\Controllers\ResortController@update_resort_features');
Route::post('/remove_resort_user_feature', 'App\Http\Controllers\ResortController@remove_resort_user_feature');
// Route::post('/resort_upload', 'App\Http\Controllers\AjaxRequestController@resort_image_upload');
Route::post('/update_resort_input', 'App\Http\Controllers\ResortController@update_resort_input');
Route::post('/upload_rooms_info', 'App\Http\Controllers\ResortController@upload_rooms_info');
Route::post('/update_rooms_info', 'App\Http\Controllers\ResortController@update_rooms_info');
Route::post('/update_resort_room_img', 'App\Http\Controllers\ResortController@update_resort_room_img');
Route::post('/remove_resort_room_img', 'App\Http\Controllers\ResortController@remove_resort_room_img');
Route::delete('/delete_resort/{id}', 'App\Http\Controllers\ResortController@delete_resort');
Route::delete('/delete_room/{reosrt_id}/{room_id}', 'App\Http\Controllers\ResortController@delete_room');
Route::post('/sub_room', 'App\Http\Controllers\ResortController@sub_room');
Route::post('/sub_room_create', 'App\Http\Controllers\ResortController@sub_room_create');
Route::post('/sub_room_update', 'App\Http\Controllers\ResortController@sub_room_update');
Route::delete('/sub_room_delete/{room_id}/{id}', 'App\Http\Controllers\ResortController@sub_room_delete');

});


//service_manager view controller routes
Route::group(['prefix' => '/services', 'as' => 'services.'], function () {
Route::get('admin/service_manager/create_service', 'App\Http\Controllers\PagesController@create_services');
Route::get('admin/service_manager/edit_service/{id}', 'App\Http\Controllers\PagesController@edit_service');
Route::get('admin/service_manager/edit_service_img/{id}', 'App\Http\Controllers\PagesController@edit_service_img');
Route::get('admin/service_manager/bookings/{id}', 'App\Http\Controllers\PagesController@service_admin_booking_entry');

});

//shop_manager view controller routes
Route::get('admin/shop_manager/create_shop_item', 'App\Http\Controllers\PagesController@admin_store');
Route::get('admin/shop_manager/edit_shop/{id}', 'App\Http\Controllers\PagesController@edit_shop');
Route::get('admin/shop_manager/edit_shop_img/{id}', 'App\Http\Controllers\PagesController@edit_shop_img');
Route::get('admin/shop_manager/edit_discount_settings/{id}', 'App\Http\Controllers\PagesController@edit_discount_settings');
Route::get('admin/shop_manager/edit_delivery_settings/{id}', 'App\Http\Controllers\PagesController@edit_delivery_settings');
Route::get('admin/shop_manager/product_order/{id}', 'App\Http\Controllers\PagesController@product_order');
Route::get('admin/shop_manager/my_order_list', 'App\Http\Controllers\PagesController@my_order_list');
Route::get('admin/shop_manager/admin_order_list', 'App\Http\Controllers\PagesController@admin_order_list');

});

});








Route::get('admin/events', 'App\Http\Controllers\PagesController@events');
Route::get('admin/users', 'App\Http\Controllers\PagesController@users');






Route::get('members/debts', 'App\Http\Controllers\PagesController@member_debts');
Route::get('admin/create_debts', 'App\Http\Controllers\PagesController@create_debts');
Route::get('admin/gallery', 'App\Http\Controllers\PagesController@admin_gallery');
Route::get('admin/member_subscription', 'App\Http\Controllers\PagesController@member_subscription');
Route::get('admin/transactions', 'App\Http\Controllers\PagesController@transactions');
Route::get('admin/transaction/{id}', 'App\Http\Controllers\PagesController@transaction');
Route::get('admin/print_transaction/{id}', 'App\Http\Controllers\PagesController@print_transaction');

//messages PagesController view routes 
Route::get('admin/messages', 'App\Http\Controllers\PagesController@messages');
Route::get('admin/messages/new_message', 'App\Http\Controllers\PagesController@new_message');
Route::get('admin/messages/sent_messages', 'App\Http\Controllers\PagesController@sent_messages');
Route::get('admin/messages/read/{id}', 'App\Http\Controllers\PagesController@read_message');
Route::get('admin/messages/reply/{id}', 'App\Http\Controllers\PagesController@reply_message');
Route::get('admin/messages/sent/{id}', 'App\Http\Controllers\PagesController@sent_message');
Route::get('admin/messages/support', 'App\Http\Controllers\PagesController@support');
Route::get('admin/messages/support/{id}', 'App\Http\Controllers\PagesController@reply_support');
Route::get('admin/messages/support/read/{id}', 'App\Http\Controllers\PagesController@read_support_message');
Route::get('admin/messages/support/reply/{id}', 'App\Http\Controllers\PagesController@reply_support_message');



Route::get('admin/notifications', 'App\Http\Controllers\PagesController@notification_all');
Route::get('admin/notifications/{id}', 'App\Http\Controllers\PagesController@notification');

Route::get('admin/shop_orders', 'App\Http\Controllers\PagesController@shop_orders');
Route::get('admin/order/{id}', 'App\Http\Controllers\PagesController@order_page');



Route::get('admin/book_service/{id}', 'App\Http\Controllers\PagesController@book_service');







Route::post('admin/make_blog_post', 'App\Http\Controllers\AjaxRequestController@make_blog_post');

//Resort Ajax requests controller routes



//Boat ajax request controller routes
Route::post('admin/create_categories', 'App\Http\Controllers\BoatController@create_categories');


//Service ajax request controller routes
Route::post('admin/create_service_categories', 'App\Http\Controllers\ServiceController@create_categories');
Route::post('admin/create_new_service', 'App\Http\Controllers\ServiceController@create_new_service');
Route::post('admin/delete_service', 'App\Http\Controllers\ServiceController@delete_service');
Route::post('admin/update_service', 'App\Http\Controllers\ServiceController@update_service');
Route::post('admin/update_service_img', 'App\Http\Controllers\ServiceController@update_service_img');
Route::post('admin/remove_service_img', 'App\Http\Controllers\ServiceController@remove_service_img');

//Shop ajax request controller routes
Route::post('admin/create_new_product', 'App\Http\Controllers\ShopController@create_new_product');
Route::post('admin/create_shop_categories', 'App\Http\Controllers\ShopController@create_categories');
Route::post('admin/delete_product', 'App\Http\Controllers\ShopController@delete_product');
Route::post('admin/update_product', 'App\Http\Controllers\ShopController@update_product');
Route::post('admin/update_product_img', 'App\Http\Controllers\ShopController@update_product_img');
Route::post('admin/remove_product_img', 'App\Http\Controllers\ShopController@remove_product_img');
Route::post('admin/update_product_discount', 'App\Http\Controllers\ShopController@update_product_discount');
Route::post('admin/update_product_delivery', 'App\Http\Controllers\ShopController@update_product_delivery');
Route::post('admin/confirm_order', 'App\Http\Controllers\ShopController@confirm_order');






Route::post('admin/load_blog_page', 'App\Http\Controllers\AjaxRequestController@load_blog_page');
Route::post('admin/load_home_blog', 'App\Http\Controllers\AjaxRequestController@load_home_blog');
Route::post('admin/load_profile_blog', 'App\Http\Controllers\AjaxRequestController@load_profile_blog');


Route::post('admin/post_member_credit', 'App\Http\Controllers\AjaxRequestController@post_member_credit');
Route::post('admin/update_debt', 'App\Http\Controllers\AjaxRequestController@update_debt');
Route::post('admin/load_debt_note', 'App\Http\Controllers\AjaxRequestController@load_debt_note');
Route::post('admin/update_reservation_resources', 'App\Http\Controllers\AjaxRequestController@update_reservation_resources');
Route::post('admin/update_reservation_availability', 'App\Http\Controllers\AjaxRequestController@update_reservation_availability');
Route::post('admin/update_booking_approval', 'App\Http\Controllers\AjaxRequestController@update_booking_approval');
Route::post('admin/update_booking_availability', 'App\Http\Controllers\AjaxRequestController@update_booking_availability');

Route::post('admin/upload_profile_image', 'App\Http\Controllers\AjaxRequestController@upload_profile_image');
Route::post('admin/profile_update_upload', 'App\Http\Controllers\AjaxRequestController@profile_update_upload');
Route::post('admin/profile_change_password', 'App\Http\Controllers\AjaxRequestController@profile_change_password');
Route::post('admin/message_user_type', 'App\Http\Controllers\AjaxRequestController@message_user_type');
Route::post('admin/post_msg', 'App\Http\Controllers\AjaxRequestController@post_msg');
Route::post('admin/post_contact_message', 'App\Http\Controllers\AjaxRequestController@post_contact_message');
Route::post('admin/send_news_letter', 'App\Http\Controllers\AjaxRequestController@send_news_letter');
Route::post('admin/reply_contact_msg', 'App\Http\Controllers\AjaxRequestController@reply_contact_msg');


Route::post('resort/post_check_availability', 'App\Http\Controllers\AjaxRequestController@post_check_availability');
Route::post('resort/load_rooms', 'App\Http\Controllers\AjaxRequestController@load_resort_rooms');
Route::post('resort/load_index_blog', 'App\Http\Controllers\AjaxRequestController@load_index_blog');
Route::post('resort/post_review', 'App\Http\Controllers\AjaxRequestController@post_review');
Route::post('resort/load_resort_location_search', 'App\Http\Controllers\AjaxRequestController@load_resort_location_search');

Route::post('boats/load_boat_data', 'App\Http\Controllers\AjaxRequestController@load_boat_data');
Route::post('boats/load_boat_category', 'App\Http\Controllers\AjaxRequestController@load_boat_category');

Route::post('services/load_service_data', 'App\Http\Controllers\AjaxRequestController@load_service_data');
Route::post('services/load_service_category', 'App\Http\Controllers\AjaxRequestController@load_service_category');

Route::post('payment/process_card_payment', 'App\Http\Controllers\AjaxRequestController@process_card_payment');
Route::post('payment/create_transaction_record', 'App\Http\Controllers\AjaxRequestController@create_transaction_record');
Route::post('payment/create_subscription_transaction_record', 'App\Http\Controllers\AjaxRequestController@create_subscription_transaction_record');
Route::post('news/news_letter_sub', 'App\Http\Controllers\AjaxRequestController@news_letter_sub');
Route::post('admin/post_blog_comment', 'App\Http\Controllers\AjaxRequestController@post_blog_comment');
Route::post('admin/load_notification_counter', 'App\Http\Controllers\NotificationController@notification_counter');
Route::post('admin/load_notification_bar', 'App\Http\Controllers\NotificationController@notification_bar');
Route::post('admin/msg_note', 'App\Http\Controllers\NotificationController@msg_note');
Route::post('admin/support_note', 'App\Http\Controllers\NotificationController@support_note');
Route::post('admin/news_letter_note', 'App\Http\Controllers\NotificationController@news_letter_note');


Route::post('reservation/load_admin_room_reservation', 'App\Http\Controllers\ReservationController@load_admin_room_reservation');
Route::post('reservation/admin_room_reservation_create', 'App\Http\Controllers\ReservationController@admin_room_reservation_create');
Route::post('reservation/admin_room_reservation_update', 'App\Http\Controllers\ReservationController@admin_room_reservation_update');
Route::post('reservation/admin_room_reservation_delete', 'App\Http\Controllers\ReservationController@admin_room_reservation_delete');
Route::post('reservation/admin_room_reservation_resize', 'App\Http\Controllers\ReservationController@admin_room_reservation_resize');
Route::post('reservation/admin_room_reservation_move', 'App\Http\Controllers\ReservationController@admin_room_reservation_move');
Route::post('admin/post_reservation', 'App\Http\Controllers\ReservationController@post_reservation');
//Route::post('admin/make_reservation_payment', 'App\Http\Controllers\AjaxRequestController@make_reservation_payment');
Route::post('admin/post_service_booking', 'App\Http\Controllers\ReservationController@post_service_booking');




Route::post('shop/load_shop_data', 'App\Http\Controllers\AjaxRequestController@load_shop_data');
Route::post('shop/load_shop_category', 'App\Http\Controllers\AjaxRequestController@load_shop_category');
Route::post('shop/post_shop_order', 'App\Http\Controllers\AjaxRequestController@post_shop_order');
Route::post('shop/add_to_cart', 'App\Http\Controllers\AjaxRequestController@add_to_cart');
Route::post('shop/count_cart_item', 'App\Http\Controllers\AjaxRequestController@count_cart_item');



Route::get('crone_job/membership_sub_ckeck', 'App\Http\Controllers\coneJobController@membership_sub_ckeck');
Route::get('crone_job/resort_reservation_check', 'App\Http\Controllers\coneJobController@resort_reservation_check');
Route::get('crone_job/room_reservation_check', 'App\Http\Controllers\coneJobController@room_reservation_check');
Route::get('crone_job/members_birthday_check', 'App\Http\Controllers\coneJobController@members_birthday_check');
Route::get('crone_job/drop_database', 'App\Http\Controllers\coneJobController@drop_database');





Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::resource('product', 'App\Http\Controllers\ProductController');

//Route::resource('post_blog', 'App\Http\Controllers\PagesController@postBlog');

