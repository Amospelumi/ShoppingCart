<?php

//start session
session_start();

require_once('./items/CreateDb.php');
include('./items/component.php');


//creating the instance(an object) of CreateDb Class.
$database = new CreateDb (/*Database*/'shopping', /*Table*/'producttb');

    // Check if the user is already logged in, if yes then redirect him to welcome page
if(!isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] !== true){
    header("location:login.php");
}

if (isset($_POST['add'])){
        
        if (isset($_SESSION['cart'])){
            $item_array_id = array_column($_SESSION['cart'], 'product_Id');
            
            if (in_array($_POST['product_id'], $item_array_id )){
                echo "<script>alert('This product is already existing in your cart.')</script>";
                echo "<script>window.location = 'index.php'</script>";
            }else{
                echo "<script>alert('Product has been added to cart Successfully.')</script>";
                $count = count($_SESSION['cart']);
                $item_array = array ('product_Id' => $_POST['product_id']);

                $_SESSION['cart'][$count] = $item_array;
                
                
            }
            
            
        }else{
            $item_array = array ('product_Id' => $_POST['product_id']);

            //create a new session variable
            $_SESSION['cart'][0] = $item_array;
        }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amos_store</title>
    <!-- font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    
    <!-- boostrap cdn -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>

    <?php require_once('items/header.php') ?>;
<div class="storebanner">
    <div>
        <img src='./upload/banner.jpg' alt='banner' class='img-fluid card-img-top'>
    </div>
</div>
<div class="container">
    <?php
        //Columns must be a factor of 12 (1,2,3,4,6,12)
        $numOfCols = 4;
        $rowCount = 0;
        // $bootstrapColWidth = 12 / $numOfCols;
    ?>
    <div class="row text-center py-5">
        <?php
            $result= $database->getData();
            while ($row = mysqli_fetch_assoc($result)){
                menu($row['productImage'], $row['productName'], $row['productSummary'], $row['productDiscountPrice'], $row['productPrice'], $row['Id']);
                $rowCount++;
                if($rowCount % $numOfCols == 0){ 
                echo '</div><div class="row text-center py-5">';
                }
            }
        ?>
    </div>
    
        
</div>


    <footer style= "background-color:black">
        <h6 class="footnote" style="color: white; margin-left: 450px; padding: 8px 8px;"> Copyright@AmosComputerWorld. All Rights Reserved.</h6>
    </footer>



<!-- boostrap javascript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js" integrity="sha384-SR1sx49pcuLnqZUnnPwx6FCym0wLsk5JZuNx2bPPENzswTNFaQU1RDvt3wT4gWFG" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.min.js" integrity="sha384-j0CNLUeiqtyaRmlzUHCPZ+Gy5fQu0dQ6eZ/xAww941Ai1SxSY+0EQqNXNE6DZiVc" crossorigin="anonymous"></script>   
</body>
</html>