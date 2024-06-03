<?php 
namespace Ngogi\Xuongphp\Controllers\Client;


use Ngogi\Xuongphp\Commons\Controlller;

class HomeController extends Controlller
{
    public function index() {
        $name = 'DUCNG83';
        $this->renderViewClient('home',[
            'name'=> $name
        ]);
    }

    
}