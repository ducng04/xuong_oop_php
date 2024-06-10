<?php

namespace Ngogi\Xuongphp\Controllers\Admin;

use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Commons\Helper;
use Ngogi\Xuongphp\Models\Category;
use Ngogi\Xuongphp\Models\Product;

use Rakit\Validation\Validator;

class ProductController extends Controlller
{
    private Product $product;

    private Category $category;

    
    public function __construct()
    {
        $this->product = new Product();

        $this->category = new Category();

       

    }
    public function index()
    {
        $categories = $this->category->all();

        $categories = array_column($categories,'name' ,'id');
        [$products, $totalPage] = $this->product->paginate($_GET['page'] ?? 1);
        
        $this->renderViewAdmin('products.index', [
            'products' => $products,
            'totalPage' =>  $totalPage,
            'categories'=> $categories,
        
        ]);
    }

    public function create()
    {
        $categories = $this->category->all();

        $categories = array_column($categories,'name' ,'id');
        // Helper::debug($categories);
        $this->renderViewAdmin('products.create',[
            'categories'=> $categories,
        ]);
    }

    public function store()
    {
        $validator = new Validator;

        // make it
        $validation = $validator->make($_POST + $_FILES, [
            'name'                  => 'required|max:50',
            'price_regular'        => 'required|min:4|max:50',
            'price_sale'        => 'required|min:4|max:50',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',

        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url('admin/products/create'));
            exit;
            // Helper::debug($error);
        } else {
            $data = [
                'name'      => $_POST['name'],
                'price_regular'     =>  $_POST['price_regular'],
                'price_sale' => $_POST['price_sale'],
                'overview' => $_POST['overview'],
                'category_id' => $_POST['category_id'],

            ];

            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {
                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];
                // move_uploaded_file($from,$to);

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['error']['img_thumbnail'] = 'Fail';

                    header('Location: ' . url('admin/products/create'));
                    exit;
                }
            }
            $this->product->insert($data);

            $_SESSION['status'] = 'true';
            $_SESSION['message'] = 'Thanh công';

            header('Location: ' . url('admin/products'));
            exit;
        }
    }

    public function show($id)
    {
        $product = $this->product->findByID($id);
        
        $this->renderViewAdmin('products.show', [
            'product' => $product
        ]);
    }

    public function edit($id)
    {
        $product = $this->product->findByID($id);
        $categories = $this->category->all();

        $categories = array_column($categories,'name' ,'id');
        $this->renderViewAdmin('products.edit', [
            'product' => $product,
            'categories'=> $categories,
        ]);
    }

    

    public function update($id)
    {
        $product = $this->product->findByID($id);

        $validator = new Validator;
        $validation = $validator->make($_POST + $_FILES, [
          'name'                  => 'required|max:50',
            'price_regular'        => 'required|min:4|max:50',
            'price_sale'        => 'required|min:4|max:50',
            'img_thumbnail'                => 'uploaded_file:0,2M,png,jpg,jpeg',
        ]);
        $validation->validate();

        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            header('Location: ' . url("admin/products/{$product['id']}/edit"));
            exit;
        } else {
            $data = [
               'name'      => $_POST['name'],
                'price_regular'     =>  $_POST['price_regular'],
                'price_sale' => $_POST['price_sale'],
                'overview' => $_POST['overview'],
                'category_id' => $_POST['category_id'],
            ];

            $flagUpload = false;
            if (isset($_FILES['img_thumbnail']) && $_FILES['img_thumbnail']['size'] > 0) {

                $flagUpload = true;

                $from = $_FILES['img_thumbnail']['tmp_name'];
                $to = 'assets/uploads/' . time() . $_FILES['img_thumbnail']['name'];

                if (move_uploaded_file($from, PATH_ROOT . $to)) {
                    $data['img_thumbnail'] = $to;
                } else {
                    $_SESSION['errors']['img_thumbnail'] = 'Upload Không thành công';

                    header('Location: ' . url("admin/products/{$product['id']}/edit"));
                    exit;
                }
            }

            $this->product->update($id, $data);

            if (
                $flagUpload
                && $product['img_thumbnail']
                && file_exists(PATH_ROOT . $product['img_thumbnail'])
            ) {
                unlink(PATH_ROOT . $product['img_thumbnail']);
            }

            $_SESSION['status'] = true;
            $_SESSION['message'] = 'Thao tác thành công';

            header('Location: ' . url("admin/products"));
            exit;
        }
    }
    public function delete($id)
    {
        $product = $this->product->findByID($id);

        $this->product->delete($id);

        if (
            $product['img_thumbnail']
            && file_exists(PATH_ROOT . $product['img_thumbnail'])
        ) {
            unlink(PATH_ROOT . $product['img_thumbnail']);
        }

        header('Location: ' . url('admin/products'));
        exit();
    }
}
