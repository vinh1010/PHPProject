<?php 
    include './connect/conDB.php';
    if(isset($_GET['id'])){
        $id = $_GET['id'];
    }
    // kiểm tra hàm action nếu không tồn tại gán action = add;
    $action = (isset($_GET['action'])) ? $_GET['action'] : 'add';
    // Khai báo hàm quantity set quantity = 1
    $quantity = (isset($_GET['quantity'])) ? $_GET['quantity'] : 1;
    if($quantity <=0 ){
        // nếu quantity < 0 mặc định quantity = 1
        $quantity = 1;
    }
    // hàm lấy product
    $product = mysqli_query($conn,"SELECT * FROM product WHERE id = '$id'");
    $product = mysqli_fetch_assoc($product);
    // Set item thông qua product
    $items = [
        'id' => $product['id'],
        'name' => $product['name'],
        'image' => $product['image'],
        'price' => ($product['sale_price'] > 0) ? $product['sale_price'] : $product['price'],
        'quantity' => $quantity,

    ];
    // nếu action = add
    if($action == 'add'){
        // nếu đã tồn tại $_SESSION['cart']
        if(isset($_SESSION['cart'][$id])){
            // tăng quantity lên 1
            $_SESSION['cart'][$id]['quantity'] += $quantity;
        }
        // nếu chưa tồn tại $_SESSION['cart']
        else{
            // tạo $_SESSION['cart'] gán các trường của item
            $_SESSION['cart'][$id] = $items;
        }  
    }
     // nếu action = update
    if($action == 'update'){
        // lấy gán quantity lấy được từ form
        $_SESSION['cart'][$id]['quantity'] = $quantity;
    }
    // nếu action = delete
    if($action == 'delete'){
        // xóa $_SESSION['cart']
       unset($_SESSION['cart'][$id]);
    }
    header('Location: view-cart.php');
?>