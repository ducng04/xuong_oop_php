<?php 
namespace Ngogi\Xuongphp\Controllers\Admin;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\User;

class UserController extends Controlller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function index(){
        
        [$users , $totalPage] = $this->user->paginate($_GET['page'] ?? 1);
       
        $this->renderViewAdmint('users.index', [
            'users' => $users , 
             'totalPage' =>  $totalPage 
        ]);
    }

    public function create(){
        echo __CLASS__ . '@' . __FUNCTION__;
    }

    public function store(){
        echo __CLASS__ .''. __FUNCTION__;
    }

    public function show($id){
        echo __CLASS__ .''. __FUNCTION__ . ' - ID = ' .$id;
    }

    public function edit($id){
        echo __CLASS__ .''. __FUNCTION__ . ' - ID = ' .$id;
    }

    public function update($id){
        echo __CLASS__ .''. __FUNCTION__ . ' - ID = ' .$id;
    }

    public function delete($id){
        $this->user->delete($id);


        header('Location: '. url('admin/users'));
        exit();
    }

    
}