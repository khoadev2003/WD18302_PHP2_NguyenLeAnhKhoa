<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab 1.4</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
    

    <div class="container">
        <h2 class="text-center mt-5">Danh sách khách hàng</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Họ tên</th>
                    <th scope="col">Tài khoản</th>
                    <th scope="col">Email</th>
                    <th scope="col">Địa chỉ</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $i = 0;
                foreach ($list_users as $value):
                    extract($value);
                    $i++;
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $full_name ?></td>
                    <td><?= $username ?></td>
                    <td><?= $email ?></td>
                    <td><?= $address ?></td>
                    <td><a href="" class="btn-sm btn-danger">Edit</a></td>
                </tr>
                <?php endforeach ?>
                
            </tbody>
        </table>
    </div>
</body>
</html>