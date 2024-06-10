<?php


// CRUD bao gồm : Danh sách , thêm sửa , xem . xóa 
// User :
//         GET      -> USER/INDEX       -> INDEX         -> DANH SÁCH
//         GET      -> USER/CREATE      -> CREATE        -> Hiển Thị Form thêm mới
//         POST     -> USER/STORE       ->STORE          -> Lưu DỮ LIỆU TỪ FORM THÊM MỚI VÀO DB
//         GET      -> USER/ID /SHOW    -> SHOW($id)     -> XEM CHI TIẾT
//         GET      -> USER/ID/EDIT     ->EDIT($id)      -> HIỂN THỊ FORM CẬP NHẬT 
//         PUT      -> USER/ID/UPDATE   ->UPDATE($id)     -> LƯU DỮ LIỆU TỪ FORM CẬP NHẬT VÀO DATABASE 
//         GET    -> USER/ID/DELETE     ->DELETE($id)    -> XÓA BẢN GHI TRONG DB



use Ngogi\Xuongphp\Controllers\Admin\CategoryController;
use Ngogi\Xuongphp\Controllers\Admin\DashboardController;
use Ngogi\Xuongphp\Controllers\Admin\UserController;

$router->before('GET|POST', '/admin/*.*', function() {
    if (!isset($_SESSION['user'])) {
        header('location: '.url('login'));
        exit();
    }
});



$router->mount('/admin', function () use ($router) {

    $router->get('/', DashboardController::class . '@dashboard');

    //CRUD USER 
    $router->mount('/users', function () use ($router) {
        $router->get('/',               UserController::class . '@index');
        $router->get('/create',         UserController::class . '@create');
        $router->post('/store',         UserController::class . '@store');
        $router->get('/{$id}/show',     UserController::class . '@show');
        $router->get('/{$id}/edit',     UserController::class . '@edit');
        $router->post('/{$id}/update',  UserController::class . '@update');
        $router->get('/{$id}/delete',   UserController::class . '@delete');
    });
});

$router->mount('/admin', function () use ($router) {

    $router->get('/', DashboardController::class . '@dashboard');

    //CRUD USER 
    $router->mount('/categories', function () use ($router) {
        $router->get('/',               CategoryController::class . '@index');
        $router->get('/create',         CategoryController::class . '@create');
        $router->post('/store',         CategoryController::class . '@store');
        $router->get('/{$id}/show',     CategoryController::class . '@show');
        $router->get('/{$id}/edit',     CategoryController::class . '@edit');
        $router->post('/{$id}/update',          CategoryController::class . '@update');
        $router->get('/{$id}/delete',   CategoryController::class . '@delete');
    });
});
