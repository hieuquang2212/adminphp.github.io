<?php
     $conn = new mysqli('localhost','root','','dashboard');
     $id = $_POST['id'];
     $sql = "
         UPDATE bills
         SET status = 'Da xac nhan'
         WHERE id = '$id'
     ";
     if ($conn->query($sql) === TRUE) {
         echo "Bạn đã xác nhận thành công";
     }
?>