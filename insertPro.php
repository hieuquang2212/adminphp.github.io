<?php
    /* Getting file name */
    $filename = $_FILES['file']['name'];
    $name = $_POST['name'];
    $price= $_POST['price'];
    $description = $_POST['description'];
    $quantity = $_POST['quantity'];
    $status = $_POST['status'];
    /* Location */
    $location = "img/products/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    /* Valid Extensions */
    $valid_extensions = array("jpg","jpeg","png");
    $conn = new mysqli('localhost','root','','dashboard');
    /* Check file extension */
    if (in_array(strtolower($imageFileType),$valid_extensions) ) {
        //save file into directory
        move_uploaded_file($_FILES['file']['tmp_name'],$location);
    }
    $sql = "
        INSERT INTO products (name_product, price_product,image,description,quantity,status)
        VALUES ('$name','$price','$filename','$description','$quantity','$status')
    ";
    if ($conn->query($sql) === TRUE) {
        echo "Thêm sản phẩm thành công";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
?>