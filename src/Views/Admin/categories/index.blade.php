@extends('layouts.master')

@section('title')
Danh sách categories
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-12">
        <div class="white_card card_height_100 mb_30">
            <div class="white_card_header">
                <div class="box_header m-0">
                    <div class="main-title">
                        <h1 class="m-0">Danh sách categories</h1>
                    </div>
                </div>
            </div>
            <div class="white_card_body">
                <a class="btn btn-primary" href="{{ url('admin/categories/create') }}">Thêm</a>

                @if (!empty($_SESSION['status']) && $_SESSION['status'])
                <div class="alert alert-success">
                    {{ $_SESSION['message'] }}
                </div>
                @php
                unset($_SESSION['status']);
                unset($_SESSION['message']);
                @endphp
                @endif
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                            <tr>
                                <td>{{ $category['id'] }}</td>
                                <td>{{ $category['name'] }}</td>
                                <td>
                                    
                                    <a class="btn btn-warning" href="{{ url('admin/categories/' . $category['id'] . '/edit') }}">Sửa</a>
                                    <a class="btn btn-danger" href="{{ url('admin/categories/' . $category['id'] . '/delete') }}" onclick="return confirm('Chắc chắn xóa không?')">Xóa</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
