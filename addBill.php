<?php
      $conn = new mysqli('localhost','root','','dashboard');
      $customerName = $_POST['customerName'];
      $phoneNumber = $_POST['phoneNumber'];
      $listPro = $_POST['listProduct'];
      $totalPrice = intval($_POST['totalCost']);
      $status = $_POST['status'];
      $sql = "
        INSERT INTO bills (customer_name,list_product,total_cost,status,phone_number)
        VALUES ('$customerName','$listPro',$totalPrice,'$status','$phoneNumber')
      ";
      if ($conn->query($sql) === TRUE) {
          echo "Thêm đơn hàng thành công";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
?>