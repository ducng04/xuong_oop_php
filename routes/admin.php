<?php


// CRUD bao gồm : Danh sách , thêm sửa , xem . xóa 
// User :
//         GET      -> USER/INDEX   -> INDEX         -> DANH SÁCH
//         GET      -> USER/CREATE  -> CREATE        -> Hiển Thị Form thêm mới
//         POST     -> USER/STORE   ->STORE          -> Lưu DỮ LIỆU TỪ FORM THÊM MỚI VÀO DB
//         GET      -> USER/ID      -> SHOW($id)     -> XEM CHI TIẾT
//         GET      -> USER/ID/EDIT ->EDIT($id)      -> HIỂN THỊ FORM CẬP NHẬT 
//         PUT      -> USER/ID0     ->UPDATE($id)     -> LƯU DỮ LIỆU TỪ FORM CẬP NHẬT VÀO DATABASE 
//         DELTE    -> USER/ID      ->DELETE($id)    -> XÓA BẢN GHI TRONG DB


use Ngogi\Xuongphp\Controllers\Admin\UserController;

$router->mount('/admin', function () use ($router) {

    //CRUD USER 
    $router->mount('/users', function () use ($router) {
        $router->get('/',           UserController::class . '@index');
        $router->get('/create',     UserController::class . '@create');
        $router->post('/store',     UserController::class . '@store');
        $router->get('/{$id}',      UserController::class . '@show');
        $router->get('/{$id}/edit', UserController::class . '@edit');
        $router->put('/{$id}',      UserController::class . '@update');
        $router->post('/{$id}/delete',   UserController::class . '@delete');
    });
});
