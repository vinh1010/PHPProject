<?php 
    include './header.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $check_product = mysqli_query($conn,"SELECT * FROM product WHERE category_id = '$id'");
        if(mysqli_num_rows($check_product) != 0){
            $_SESSION["delete"] = "The product category exists, please delete the product first";
            header("Location: list-category.php");
        }
        else{
            $delete = mysqli_query($conn,"DELETE FROM category WHERE id = $id");
            if($delete){
                header("Location: list-category.php");
            }
        }  
    }
?>
