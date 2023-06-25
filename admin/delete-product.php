<?php 
    include './header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $check_order = mysqli_query($conn,"SELECT * FROM order_detail WHERE id_product = '$id'");
        print_r($check_order);
        if(mysqli_num_rows($check_order) != 0){
            $_SESSION["delete"] = "The product has an order, please wait for the order to be completed";
            header("Location: list-product.php");
        }
        else{
            $delete = mysqli_query($conn,"DELETE FROM product WHERE id = $id");
            if($delete){
                header("Location: ./list-product.php");
            }
        }  
    }
?>
