<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login to dashboard</title>
    <link rel="stylesheet" href="style/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="login_page">
        <h1>Đăng nhập</h1>
        <div class="login_content">
            <form action="login.php" method="POST">
                <input type="text" name="username" id="username" placeholder="Tên đăng nhập"> <br>
                <input type="password" name="password" id="password" placeholder="Mật khẩu"> <br>
                <?php
                    require_once('lib/connection.php');
                    if (isset($_POST['btn_submit'])) {
                        $username = $_POST['username'];
                        echo $username;
                        $password = $_POST['password'];
                        echo $password;
                        if ($username == "") {
                            echo " <div class='alert alert-danger'>Bạn chưa nhập tên đăng nhập</div>";
                        } else if ($password == "") {
                            echo " <div class='alert alert-danger'>Bạn chưa nhập mật khẩu</div>";
                        } else {
                            $type = $_POST['login_type'];
                            if ($type == 'saler') {
                                $sql = "
                                    SELECT * FROM saler WHERE login_name= '$username'
                                    AND password = '$password'
                                ";
                                $result = $conn->query($sql);
                                if ($result->num_rows >0) {
                                    $_SESSION['saler_name'] = $username; 
                                    header('Location: index.php');
                                } else {
                                    echo " <div class='alert alert-danger'>Tên đăng nhập hoặc mật khẩu không đúng</div>";
                                }
                            } else {
                                if ($type == 'admin') {
                                    $sql = "
                                        SELECT * FROM admin
                                        WHERE name = '$username' AND password = '$password'
                                    ";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows >0) {
                                        $_SESSION['admin_name'] = $username;
                                            header('Location: index.php');    
                                    } else {
                                        echo " <div class='alert alert-danger'>Tên đăng nhập hoặc mật khẩu không đúng</div>";
                                    }
                                }
                            }
                        }
                    }
                ?>
                <span>
                    Bạn là : <input type="radio" name="login_type" value="saler" checked> Nhân viên
                            <input type="radio" name="login_type" value="admin"> Admin <br>
                </span>
                <input type="submit" name="btn_submit"  value="Đăng nhập"> <br>
                <a href="register.php" class="register_link">Bạn chưa có tài khoản ?</a>
            </form>
        </div>
    </div>
</body>
</html>