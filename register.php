<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Register</title>
    <style>
        body {
            width: 50%;
            margin: auto;
        }
        input[type=text], input[type=password] {
            width: 300px;
            height: 30px;
            margin: 5px;
            padding-left:5px;
        }
        h3{
            text-align: center
        }
        form {
            text-align: center;
        }
    </style>
</head>
<body>
    <h3>Đăng kí tài khoản</h3>
    <form action="register.php" method="POST">
        <input type="text" name="fullname" placeholder="Tên đầy đủ"> <br>
        <input type="text" name="username" placeholder="Tên đăng nhập"> <br>
        <input type="password" name="password" placeholder="Mật khẩu"> <br>
        <input type="password" name="repeat_password" placeholder="Nhập lại mật khẩu"> <br>
        <?php
            if (isset($_POST['btn_register'])) {
                $conn = new mysqli('localhost','root','','dashboard');
                $username = $_POST['username'];
                $fullname = $_POST['fullname'];
                $password = $_POST['password'];
                $repeat_password = $_POST['repeat_password'];
                $type = $_POST['login_type'];
                if ($username == "") {
                    echo " <div class='alert alert-danger'>Bạn chưa nhập tên đăng nhập</div>";
                } else if ($password == "") {
                    echo " <div class='alert alert-danger'>Bạn chưa nhập mật khẩu</div>";
                } else if ($repeat_password == "") {
                    echo " <div class='alert alert-danger'>Bạn chưa nhập lại mật khẩu</div>";
                } else if ($password != $repeat_password) {
                    echo " <div class='alert alert-danger'>Mật khẩu không khớp</div>";
                } else {
                    if ($type == 'saler') {
                        $sql = "
                            INSERT INTO saler (login_name, full_name, password)
                            VALUES ('$username', '$fullname', '$password')
                        ";
                        if ($conn->query($sql) === TRUE) {
                            echo " <div class='alert alert-success'>Đăng kí thành công</div>";
                        } 
                    } else if ($type == 'admin') {
                        $sql = "
                            INSERT INTO admin (name, password)
                            VALUES ('$username', '$fullname', '$password')
                        ";
                    }
                }
            }
        ?>
        <span>
                    Đăng kí với tư cách là: <input type="radio" name="login_type" value="saler" checked> Nhân viên
                            <input type="radio" name="login_type" value="admin"> Admin <br>
        </span>
        <input type="submit" name="btn_register" value="Đăng kí">
    </form>
</body>
</html>