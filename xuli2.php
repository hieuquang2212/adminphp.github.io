<?php 
      $conn = new mysqli('localhost','root','','dashboard');
        $id = $_POST['id'];
        $quantity = $_POST['quantity'];
        $price = $_POST['price'];
        $checked = $_POST['checked'];
        $sql= "
            SELECT * FROM products
            WHERE id = '$id'
        ";
        $json_array = array();
        $result = $conn->query($sql)->fetch_assoc();
        $data['id'] = $id;
        $data['quantity'] = $quantity;
        if ($checked == 1) {
            $total = $price + intval($quantity)*$result['price_product'];
        } else {
            $total = $price - intval($quantity)*$result['price_product'];
        }
        $data['price'] = $total;
        $data['price_format'] = number_format($total,0,',','.'); 
        $res = json_encode($data);
        echo $res;
?>