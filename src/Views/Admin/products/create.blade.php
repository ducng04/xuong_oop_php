<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm mới product</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Thêm mới products</h1>

    @if (!empty($_SESSION['errors']))
    <div class="alert alert-warning">
        <ul>

            @foreach ($_SESSION['errors'] as $error )
            <li>
                {{ $error }}
            </li>
            @endforeach

        </ul>
        @php
        unset($_SESSION['errors']);
        @endphp
    </div>
    @endif
    <form action="{{ url('admin/products/store') }}" enctype="multipart/form-data" method="post">
        <div class="mb-3 mt-3">
            <label for="name" class="form-label">Name:</label>
            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
        </div>
        <div class="mb-3 mt-3">
            <label for="category_id" class="form-label">Category :</label>
            <select id="category_id" name="category_id" class="form-select">

                @foreach ($categories as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 mt-3">
            <label for="price_regular" class="form-label">Price regular :</label>
            <input type="text" class="form-control" id="price_regular" placeholder="Enter price regular" name="price_regular">
        </div>

        <div class="mb-3 mt-3">
            <label for="price_sale" class="form-label">price sale:</label>
            <input type="text" class="form-control" id="price_sale" placeholder="Enter price sale" name="price_sale">
        </div>

        <div class="mb-3 mt-3">
            <label for="overview" class="form-label">Overview:</label>
            <textarea class="form-control" id="overview" placeholder="Enter overview" name="overview"></textarea>
        </div>


        <div class="mb-3">
            <label for="img_thumbnail" class="form-label">Img :</label>
            <input type="file" class="form-control" id="img_thumbnail" placeholder="Enter img" name="img_thumbnail">
        </div>


        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

</body>

</html>