<?php 
namespace Ngogi\Xuongphp\Controllers\Client;


use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\User;

class LoginController extends Controlller
{
    private User $user;

    public function __construct(){
        $this->user = new User();
    }
    public function showFormLogin () {

        auth_check();

        $this->renderViewClient('login');
    }

    public function login() {

        auth_check();

        try {
            $user = $this->user->findByEmail($_POST['email']);

            if(empty($user)){
                throw new \Exception('Không tồn tại email : ' . $_POST['email']);
            }

        $flag = password_verify($_POST['password'], $user['password']);
        if($flag){
            $_SESSION['user'] = $user;

            header('Location: '. url('admin/'));
            exit;
        }

        throw new \Exception('Password không đúng');
        } catch (\Throwable $th) {
            $_SESSION['error'] = $th->getMessage();

            header('Location: '. url('login'));
            exit;
        }
    }


    public function logout () {
        unset($_SESSION['user']);

        header('Location: ' . url('login'));
        exit;
    }

    
}