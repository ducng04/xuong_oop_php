<?php 
namespace Ngogi\Xuongphp\Controllers\Client;


use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\Product;
use Ngogi\Xuongphp\Models\User;

class HomeController extends Controlller
{

    private Product $product;

    public function __construct(){
        $this->product = new Product();
    }
    public function index() {

        $name = 'DUCNG83';

        $products = $this->product->all();

        // Helper::debug($products);

        $this->renderViewClient('home',[
            'name'=> $name,
            'products'=> $products
        ]);
    }

    
}