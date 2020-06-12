<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $id = $_POST['id'];
    $sql = "
        UPDATE products
        SET status = 0
        WHERE id = '$id'
    ";
    if ($conn->query($sql) === TRUE) {
        echo "Xóa thành công";
    } else {
        echo "Error updating record: " . $conn->error;
    }
?>