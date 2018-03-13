<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['default_controller'] = 'welcome/index';
$route['page/secure-shell-servers/continent/(:any)'] = 'welcome/location/$1';
$route['page/secure-shell-servers/continent/(:any)/(:any)'] = 'welcome/server/$2';
$route['page/ssh-account-creator/server/(:num)/(:any)'] = 'welcome/create/$1';
$route['page/privacy-policy'] = 'welcome/privacy';
$route['page/terms-of-service'] = 'welcome/tos';
$route['page/(:num)'] = 'welcome/index/$1';

//Auth route

$route['login.html'] = 'auth/login';
$route['logout.html'] = 'auth/logout';
$route['register.html'] = 'auth/register';
$route['forgot.html'] = 'auth/forgot';

//admin
$route['admin'] = 'admin/dashboard/index';
//servers

$route['admin/servers.html'] = 'admin/servers/index';

//server route
$route['admin/server/add.html'] = 'admin/servers/add';
$route['admin/server/(:num)/update.html'] = 'admin/servers/update/$1';
$route['admin/server/(:num)/delete.html'] = 'admin/servers/delete/$1';


//continent route
$route['admin/server/continent/add.html'] = 'admin/servers/add_continent';
$route['admin/server/continent/(:num)/update.html'] = 'admin/servers/update_continent/$1';
$route['admin/server/continent/(:num)/delete.html'] = 'admin/servers/delete_continent/$1';

//location route
$route['admin/server/location/add.html'] = 'admin/servers/add_location';
$route['admin/server/location/(:num)/update.html'] = 'admin/servers/update_location/$1';
$route['admin/server/location/(:num)/delete.html'] = 'admin/servers/delete_location/$1';

//product
$route['admin/products.html'] = 'admin/products';
$route['admin/product/voucher/add.html'] = 'admin/products/voucher_add';
$route['admin/product/voucher/(:num)/update.html'] = 'admin/products/voucher_update/$1';
$route['admin/product/voucher/(:num)/lock.html'] = 'admin/products/voucher_lock/$1';
$route['admin/product/voucher/(:num)/unlock.html'] = 'admin/products/voucher_unlock/$1';
//settings
$route['admin/settings.html'] = 'admin/settings';
$route['admin/setting/bank/(:num)/bank.html'] = 'admin/settings/bank/$1';
$route['admin/setting/bank/bank_add.html'] = 'admin/settings/bank_add';
$route['admin/setting/bank/(:num)/delete.html'] = 'admin/settings/bank_delete/$1';
$route['admin/setting/fullname.html'] = 'admin/settings/fullname';
$route['admin/setting/username.html'] = 'admin/settings/username';
$route['admin/setting/password.html'] = 'admin/settings/password';
$route['admin/setting/email.html'] = 'admin/settings/email';
$route['admin/setting/phone/(:num)/update.html'] = 'admin/settings/phone_update/$1';
$route['admin/setting/phone/(:num)/delete.html'] = 'admin/settings/phone_delete/$1';
$route['admin/setting/phone/phone_add.html'] = 'admin/settings/phone_add';
$route['admin/setting/foto.html'] = 'admin/settings/foto';
$route['admin/invoice.html'] = 'admin/invoice';
$route['admin/invoice/read/(:num)/baca.html'] = 'admin/invoice/read/$1';
$route['admin/users/users.html'] = 'admin/users';
$route['admin/users/profile/(:num)/profile.html']='admin/profile/index/$1';

$route['admin/webssh.html'] = 'admin/webssh/index';
//dashboard
$route['panel'] = 'member/dashboard';
$route['panel/(:any)/dashboard.html'] = 'member/dashboard/index';

//servr
$route['panel/(:any)/servers.html'] = 'member/servers/index';
$route['panel/(:any)/server/(:num)/createuser.html'] = 'member/servers/create/$2';
$route['panel/(:any)/history.html'] = 'member/history/index';


//setting
$route['panel/(:any)/settings.html'] = 'member/settings/index';
$route['panel/(:any)/setting/fullname.html'] = 'member/settings/fullname';
$route['panel/(:any)/setting/username.html'] = 'member/settings/username';
$route['panel/(:any)/setting/password.html'] = 'member/settings/password';
$route['panel/(:any)/setting/email.html'] = 'member/settings/email';
$route['panel/(:any)/setting/phone.html'] = 'member/settings/phone';
$route['panel/(:any)/setting/foto.html'] = 'member/settings/foto';
//

//voucher
$route['panel/(:any)/voucher.html'] = 'member/voucher/index';
$route['panel/(:any)/voucher/(:num)/beli.html'] = 'member/voucher/index/$2';
$route['panel/(:any)/voucher/(:num)/bayar.html'] = 'member/voucher/bayar/$2';
$route['panel/(:any)/voucher/(:num)/hapus.html'] = 'member/keranjang/del/$2';


//keranjang
$route['panel/(:any)/keranjang.html'] = 'member/keranjang/index';
$route['panel/(:any)/keranjang/(:num)/read.html'] = 'member/keranjang/read/$2';





