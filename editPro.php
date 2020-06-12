<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity  = $_POST['quantity'];
    $status = $_POST['status'];
    $sql = "   
        UPDATE products
        SET name_product='$name',price_product='$price',quantity='$quantity',status='$status'
        WHERE id='$id'
    ";
    if ($conn->query($sql) === TRUE) {
        echo "Cập  nhật thành công";
    } else {
        echo "Error updating record: " . $conn->error;
    }
?>