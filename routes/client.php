<?php


// Website có các trang :
// trang chủ
//Giới thiueej
//sản phẩm
//chi tiết sản phẩm
//Liên hệ

//Dể định nghĩa được , đầu tiên tọa controller
// Khai function tương ứng để xử lí
// Nước cuối , định nghĩa từng đường dẫn


//HTTP Method : get , post , put , path , delete , option , head 

use Ngogi\Xuongphp\Controllers\Client\AboutController;
use Ngogi\Xuongphp\Controllers\Client\CartController;
use Ngogi\Xuongphp\Controllers\Client\ContactController;
use Ngogi\Xuongphp\Controllers\Client\HomeController;
use Ngogi\Xuongphp\Controllers\Client\LoginController;
use Ngogi\Xuongphp\Controllers\Client\OrderController;
use Ngogi\Xuongphp\Controllers\Client\ProductController;



$router->get('/',               HomeController::class      . '@index');
$router->get('/about',          AboutController::class      . '@index');

$router->get('/contact',        ContactController::class . '@index');
$router->get('/contact/store',  ContactController::class . '@store'); 
   
$router->get('products',       ProductController::class . '@index');
$router->get('products/{id}',  ProductController::class . '@detail');



$router->get('/login',          LoginController::class . '@showFormLogin');
$router->post('/handle-login',  LoginController::class . '@login'); 
$router->get('/logout',         LoginController::class . '@logout'); 


$router->get('cart/add',                CartController::class . '@add');
$router->get('cart/quantityInc',        CartController::class . '@quantityInc');
$router->get('cart/quantityDec',        CartController::class . '@quantityDec');
$router->get('cart/remove',             CartController::class . '@remove');
$router->get('cart/detail',             CartController::class . '@detail');

$router->post('order/checkout',             OrderController::class . '@checkout');
