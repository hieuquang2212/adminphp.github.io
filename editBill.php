<?php
    $conn = new mysqli('localhost','root','','dashboard');
    $id = $_POST['idPro'];
    $total = $_POST['total'];
    $prevPrice = $_POST['prevPrice'];
    $quantity = $_POST['quantity'];
    $newQuantity = $_POST['newQuan'];
    $sql = "
        SELECT price_product FROM products
        WHERE id = '$id'
    ";
    $result = $conn->query($sql)->fetch_assoc();
    //Update total
    $total = intval($total)-intval($prevPrice)*intval($quantity)+$result['price_product']*intval($newQuantity);
    $data['total'] = number_format($total,0,',','.');
    $data['price'] = number_format($result['price_product'],0,',','.');
    echo json_encode($data);
?>  