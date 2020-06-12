<!DOCTYPE html>
<?php
    session_start();
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style/dashboard_style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <base href="http://localhost/admin/"/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
    <?php
        include('lib/connection.php');
        include('lib/database.php');
        if (isset($_SESSION['admin_name'])) include('includes/admin_dashboard.php');
        else if (isset($_SESSION['saler_name'])) include('includes/saler_dashboard.php');
        else {
            header('Location: login.php');
        }  
    ?>
</body>
<script src="js/xuli.js"></script>
<script src="js/change.js"></script>
</html>
