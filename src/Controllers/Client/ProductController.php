<?php 
namespace Ngogi\Xuongphp\Controllers\Client;

use Ngogi\Xuongphp\Commons\Controlller;

class ProductController extends Controlller
{
    public function index(){
        echo __CLASS__ . '@' . __FUNCTION__;
    }

    public function detail($id){
        echo __CLASS__ . '@' . __FUNCTION__ . '@' .$id;
    }
    
}