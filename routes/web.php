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

Route::get('/', 'App\Http\Controllers\PagesController@index');

//Services landing pages view routes
Route::get('services', 'App\Http\Controllers\PagesController@services');
Route::get('services/service/{id}', 'App\Http\Controllers\PagesController@service');

Route::get('login', 'App\Http\Controllers\PagesController@login');
Route::get('register', 'App\Http\Controllers\PagesController@register');

Route::get('user_activation/{id}', 'App\Http\Controllers\UsersController@activate');


Route::get('register/signup_members', 'App\Http\Controllers\PagesController@signup_members');
//Resort landing pages view routes
Route::get('resorts', 'App\Http\Controllers\PagesController@resorts');
Route::get('resorts/resort/{id}', 'App\Http\Controllers\PagesController@resort');
Route::get('resorts/resort/{resort_id}/{id}', 'App\Http\Controllers\PagesController@rooms');

//Pages group view routes
Route::get('pages/blogs', 'App\Http\Controllers\PagesController@blog');
Route::get('pages/blogs/{id}', 'App\Http\Controllers\PagesController@blog_detail');
Route::get('pages/blogs/category/{category}', 'App\Http\Controllers\PagesController@blog_category');
Route::get('pages/contact', 'App\Http\Controllers\PagesController@contact');
Route::get('pages/about_us', 'App\Http\Controllers\PagesController@about_us');
//Shop landing pages view routes
Route::get('shop', 'App\Http\Controllers\PagesController@shop');
Route::get('shop/{category}/{id}', 'App\Http\Controllers\PagesController@shop_item');
Route::get('shop/cart', 'App\Http\Controllers\PagesController@shop_cart');
Route::get('shop/cart_checkout', 'App\Http\Controllers\PagesController@cart_checkout');
//boats landing pages view routes
Route::get('boats', 'App\Http\Controllers\PagesController@boat_page');
Route::get('boats/boat/{id}', 'App\Http\Controllers\PagesController@boat_single');

Route::get('payment/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking_payment');
Route::get('payment/reservations/{id}', 'App\Http\Controllers\PagesController@reservation_payment');


//loggedin routs
Route::get('member_dashboard/{id}', 'App\Http\Controllers\PagesController@member');
Route::get('admin_dashboard/{id}', 'App\Http\Controllers\PagesController@dashboard');

Route::get('admin/events', 'App\Http\Controllers\PagesController@events');
Route::get('admin/users', 'App\Http\Controllers\PagesController@users');

Route::get('users/profile/{id}', 'App\Http\Controllers\PagesController@user_profile');
Route::get('admin/reservations', 'App\Http\Controllers\PagesController@reservations');
Route::get('admin/service_bookings', 'App\Http\Controllers\PagesController@service_bookings');
Route::get('admin/reservation/{id}', 'App\Http\Controllers\PagesController@reservation');
Route::get('admin/print_reservation/{id}', 'App\Http\Controllers\PagesController@print_reservation');
Route::get('admin/service_booking/{id}', 'App\Http\Controllers\PagesController@service_booking');
Route::get('admin/print_booking/{id}', 'App\Http\Controllers\PagesController@print_booking');
Route::get('admin/members', 'App\Http\Controllers\PagesController@members');
Route::get('admin/site_visitors', 'App\Http\Controllers\PagesController@visitors');
Route::get('admin/site_activities', 'App\Http\Controllers\PagesController@site_activities');

//boat_manager view controller routes for boat administrators
Route::get('admin/boat_manager/create_boat', 'App\Http\Controllers\PagesController@boat_services');
Route::get('admin/boat_manager/edit_boat/{id}', 'App\Http\Controllers\PagesController@edit_boat_services');
Route::get('admin/boat_manager/edit_boat_img/{id}', 'App\Http\Controllers\PagesController@edit_boat_img');
Route::get('admin/boat_manager/bookings/{id}', 'App\Http\Controllers\PagesController@boat_bookings');
//resort_manager view controller routes for resort administrators
Route::get('admin/resort_manager/create_resort', 'App\Http\Controllers\PagesController@create_resort');
Route::get('admin/resort_manager/resort/{id}', 'App\Http\Controllers\PagesController@update_resort');
Route::get('admin/resort_manager/edit_resort_img/{id}', 'App\Http\Controllers\PagesController@edit_resort_img');
Route::get('admin/resort_manager/edit_resort_features/{id}', 'App\Http\Controllers\PagesController@edit_resort_features');
Route::get('admin/resort_manager/create_room/{id}', 'App\Http\Controllers\PagesController@create_room');
Route::get('admin/resort_manager/room/{resort}/{id}', 'App\Http\Controllers\PagesController@update_room_page');
Route::get('admin/resort_manager/edit_room_img/{resort}/{id}', 'App\Http\Controllers\PagesController@edit_room_img');
Route::get('admin/resort_manager/book_resort/{id}', 'App\Http\Controllers\PagesController@resort_owner_resort_booking_page');
Route::get('admin/resort_manager/book_room/{resort}/{id}', 'App\Http\Controllers\PagesController@resort_owner_room_booking_page');
//service_manager view controller routes for service administrators
Route::get('admin/service_manager/create_service', 'App\Http\Controllers\PagesController@create_services');
Route::get('admin/service_manager/edit_service/{id}', 'App\Http\Controllers\PagesController@edit_service');
Route::get('admin/service_manager/edit_service_img/{id}', 'App\Http\Controllers\PagesController@edit_service_img');
Route::get('admin/service_manager/bookings/{id}', 'App\Http\Controllers\PagesController@service_admin_booking_entry');

//shop_manager view controller routes for shop owners
Route::get('admin/shop_manager/create_shop_item', 'App\Http\Controllers\PagesController@admin_store');
Route::get('admin/shop_manager/edit_shop/{id}', 'App\Http\Controllers\PagesController@edit_shop');
Route::get('admin/shop_manager/edit_shop_img/{id}', 'App\Http\Controllers\PagesController@edit_shop_img');
Route::get('admin/shop_manager/edit_discount_settings/{id}', 'App\Http\Controllers\PagesController@edit_discount_settings');
Route::get('admin/shop_manager/edit_delivery_settings/{id}', 'App\Http\Controllers\PagesController@edit_delivery_settings');
Route::get('admin/shop_manager/product_order/{id}', 'App\Http\Controllers\PagesController@product_order');
Route::get('admin/shop_manager/my_order_list', 'App\Http\Controllers\PagesController@my_order_list');
Route::get('admin/shop_manager/admin_order_list', 'App\Http\Controllers\PagesController@admin_order_list');



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

//content_manager view controller routes
Route::get('admin/content_manager/news_letter', 'App\Http\Controllers\PagesController@news_letter');
Route::get('admin/content_manager/index_slider', 'App\Http\Controllers\PagesController@index_slider');
Route::get('admin/content_manager/edit_contents', 'App\Http\Controllers\PagesController@edit_contents');
Route::get('admin/content_manager/settings', 'App\Http\Controllers\PagesController@settings');
Route::get('admin/content_manager/mail_template', 'App\Http\Controllers\PagesController@mail_template');
Route::get('admin/content_manager/mail_template/{id}', 'App\Http\Controllers\PagesController@edit_mail_template');


Route::get('admin/notifications', 'App\Http\Controllers\PagesController@notification_all');
Route::get('admin/notifications/{id}', 'App\Http\Controllers\PagesController@notification');

Route::get('admin/shop_orders', 'App\Http\Controllers\PagesController@shop_orders');
Route::get('admin/order/{id}', 'App\Http\Controllers\PagesController@order_page');



Route::get('admin/book_service/{id}', 'App\Http\Controllers\PagesController@book_service');





Route::post('admin/login', 'App\Http\Controllers\API\RegisterController@login');
Route::post('login/login_user', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('register/confirm_otp', 'App\Http\Controllers\API\RegisterController@confirm_otp');

Route::post('admin/make_blog_post', 'App\Http\Controllers\AjaxRequestController@make_blog_post');

//Resort Ajax requests controller routes
Route::post('admin/create_resort_feature', 'App\Http\Controllers\ResortController@create_resort_feature');
Route::post('admin/remove_resort_feature', 'App\Http\Controllers\ResortController@remove_resort_feature');
Route::post('admin/create_new_resort', 'App\Http\Controllers\ResortController@create_new_resort');
Route::post('admin/update_resort_img', 'App\Http\Controllers\ResortController@update_resort_img');
Route::post('admin/remove_resort_img', 'App\Http\Controllers\ResortController@remove_resort_img');
Route::post('admin/update_resort_features', 'App\Http\Controllers\ResortController@update_resort_features');
Route::post('admin/remove_resort_user_feature', 'App\Http\Controllers\ResortController@remove_resort_user_feature');
Route::post('admin/resort_upload', 'App\Http\Controllers\AjaxRequestController@resort_image_upload');
Route::post('admin/update_resort_input', 'App\Http\Controllers\ResortController@update_resort_input');
Route::post('admin/upload_rooms_info', 'App\Http\Controllers\ResortController@upload_rooms_info');
Route::post('admin/update_rooms_info', 'App\Http\Controllers\ResortController@update_rooms_info');
Route::post('admin/update_resort_room_img', 'App\Http\Controllers\ResortController@update_resort_room_img');
Route::post('admin/remove_resort_room_img', 'App\Http\Controllers\ResortController@remove_resort_room_img');
Route::post('admin/delete_resort', 'App\Http\Controllers\ResortController@delete_resort');
Route::post('admin/delete_room', 'App\Http\Controllers\ResortController@delete_room');
Route::post('admin/sub_room', 'App\Http\Controllers\ResortController@sub_room');
Route::post('admin/sub_room_create', 'App\Http\Controllers\ResortController@sub_room_create');
Route::post('admin/sub_room_update', 'App\Http\Controllers\ResortController@sub_room_update');
Route::post('admin/sub_room_delete', 'App\Http\Controllers\ResortController@sub_room_delete');


//Boat ajax request controller routes
Route::post('admin/create_categories', 'App\Http\Controllers\BoatController@create_categories');
Route::post('admin/create_new_boat', 'App\Http\Controllers\BoatController@create_new_boat');
Route::post('admin/delete_boat', 'App\Http\Controllers\BoatController@delete_boat');
Route::post('admin/update_boat', 'App\Http\Controllers\BoatController@update_boat');
Route::post('admin/update_boat_img', 'App\Http\Controllers\BoatController@update_boat_img');
Route::post('admin/remove_boat_img', 'App\Http\Controllers\BoatController@remove_boat_img');

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



Route::post('admin/room_image_upload', 'App\Http\Controllers\AjaxRequestController@room_image_upload');
Route::post('admin/post_service', 'App\Http\Controllers\AjaxRequestController@post_service');
Route::post('admin/load_content', 'App\Http\Controllers\AjaxRequestController@load_content');
Route::post('admin/update_content', 'App\Http\Controllers\AjaxRequestController@update_content');
Route::post('admin/create_content_name', 'App\Http\Controllers\AjaxRequestController@create_content_name');
Route::post('admin/create_user', 'App\Http\Controllers\AjaxRequestController@create_user');
Route::post('admin/update_settings', 'App\Http\Controllers\AjaxRequestController@update_settings');
Route::post('admin/delete_user', 'App\Http\Controllers\AjaxRequestController@delete_user');
//Route::post('admin/delete_service', 'App\Http\Controllers\AjaxRequestController@delete_service');
Route::post('admin/delete_service_slide', 'App\Http\Controllers\AjaxRequestController@delete_service_slide');


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
Route::post('admin/update_index_slide', 'App\Http\Controllers\AjaxRequestController@update_index_slide');
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
Route::post('resort/load_resort_data', 'App\Http\Controllers\AjaxRequestController@load_resort_data');
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
Route::post('admin/load_slider_category', 'App\Http\Controllers\AjaxRequestController@load_slider_category');
Route::post('admin/add_to_slide', 'App\Http\Controllers\AjaxRequestController@add_to_slide');

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

