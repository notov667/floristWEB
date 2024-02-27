<?php
    include('database.php');

    $user = $_COOKIE['user'];
    $product_id = file_get_contents('php://input');

    $fa = mysqli_query($conn, "SELECT `favourites` FROM `user` WHERE `login` = '$user';");
    $row = $fa->fetch_assoc();
    $fa_string = $row['favourites'];
    $fa_list = explode(',', $fa_string);
    if (!in_array($product_id, $fa_list)) {
        $fa_list[] = $product_id;
        $json_fa = implode(',', $fa_list);
        setcookie('fa_list', $json_fa, 0, "/");
        mysqli_query($conn, "UPDATE `user` SET `favourites` = '$json_fa' WHERE `login` = '$user';");
    }
    else {
        $index = array_search($product_id, $fa_list);
        unset($fa_list[$index]);
        $json_fa = implode(',', $fa_list);
        setcookie('fa_list', $json_fa, 0, "/");
        mysqli_query($conn, "UPDATE `user` SET `favourites` = '$json_fa' WHERE `login` = '$user';");
    }
    exit();

?>