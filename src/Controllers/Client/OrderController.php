<?php

namespace Ngogi\Xuongphp\Controllers\Client;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Models\Cart;
use Ngogi\Xuongphp\Models\CartDetail;
use Ngogi\Xuongphp\Models\Order;
use Ngogi\Xuongphp\Models\OrderDetail;
use Ngogi\Xuongphp\Models\User;

class OrderController extends Controlller
{
    public User $user;
    public Order $order;

    public  OrderDetail $orderDetail;

    private Cart $cart;
    private CartDetail $carDetailt;
    public function __construct()
    {
        $this->user = new User();
        $this->order = new Order();
        $this->orderDetail = new OrderDetail();

        $this->cart = new Cart();
        $this->carDetailt = new CartDetail();
    }

    public function checkout()
    {
        //chưa đăng nhập thì tạo tài khoản
        $userID = $_SESSION['user']['id'] ?? null;
        if (!$userID) {
            $conn = $this->user->getConnection();
            $this->user->insert([
                'name' => $_SESSION['user_name'],
                'email' => $_SESSION['user_member'],
                'password' => password_hash($_SESSION['user_email'], PASSWORD_DEFAULT),
                'type' => 'member',
                'is_active' => 0,
            ]);
            $userID = $conn->lastInsertId();
        }

        // Thêm dữ liệu vào Order & OrderDetail
        $conn = $this->order->getConnection();
        $this->order->insert([
            'user_id' => $userID,
            'user_name' => $_POST['user_name'],
            'user_email' => $_POST['user_email'],
            'user_phone' => $_POST['user_phone'],
            'user_address' => $_POST['user_address'],

        ]);

        $orderID = $conn->lastInsertId();

        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        foreach ($_SESSION[$key] as $productID => $item) {

            $this->orderDetail->insert([
                'order_id' => $orderID,
                'product_id' => $productID,
                'quantity' => $item['quantity'],
                'price_regular' => $item['price_regular'],
                'price_sale' => $item['price_sale'],
            ]);
        }

        // xóa dữ liệu trong cart và cartdetail theo cartID - $_SESION['cart_id];

        // xóa dữ liệu trong session

        unset($_SESSION[$key]);

        if(isset($_SESSION['user'])){
            unset($_SESSION['cart_id']);
        }

        $_SESSION['complete']= "Đặt hàng thành công";
        header('Location: ' . url());
        exit;
    }
}
