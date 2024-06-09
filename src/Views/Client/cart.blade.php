<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <h1 class="mt-5">Welcome {{ $name }} to my Website</h1>
            <nav>
                @if (!isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('login') }}">Login</a>
                @endif

                @if (isset($_SESSION['user']))
                <a class="btn btn-primary" href="{{ url('logout') }}">Logout</a>
                @endif

            </nav>

        </div>

        <div class="row">
            @if (!empty($_SESSION['cart']))
            <div class="col-md-4 mb-2 mt-2">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Tên sản phẩm</th>
                            <th>Ảnh</th>
                            <th>Số lượng</th>
                            <th>Giá tiền</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($_SESSION['cart'] as $item )
                            <tr>
                                <td>John</td>
                                <td>Doe</td>
                                <td>john@example.com</td>
                            </tr>
                        @endforeach
                            
                        
                    </tbody>
                </table>
            </div>
            @endif



        </div>
    </div>
</body>

</html>