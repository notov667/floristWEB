<?php
    include('php/database.php');

    $user = $_COOKIE['user'];

    $admin = mysqli_query($conn, "SELECT * FROM `user` WHERE `login` = '$user';");
    $is_admin = $admin->fetch_assoc();

    if ($is_admin['admin'] != '1') {
        header('Location: /');
    }

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css/admin.css">
        
        <title>admin panel</title>
    </head>
    <body>
        <div class="main_wrapper">
            <form action="php/addproduct.php" method="post" enctype="multipart/form-data">
                <h2>Добавить товар</h2>
	            <label>Фотография товара<input type="file" onchange="imageInput(this)" name="image" accept="image/*">
	            <div id="imagepreview" class="form_preview"></div></label>
                <label>Название товара<input type="text" name="name" required></label>
                <label>Тип товара
                    <select name="type">
                        <option value="flowers">Цветы</option>
                        <option value="gifts">Подарки</option>
                    </select>
                </label>
                <label>Информация о товаре<textarea name="info" required></textarea></label>
                <label>Цена товара<input type="number" name="price" required></label>
                <button type="submit">Добавить</button>
            </form>
            <form action="php/addreduction.php" method="post" enctype="multipart/form-data">
                <h2>Добавить скидку на товар</h2>
                <label>Название товара
                    <select name="name" id="product_addreduction">
                        <?php 
                            if ($products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`name` ASC;")) {
                                foreach($products as $row) {
                                    echo '<option data-reduction="'.$row['reduction'].'" value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </label>
                <label>Скидка %<input type="number" id="product_reduction" name="reduction" min="1" max="100" required></label>
                <button type="submit">Добавить</button>
            </form>
            <form action="php/updateproduct.php" method="post" enctype="multipart/form-data">
	            <h2>Редактировать данные товара</h2>
	            <label>Выбрать товар
	            <select name="oldname" id="product_update">
	                <?php
	                    if($products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`name` ASC;")){               
	                        foreach($products as $row){
	                            echo '<option data-name="'.$row['name'].'" data-info="'.$row['info'].'" data-path="';
	                            echo $row['img_path'].'" data-type="'.$row['type'].'" data-price="'.$row['price'].'">';
	                            echo $row['name'].'</option>';
	                        }
	                    }
	                ?>
	            </select></label>
	            <label>Поменять название<input name="name" id="product_name" required></label>
	            <label>Фотография товара<input type="file" onchange="imageInput(this)" name="image" accept="image/*">
	            <div id="imagepreview" class="form_preview"></div></label>
	            <input style="display: none;" id="product_oldpath" readonly>
	            <label>Выберите тип товара<select name="type">
	                <option class="oldtype" disabled selected></option>
                    <option value="flowers">Цветы</option>
                    <option value="gifts">Подарки</option>
	            </select></label>
                <label>Информация о товаре<textarea name="info" id="product_info" required></textarea></label>
                <label>Цена товара<input type="number" name="price" id="product_price" required></label>
	            <button type="submit">сохранить</button>
	        </form>
            <form action="php/deleteproduct.php" method="post" enctype="multipart/form-data">
                <h2>Удалить товар</h2>
                <label>Название товара
                    <select name="name">
                        <?php 
                            if ($products = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`name` ASC;")) {
                                foreach($products as $row) {
                                    echo '<option value="' . $row['name'] . '">' . $row['name'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </label>
                <button type="submit">Удалить</button>
            </form>
        </div>
        <div class="main_wrapper">
            <form action="php/addadmin.php" method="post">
                <h2>Дать/убрать админку</h2>
                <label>Логин пользователя
                    <select name="login">
                        <?php 
                            if ($user = mysqli_query($conn, "SELECT * FROM `user` ORDER BY `user`.`name` ASC;")) {
                                foreach($user as $row) {
                                    echo '<option value="' . $row['login'] . '">' . $row['login'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </label>
                <label class="radio_label"><input type="radio" name="admin" value="0" checked>Убрать</label>
                <label class="radio_label"><input type="radio" name="admin" value="1">Дать</label>
                <button type="submit">Сохранить</button>
            </form>
            <form action="php/deleteuser.php" method="post">
                <h2>Удалить пользователя</h2>
                <label>Логин
                    <select name="login">
                        <?php 
                            if ($user = mysqli_query($conn, "SELECT * FROM `user` ORDER BY `user`.`name` ASC;")) {
                                foreach($user as $row) {
                                    echo '<option value="' . $row['login'] . '">' . $row['login'] . '</option>';
                                }
                            }
                        ?>
                    </select>
                </label>
                <button type="submit">Удалить</button>
            </form>
        </div>

        <script src="js/admin.js"></script>
    </body>
</html>