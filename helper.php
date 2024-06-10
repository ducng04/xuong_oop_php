<?php

const PATH_ROOT = __DIR__ . '/';

if (!function_exists('asset')) {
    function asset($path)
    {
        return $_ENV['BASE_URL'] . $path;
    }
}


if (!function_exists('url')) {
    function url($uri = null)
    {
        return $_ENV['BASE_URL'] . $uri;
    }
}

if (!function_exists('auth_check')) {
    function auth_check()
    {
        if (isset($_SESSION['user'])) {
            header('Location: ' . url('admin/'));
            exit;
        }

        // // Nếu người dùng là admin, chuyển hướng đến trang admin
        // if ($_SESSION['user']['type'] == 'admin') {
        //     return; // Admin có thể truy cập trang admin
        // }

        // // Nếu là trang admin, kiểm tra quyền của người dùng
        // if (strpos($_SERVER['REQUEST_URI'], '/admin') !== false && $_SESSION['user']['type'] != 'admin') {
        //     header('Location: ' . url());
        //     exit;
        // }
    }
}
