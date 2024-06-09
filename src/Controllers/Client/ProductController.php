<?php 
namespace Ngogi\Xuongphp\Controllers\Client;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Models\Product;

class ProductController extends Controlller
{
    private Product $product;

    public function __construct(){
        $this->product = new Product();
    }

    public function index(){
        echo __CLASS__ . '@' . __FUNCTION__;
    }

    public function detail($id){
        $product = $this->product->findByID($id);

        $this->renderViewClient('product-detail', [
            'product'=> $product,
        ]);
    }
    
}