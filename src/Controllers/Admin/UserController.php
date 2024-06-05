<?php

namespace Ngogi\Xuongphp\Controllers\Admin;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\User;
use Rakit\Validation\Validator;

class UserController extends Controlller
{
    private User $user;
    public function __construct()
    {
        $this->user = new User();
    }
    public function index()
    {

        [$users, $totalPage] = $this->user->paginate($_GET['page'] ?? 1);

        $this->renderViewAdmin('users.index', [
            'users' => $users,
            'totalPage' =>  $totalPage
        ]);
    }

    public function create()
    {
        $this->renderViewAdmin('users.create');
    }

    public function store()
    {
        $validator = new Validator;

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'email'                 => 'required|email',
            'password'              => 'required|min:6',
            'confirm_password'      => 'required|same:password',
            'avatar'                => 'uploaded_file:0,2M,png,jpg,jpeg',
            
        ]);
        $validation->validate();

        if ($validation->fails()){
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' .url('admin/users/create'));
            exit;
            // Helper::debug($error);
        }else{
            $data= [
                'name'      => $_POST['name'],
                'email'     =>  $_POST['email'],
                'password'  => password_hash($_POST['password'], PASSWORD_DEFAULT) ,
               
            ];

            if(isset($_FILES['avatar']) && $_FILES['avatar']['size'] > 0){
                $from = $_FILES['avatar']['tmp_name'];
                $to = 'assets/uploads/'. time() . $_FILES['avatar']['name'];
                // move_uploaded_file($from,$to);
                
                if(move_uploaded_file($from, PATH_ROOT . $to)){
                    $data['avatar'] = $to;
                }else{
                    $_SESSION['error']['avtar'] = 'Fail';

                    header('Location: ' .url('admin/users/create'));
                    exit;
                }

            }
            $this->user->insert($data);

            $_SESSION['status'] = 'true';
            $_SESSION['message'] = 'Thanh công';

            header('Location: ' .url('admin/users'));
                    exit;

        }
    }

    public function show($id)
    {
        $user = $this->user->findByID($id);
        // Helper::debug($user);
        $this->renderViewAdmin('users.show', [
            'user'=> $user
        ]);
    }

    public function edit($id)
    {
        echo __CLASS__ . '' . __FUNCTION__ . ' - ID = ' . $id;
    }

    public function update($id)
    {
        echo __CLASS__ . '' . __FUNCTION__ . ' - ID = ' . $id;
    }

    public function delete($id)
    {
        $this->user->delete($id);


        header('Location: ' . url('admin/users'));
        exit();
    }
}
