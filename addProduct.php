<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $id = $_POST['id'];
    $total = $_POST['total'];
    $sql = "
            SELECT * FROM products
            WHERE id  = '$id'
        "; 
    $result = $conn->query($sql)->fetch_assoc();
    $data['id'] = $result['id'];
    $data['name'] = $result['name_product'];
    $data['price'] = number_format($result['price_product'],0,',','.');
    $data['image'] =  "img/products/{$result['image']}";
    $data['total'] = number_format(intval($total) + intval($result['price_product']),0,',','.');
    echo json_encode($data);
                

?>