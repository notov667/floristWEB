<?php
    include('database.php');

    function ClearData($val) {
        $val = trim($val);
        $val = stripcslashes($val);
        $val = strip_tags($val);
        $val = htmlspecialchars($val);
        return $val;
    }
    
    if($_FILES['image']['tmp_name'] != null) {
    	$path = ClearData($_POST['oldpath']);
    	$file = '../'.$path;
        move_uploaded_file($_FILES['image']['tmp_name'], $file);
    }
    $oldname = ClearData($_POST['oldname']);
	$name = ClearData($_POST['name']);
	$type = ClearData($_POST['type']);
	$info = ClearData($_POST['info']);
	$price = ClearData($_POST['price']);
	$request = "UPDATE `product` SET `name` = '$name', `type` = '$type', `info` = '$info', `price` = '$price' WHERE `product`.`name` = '$oldname';";
	mysqli_query($conn, $request);
	mysqli_close($conn);    
	header('Location: ../admin.php');
	exit();        
?>