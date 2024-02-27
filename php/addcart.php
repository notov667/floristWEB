<?php
    include('database.php');

    $user = $_COOKIE['user'];
    $product_id = file_get_contents('php://input');

    $cart = mysqli_query($conn, "SELECT `cart` FROM `user` WHERE `login` = '$user';");
    $row = $cart->fetch_assoc();
    $cart_string = $row['cart'];
    $cart_list = explode(',', $cart_string);
    if (!in_array($product_id, $cart_list)) {
        $cart_list[] = $product_id;
        $json_cart = implode(',', $cart_list);
        setcookie('cart_list', $json_cart, 0, "/");
        mysqli_query($conn, "UPDATE `user` SET `cart` = '$json_cart' WHERE `login` = '$user';");
    }
    else {
        $index = array_search($product_id, $cart_list);
        unset($cart_list[$index]);
        $json_cart = implode(',', $cart_list);
        setcookie('cart_list', $json_cart, 0, "/");
        mysqli_query($conn, "UPDATE `user` SET `cart` = '$json_cart' WHERE `login` = '$user';");
    }
    exit();

?>