<?php 
namespace Ngogi\Xuongphp\Controllers\Client;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Models\Cart;
use Ngogi\Xuongphp\Models\CartDetail;
use Ngogi\Xuongphp\Models\Product;

class CartController extends Controlller
{
    private Product $product;
    private Cart $cart;
    private CartDetail $carDetailt;

    public function __construct(){
        $this->product = new Product();
        $this->cart = new Cart();
        $this->carDetailt = new CartDetail();
    }

    public function add(){ //Thêm vào giỏ hàng

    }

    public function quantityInc(){ //Tăng số lượng
        
    }

    public function quantityDec(){ // giải số lượng
        
    }

    public function remove(){ //Xóa item hoặc xóa trắng
        
    }
    
}