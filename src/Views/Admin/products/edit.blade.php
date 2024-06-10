<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm: {{ $product['name'] }}</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Cập nhật sản phẩm: {{ $product['name'] }}</h1>

    @if (!empty($_SESSION['errors']))
        <div class="alert alert-warning">
            <ul>
                @foreach ($_SESSION['errors'] as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            @php
                unset($_SESSION['errors']);
            @endphp
        </div>
    @endif

    <form action="{{ url("admin/products/{$product['id']}/update") }}" enctype="multipart/form-data" method="post">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Tên:</label>
            <input type="text" class="form-control" id="name" placeholder="Nhập tên" value="{{ $product['name'] }}" name="name">
        </div>
        
        <div class="mb-3 mt-3">
            <label for="category_id" class="form-label">Danh mục:</label>
            <select id="category_id" name="category_id" class="form-select">
                @foreach ($categories as $id => $name)
                    <option value="{{ $id }}" @if($product['category_id'] == $id) selected @endif>{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="price_regular" class="form-label">Giá thường:</label>
            <input type="text" class="form-control" id="price_regular" placeholder="Nhập giá thường" value="{{ $product['price_regular'] }}" name="price_regular">
        </div>

        <div class="mb-3 mt-3">
            <label for="price_sale" class="form-label">Giá khuyến mãi:</label>
            <input type="text" class="form-control" id="price_sale" placeholder="Nhập giá khuyến mãi" value="{{ $product['price_sale'] }}" name="price_sale">
        </div>

        <div class="mb-3 mt-3">
            <label for="overview" class="form-label">Tổng quan:</label>
            <textarea class="form-control" id="overview" placeholder="Nhập tổng quan" name="overview">{{ $product['overview'] }}</textarea>
        </div>

        <div class="mb-3">
            <label for="img_thumbnail" class="form-label">Hình ảnh:</label>
            <input type="file" class="form-control" id="img_thumbnail" name="img_thumbnail">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</body>

</html>
