<?php

namespace Ngogi\Xuongphp\Controllers\Admin;


use Ngogi\Xuongphp\Commons\Controlller;
use Ngogi\Xuongphp\Models\Category;
use Rakit\Validation\Validator;

class CategoryController extends Controlller
{
    private Category $category;

    public function __construct()
    {
        $this->category = new Category();
    }

    public function index()
    {
        // Lấy danh sách các category và phân trang (nếu có)
        [$categories, $totalPage] = $this->category->paginate($_GET['page'] ?? 1);

        // Hiển thị view index với dữ liệu categories và tổng số trang
        $this->renderViewAdmin('categories.index', [
            'categories' => $categories,
            'totalPage' =>  $totalPage
        ]);
    }

    public function create()
    {
        // Hiển thị view create
        $this->renderViewAdmin('categories.create');
    }

    public function store()
    {
        // Validate dữ liệu nhập vào
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'name' => 'required|max:255'
        ]);
        $validation->validate();

        // Nếu có lỗi validation
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // Redirect về trang tạo mới category với thông báo lỗi
            header('Location: ' . url('admin/categories/create'));
            exit;
        } else {
            // Thêm mới category vào cơ sở dữ liệu
            $data = [
                'name' => $_POST['name']
            ];
            $this->category->insert($data);

            // Đặt session để hiển thị thông báo thành công
            $_SESSION['status'] = true;
            $_SESSION['message'] = 'Thêm mới category thành công';

            // Redirect về trang danh sách category
            header('Location: ' . url('admin/categories'));
            exit;
        }
    }

    public function show($id)
    {
        // Lấy thông tin category theo ID
        $category = $this->category->findByID($id);

        // Hiển thị view show với dữ liệu category
        $this->renderViewAdmin('categories.show', [
            'category' => $category
        ]);
    }

    public function edit($id)
    {
        // Lấy thông tin category theo ID
        $category = $this->category->findByID($id);

        // Hiển thị view edit với dữ liệu category
        $this->renderViewAdmin('categories.edit', [
            'category' => $category
        ]);
    }

    public function update($id)
    {
        // Lấy thông tin category theo ID
        $category = $this->category->findByID($id);

        // Validate dữ liệu nhập vào
        $validator = new Validator;
        $validation = $validator->make($_POST, [
            'name' => 'required|max:255'
        ]);
        $validation->validate();

        // Nếu có lỗi validation
        if ($validation->fails()) {
            $_SESSION['errors'] = $validation->errors()->firstOfAll();

            // Redirect về trang chỉnh sửa category với thông báo lỗi
            header('Location: ' . url("admin/categories/{$category['id']}/edit"));
            exit;
        } else {
            // Cập nhật thông tin category vào cơ sở dữ liệu
            $data = [
                'name' => $_POST['name']
            ];
            $this->category->update($id, $data);

            // Đặt session để hiển thị thông báo thành công
            $_SESSION['status'] = true;
            $_SESSION['message'] = 'Cập nhật category thành công';

            // Redirect về trang danh sách category
            header('Location: ' . url("admin/categories/{$category['id']}/edit"));
            exit;
        }
    }

    public function delete($id)
    {
        // Lấy thông tin category theo ID
        $category = $this->category->findByID($id);

        // Xóa category khỏi cơ sở dữ liệu
        $this->category->delete($id);

        // Đặt session để hiển thị thông báo thành công
        $_SESSION['status'] = true;
        $_SESSION['message'] = 'Xóa category thành công';

        // Redirect về trang danh sách category
        header('Location: ' . url('admin/categories'));
        exit();
    }
}
