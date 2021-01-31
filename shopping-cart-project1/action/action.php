<?php
	require_once("dbcontroller.php");
    $db_handle = new DBController();
    $action = $_POST['action'];
    
    //=====Employee
    if(!empty($action) && $action == 'employeeDelete') {
        $employeeId = $_POST["employeeid"];
        $db_handle->runUpdateQuery("DELETE FROM `employee` WHERE Id='$employeeId'");
    }

    if(!empty($action) && $action == 'getEmployee') {
        $employeeId = $_POST["employeeid"];
        $employees = $db_handle->runQuery("SELECT * FROM employee WHERE Id='$employeeId'");
        $employee = $employees[0];
        echo json_encode($employee);
    }

    if(!empty($action) && ($action == 'addEmployee' || $action == 'updateEmployee')) {
        $name = $_POST['name'];
        $startDate = $_POST['start'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        if($action == 'updateEmployee') {
            $employeeId = $_POST["employeeid"];
            $db_handle->runUpdateQuery("UPDATE `employee` SET `Name`='$name', `StartDate`='$startDate', `Email`='$email', `Phone`='$phone' WHERE Id='$employeeId'");
        } else {
            $db_handle->runInsertQuery("INSERT INTO `employee` (`Name`, `StartDate`, `Email`, `Phone`) VALUES ('$name', '$startDate', '$email', '$phone')");
        }
    }
    //=====Product
    if(!empty($action) && $action == 'productDelete') {
        $productId = $_POST["productid"];

        $product = $db_handle->runQuery("SELECT * FROM product WHERE id='$productId'")[0];
        $originalImage = $product['Image'];
        if (file_exists($originalImage)) {
            unlink($originalImage);
        }

        $db_handle->runUpdateQuery("DELETE FROM `product` WHERE Id='$productId'");
    }

    if(!empty($action) && $action == 'getProduct') {
        $productId = $_POST["productid"];
        $products = $db_handle->runQuery("SELECT * FROM product WHERE Id='$productId'");
        $product = $products[0];
        echo json_encode($product);
    }

    if(!empty($action) && ($action == 'addProduct' || $action == 'updateProduct')) {
        $imageUrl = "";
        if(isset($_FILES['file']['name'])){
            $filename = $_FILES['file']['name'];
         
            $curTime = date('Y_m_d_H_i_s');
            //$location = "image/product-images/".$curTime."_".$filename;
            $location = "image/product-images/".$curTime."_".$filename;
            $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
            $imageFileType = strtolower($imageFileType);
         
            $valid_extensions = array("jpg","jpeg","png");
         
            if(in_array(strtolower($imageFileType), $valid_extensions)) {
               if(move_uploaded_file($_FILES['file']['tmp_name'],$location)){
                  $imageUrl = $location;
               }
            }
         }

        $name = $_POST['name'];
        $code = $_POST['code'];
        $price = $_POST['price'];
        $description = $_POST['description'];

        if($action == 'updateProduct') {     
            $productId = $_POST["productid"];
            if($imageUrl == "") {
                $db_handle->runUpdateQuery("UPDATE `product` SET `Name`='$name', `Code`='$code', `Price`='$price', `Description`='$description' WHERE Id='$productId'");
            } else {
                $product = $db_handle->runQuery("SELECT * FROM product WHERE id='$productId'")[0];
                $originalImage = $product['Image'];
                if (file_exists($originalImage)) {
                    unlink($originalImage);
                }
                $db_handle->runUpdateQuery("UPDATE `product` SET `Name`='$name', `Code`='$code', `Price`='$price', `Description`='$description', `Image`='$imageUrl' WHERE Id='$productId'");
                echo $originalImage;
            }
        } else {
            $db_handle->runInsertQuery("INSERT INTO `product` (`Name`, `Code`, `Price`, `Image`, `Description`) VALUES ('$name', '$code', '$price', '$imageUrl', '$description')");
        }
    }
?>