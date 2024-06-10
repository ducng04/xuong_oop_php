<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding-top: 50px;
        }

        .product-card {
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            margin-bottom: 20px;
        }

        .product-card img {
            width: 100%;
            height: auto;
            display: block;
        }

        .product-card .card-body {
            padding: 20px;
        }

        .product-card h4 {
            font-size: 18px;
            margin-bottom: 10px;
        }

        .product-card form {
            display: flex;
            align-items: center;
        }

        .product-card form input[type="number"] {
            width: 60px;
            margin-right: 10px;
        }

        .product-card form button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }

        .product-card form button:hover {
            background-color: #0056b3;
        }
    </style>
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
            <div class="col-md-4 mb-2 mt-2">
                <div class="card product-card">
                    <img class="card-img-top" src="{{ asset($product['img_thumbnail']) }}" alt="Card image">
                    <div class="card-body">
                        <h4 class="card-title">{{ $product['name'] }}</h4>

                        <form action="{{ url('cart/add') }}" method="get">
                            <input type="hidden" name="productID" value="{{ $product['id'] }}">
                            <input type="number" name="quantity" min="1" value="1">
                            <button type="submit">Thêm vào giỏ hàng</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
