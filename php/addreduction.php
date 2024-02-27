<?php
    include('database.php');

    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }

    $name = ClearData($_POST['name']);
    $reduction = ClearData($_POST['reduction']);

    mysqli_query($conn, "UPDATE `product` SET `reduction` = '$reduction' WHERE `product`.`name` = '$name';");
    mysqli_close($conn);    
    header('Location: ../admin.php');
    exit();
    
?>