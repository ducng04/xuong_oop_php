
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
                <td></td>
                <td><?= $user['name'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['created_at'] ?></td>
                <td><?= $user['update_at'] ?></td>
                <td>
                    <form action="{{ url('admin/users/' . $user['id'] . '/delete') }} " method="post">
                        <button onclick="return confirm('Are you sure ?')" type="submit" >Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</body>

</html>