<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $id = $_POST['id'];
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $listPro = $_POST['listProduct'];
    $total = $_POST['totalCost'];
    $sql = "
        UPDATE bills
        SET customer_name='$name',list_product='$listPro',total_cost='$total',phone_number='$phone'
        WHERE id = '$id'
    ";
    if ($conn->query($sql) === TRUE) {
        echo "Sửa thành công";
    }
?>  