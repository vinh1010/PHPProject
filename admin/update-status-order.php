<?php
    $conn = mysqli_connect('localhost','root','','btl_php');
    mysqli_set_charset($conn,"utf8");
    ob_start();
    session_start();
    if(isset($_POST['value'])){
        $status = $_POST['value'];
        $id = $_POST['id'];

        $check_order = mysqli_query($conn,"SELECT * FROM orders WHERE orders.id = $id");
        $check_order = mysqli_fetch_assoc($check_order);
        if($check_order['status'] == 4 || $check_order['status'] == 5){
            $_SESSION["errors"] = "Unable to manipulate order";
            header("Location: ./cart-management.php");
        }
        else{
            $query = "UPDATE orders SET status = '$status' WHERE id = $id";
            $update = mysqli_query($conn, $query);
            if($update){
                $_SESSION["complate"] = "Order status update successful";
                header("Location: ./cart-management.php");
            }
        }
    }
?>