<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $customerName = $_POST['customerName'];
    $listProduct = substr($_POST['listProduct'],0,-1);
    $totalPrice = $_POST['totalPrice'];
    $sql = "
        INSERT INTO bills (customer_name, list_product, total_cost)
        VALUES ('$customerName','$listProduct','$totalPrice')
    ";
    if ($conn->query($sql) == TRUE) {
        echo "Thêm thành công";
    }  else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>