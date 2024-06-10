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

        <div class="row" id="product-list">
            @foreach ($products as $product)
            <div class="col-md-4 mb-2 mt-2  product-item">
                <div class="card">
                    <a href="{{ url('/products/' . $product['id']) }}">
                        <img class="card-img-top" style="max-height: 400px; max-width: 500px;" src="{{ asset($product['img_thumbnail']) }}" alt="Card image">
                    </a>
                    <div class="card-body">
                        <h4 class="card-title">
                            <a href="{{ url('/products/' . $product['id']) }}">{{ $product['name'] }}</a>
                        </h4>
                        <a href="{{ url('cart/add') }}?quantity=1&productID={{ $product['id'] }}" class="btn btn-primary">Thêm vào giỏ hàng</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="pagination-container">
            <nav aria-label="Page navigation">
                <ul class="pagination" id="pagination"></ul>
            </nav>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const rowsPerPage = 9;
            const items = document.querySelectorAll(".product-item");
            const pagination = document.getElementById("pagination");
            const pageCount = Math.ceil(items.length / rowsPerPage);

            function displayPage(page) {
                for (let i = 0; i < items.length; i++) {
                    items[i].style.display = (i >= (page - 1) * rowsPerPage && i < page * rowsPerPage) ? "block" : "none";
                }
            }

            function createPagination() {
                pagination.innerHTML = "";
                for (let i = 1; i <= pageCount; i++) {
                    const li = document.createElement("li");
                    li.className = "page-item";
                    const a = document.createElement("a");
                    a.className = "page-link";
                    a.href = "#";
                    a.innerText = i;
                    a.addEventListener("click", function(e) {
                        e.preventDefault();
                        displayPage(i);
                        document.querySelector(".pagination .active")?.classList.remove("active");
                        li.classList.add("active");
                    });
                    li.appendChild(a);
                    pagination.appendChild(li);
                }
                pagination.firstChild.classList.add("active");
            }

            createPagination();
            displayPage(1);
        });
    </script>
</body>

</html>