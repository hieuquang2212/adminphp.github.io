<?php
    $price = intval($_POST['price']);
    $currQuan = intval($_POST['currQuan']);
    $newQuan = intval($_POST['newQuan']);
    $total = intval($_POST['total']);
    $result = $total - $price*$currQuan + $price*$newQuan;
    $data['quantity'] = $newQuan;
    $data['total'] = number_format($result,0,',','.');
    echo json_encode($data);
?>