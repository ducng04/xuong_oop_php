<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách user</title>

    <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1>Danh sach user</h1>

    <a class="btn btn-primary " href="{{ url('admin/users/create') }}" >Thêm</a>

    @if (!empty($_SESSION['status']) && $_SESSION['status'])
            <div class="alert alert-success">
                {{ $_SESSION['message'] }}
                @php
                    unset($_SESSION['status']);
                @endphp
            </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>id </th>
                <th>img</th>
                <th>name</th>
                <th>Email</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td><?= $user['id'] ?></td>
                <td>
                    <img src="{{ asset($user['avatar']) }}" alt="" width="100">
                </td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><?= $user['update_at'] ?></td>
                <td>
                <a class="btn btn-info " href="{{ url('admin/users/' . $user['id'] . '/show') }}" >Xem</a>

                    <a class="btn btn-danger" href="{{ url('admin/users/' . $user['id'] . '/delete') }}" onclick="return confirm('Chắc chắn xóa không?')">Xóa</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>