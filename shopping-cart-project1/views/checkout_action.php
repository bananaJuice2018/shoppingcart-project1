<?php
    require("header.php");

    $fullName = $_GET['fullname'];
    $email = $_GET['email'];
    $address = $_GET['address'];
    $city = $_GET['city'];
    $state = $_GET['state'];
    $zipCode = $_GET['zip'];

    $userId = $db_handle->runInsertQuery("INSERT INTO `customer`(`FullName`, `Email`, `Address`, `City`, `State`, `ZipCode`) VALUES ('$fullName', '$email', '$address', '$city', '$state', '$zipCode')");
    if($userId != -1) {
        foreach ($_SESSION["cart_item"] as $item) {
            $itemId = $item['id'];
            $quantity = $item['quantity'];

            $db_handle->runInsertQuery("INSERT INTO `purchase`(`UserId`, `ProductId`, `Quantity`) VALUES ('$userId', '$itemId', '$quantity')");
        }
    }
    
    header('Location: confirmation?userid='.$userId); // redirect to index.php
?>