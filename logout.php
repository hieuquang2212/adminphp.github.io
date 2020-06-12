<?php
    session_start();
    if (isset($_SESSION['saler_name']) && $_SESSION['saler_name'] != NULL) {
        unset($_SESSION['saler_name']);
        header('Location: login.php');
    }
    if (isset($_SESSION['admin_name']) && $_SESSION['admin_name'] != NULL) {
        unset($_SESSION['admin_name']);
        header('Location: login.php');
    }
?>