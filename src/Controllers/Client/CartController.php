<?php

namespace Ngogi\Xuongphp\Controllers\Client;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\Cart;
use Ngogi\Xuongphp\Models\CartDetail;
use Ngogi\Xuongphp\Models\Product;

class CartController extends Controlller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $carDetailt;

    public function __construct()
    {
        $this->product = new Product();
        $this->cart = new Cart();
        $this->carDetailt = new CartDetail();
    }

    public function add()
    { //Thêm vào giỏ hàng


        // Lấy thông tin sp theo id
        $product = $this->product->findByID($_GET['productID']);

        // Khởi tạo SESSION cart
        // Check n đang đang đăng nhập hay không
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if (!isset($_SESSION[$key][$product['id']])) {

            $_SESSION[$key][$product['id']] = $product + ['quantity' => $_GET['quantity'] ?? 1];
        } else {

            $_SESSION[$key][$product['id']]['quantity'] += $_GET['quantity'];
        }


        // Nếu nó đăng nhập thì mimk phải lưu vào csdl
        if (isset($_SESSION['user'])) {
            $conn = $this->cart->getConnection();
            
            // $conn->beginTransaction();
            try {

                $cart = $this->cart->findByUserID($_SESSION['user']['id']);

                if (empty($cart)) {
                    $this->cart->insert([
                        'user_id' => $_SESSION['user']['id'],
                    ]);
                }


                $cartID = $cart['id']  ?? $conn->lastInsertId();

                $_SESSION['cart_id'] = $cartID;

                $this->carDetailt->deleteByCartID($cartID);

                foreach ($_SESSION[$key] as $productID => $item) {
                   
                        $this->carDetailt->insert([
                            'cart_id' => $cartID,
                            'product_id' => $productID,
                            'quantity' => $item['quantity']
                        ]);
                    
                }

                // $conn->commit();
            } catch (\Throwable $th) {
                // $conn->rollBack();
            }
            
        }
        header('Location: ' . url('cart/detail'));
            exit;
        
    }

    public function detail(){ //Chi tiết giỏ hàng

        $this->renderViewClient('cart');

    }

    public function quantityInc()
    { // Tăng số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }


        $_SESSION[$key][$_GET['productID']]['quantity'] += 1;

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->carDetailt->updateByCartIDAndProductID(
                $_GET['cartID'], 
                $_GET['productID'], 
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function quantityDec()
    { // giảm số lượng
        // Lấy ra dữ liệu từ cart_details để đảm bảo n có tồn tại bản ghi

        // Thay đổi trong SESSION
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        if ($_SESSION[$key][$_GET['productID']]['quantity'] > 1) {
            $_SESSION[$key][$_GET['productID']]['quantity'] -= 1;
        }

        // Thay đổi trong DB
        if (isset($_SESSION['user'])) {
            $this->carDetailt->updateByCartIDAndProductID(
                $_GET['cartID'], 
                $_GET['productID'], 
                $_SESSION[$key][$_GET['productID']]['quantity']
            );
        }

        header('Location: ' . url('cart/detail'));
        exit;
    }

    public function remove()
    { //Xóa item hoặc xóa trắng
        $key = 'cart';
        if (isset($_SESSION['user'])) {
            $key .= '-' . $_SESSION['user']['id'];
        }

        unset($_SESSION[$key][$_GET['productID']]);

        if (isset($_SESSION['user'])) {
            $this->carDetailt->deleteByCartIDAndProductID($_GET['cartID'], $_GET['productID']);
        }


        header('Location: ' . url('cart/detail'));
        exit;
    }
}
