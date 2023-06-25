<?php
    if(isset($_SESSION['cart'])){
        $cart = $_SESSION['cart'];
    }
    function total_price($cart){
        $total_price = 0;
        foreach($cart as $key => $value){
            $total_price += $value['price'] * $value['quantity'];
        }
        return $total_price;
    }
?>