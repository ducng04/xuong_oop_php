<?php 
namespace Ngogi\Xuongphp\Controllers\Client;


use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\User;

class HomeController extends Controlller
{
    public function index() {

        // $user = new User();

        // Helper::debug($user);

        $name = 'DUCNG83';
        $this->renderViewClient('home',[
            'name'=> $name
        ]);
    }

    
}