<?php
    $quantity = $_POST['quantity'];
    $price = $_POST['price'];
    $total = $_POST['total'];
    $total = intval($total) - intval($price)*intval($quantity);
    echo number_format($total,0,',','.');
?>