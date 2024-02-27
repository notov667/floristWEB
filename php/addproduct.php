<?php
    include('database.php');

    function ClearData($val) {
        $val = trim($val); 
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    $path = '../products';
    $pathforsql = 'products';
    $ext = strtolower(substr(strrchr($_FILES['image']['name'], '.'), 1));

    $img_name = md5($_FILES["file"]["name"] . microtime()) . '.' . $ext;
    $file = $path . '/' . $img_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
        $name = ClearData($_POST['name']);
        $price = ClearData($_POST['price']);
        $type = ClearData($_POST['type']);
        $info = ClearData($_POST['info']);
        $destination = $pathforsql . '/' . $img_name;
    
        $request = "INSERT INTO `product` (`name`, `price`, `type`, `info`, `img_path`) VALUES ('$name', '$price', '$type', '$info', '$destination');";
        mysqli_query($conn, $request);   
        mysqli_close($conn); 
        header('Location: ../admin.php');
        exit();
    }
    else {
        echo "error";
    }



?>