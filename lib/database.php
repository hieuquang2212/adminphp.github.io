<?php
    function getAllProductInfo($conn)  {
        $sql = "
            SELECT * FROM products
        "; 
        return $conn->query($sql);
    }
    function getOneProductInfo($conn,$id) {
        $sql = "
            SELECT * FROM products
            WHERE id  = '$id'
        "; 
        return $conn->query($sql);
    }
    function getProductExept($conn,$id) {
        $sql = "
            SELECT * FROM products
            WHERE id  != '$id'
        "; 
        return $conn->query($sql);
    }
    function getAllBills($conn) {
        $sql = "
            SELECT * FROM bills
        ";
        return $conn->query($sql);
    }
    function getOneBill($conn, $id) {
        $sql = "
            SELECT * FROM bills
            WHERE id = '$id'
        ";
        return $conn->query($sql);
    }
    function getPriceEachProduct($conn, $id) {
        $sql = "
            SELECT price_product FROM products
            WHERE id = '$id'
        ";
        return $conn->query($sql);
    }
?>