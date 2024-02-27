<?php
    include('php/database.php');
    
    $user = $_COOKIE['user'];

    if (!isset($_COOKIE['user']) OR trim($_COOKIE['user']) == '') {
        setcookie('cart_list', '', 0, "/");
        setcookie('fa_list', '', 0, "/");
    }
    else {
        $userdata = mysqli_query($conn, "SELECT * FROM `user` WHERE `login` = '$user';");
        $userdata_row = $userdata->fetch_assoc();
        $cart_list = $userdata_row['cart'];
        $fa_list = $userdata_row['favourites'];
        setcookie('cart_list', $cart_list, 0, "/");
        setcookie('fa_list', $fa_list, 0, "/");
    }
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Qyzgaldak-Flower Shop Website</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Leckerli+One&family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,900;1,800&display=swap" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="#main">Главная</a>
            <a href="#flowers">Цветы</a>
            <a href="#gifts">Подарки</a>
            <a href="#contacts">Контакты</a>
        </nav>
        <div class="h-icons">
            <a href="userpage.php#cart"><i class='bx bx-shopping-bag'></i></a>
            <a href="index.php#contacts"><i class='bx bx-phone'></i></a>
            <a href="userpage.php#favourites"><i class='bx bx-heart'></i></a>
            <a href="auth.html"><i class='bx bx-user'></i></a>
            <div class="bx bx-menu" id="menu-icon"></div>
        </div>
    </header>

    <section class="main" id="main">
        <div class="main-text">
            <h1>Найдите свои любимые <br>Цветы</h1>
            <p>Красота в каждом лепестке и изысканность в каждой цветочной композиции.</p>
            <a href="#flowers" class="btn">Оформить заказ</a>
        </div>
    </section>

   
    

    <section class="flowers" id="flowers">
        <h1 class="heading"> Наши <span> бестселлеры</span></h1>
        <div class="box-container">
            <?php 
                if($product = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`reduction` DESC;")){
                    foreach($product as $row){
                        if ($row['reduction'] != 0) {
                            echo '<div class="box" data-id="'.$row['id'].'"><span class="discount">'.$row['reduction'].'%</span>';
                            echo '<div class="image"><img src="'.$row['img_path'].'" alt="">';
                            $btn_text = "Добавить";
                            $btn_style = "";
                            $heart_style = "";
                            if (isset($_COOKIE['fa_list']) OR trim($_COOKIE['fa_list']) == '') {
                                $fa = $_COOKIE['fa_list'];
                                $fa_list = explode(',', $fa);
                                foreach ($fa_list as $fa_product) {
                                    if ($fa_product === $row['id']) {
                                        $heart_style = "_liked";
                                    }   
                                }
                            }
                            if (isset($_COOKIE['cart_list']) OR trim($_COOKIE['cart_list']) == '') {
                                $cart = $_COOKIE['cart_list'];
                                $cart_list = explode(',', $cart);
                                foreach ($cart_list as $cart_product) {
                                    if ($cart_product === $row['id']) {
                                        $btn_text = "Убрать";
                                        $btn_style = "_incart";
                                    }   
                                }
                            }

                            echo '<div class="icons"><a onclick="likeBtn(this)" class="fas fa-heart '.$heart_style.'"></a>';
                            echo '<a onclick="cartBtn(this)" class="cart-btn '.$btn_style.'">'.$btn_text.'</a><a class="fas fa-share"></a>';
                            echo '</div></div><div class="content">';
                            echo '<h3>'.$row['name'].'</h3>';
                            echo '<p>'.$row['info'].'</p>';
                            $price = $row['price'] * (1-$row['reduction']/100);
                            echo '<div class="Price">"'.$price.' тг." <span></span></div></div></div>';
                        }
                    }
                }
            ?>
        </div>
    </section>



        <section class="icons-container">
            <div class="icons">
                <img src="assets/icon-1.png" alt="">
                <div class="info">
                    <h3>Бесплатная доставка</h3>
                    <span>На все заказы</span>
                </div>
            </div>
        
            <div class="icons">
                <img src="assets/icon-2.png" alt="">
                <div class="info">
                    <h3>10 дней возврат</h3>
                    <span>Гарантия возврата денег</span>
                </div>
            </div>
        
            <div class="icons">
                <img src="assets/icon-3.png" alt="">
                <div class="info">
                    <h3>Открытки и подарки</h3>
                    <span>На все заказы</span>
                </div>
            </div>
        
            <div class="icons">
                <img src="assets/icon-4.png" alt="">
                <div class="info">
                    <h3>Безопасные платежи</h3>
                    <span>Гарантируем безопасность</span>
                </div>
            </div>
        </section>
        
        <section class="flowers" id="flowers">
            <h1 class="heading"> Наши <span> Цветы</span></h1>
            <div class="box-container">
                <?php 
                    if($product = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`name` ASC;")){
                        foreach($product as $row){
                            if($row['type'] == 'flowers'){
                                echo '<div class="box" data-id="'.$row['id'].'">';
                                if($row['reduction'] != 0) {
                                    echo '<span class="discount">'.$row['reduction'].'%</span>';
                                }
                                echo '<div class="image"><img src="'.$row['img_path'].'" alt="">';
                                $btn_text = "Добавить";
                                $btn_style = "";
                                $heart_style = "";
                                if (isset($_COOKIE['fa_list']) OR trim($_COOKIE['fa_list']) == '') {
                                    $fa = $_COOKIE['fa_list'];
                                    $fa_list = explode(',', $fa);
                                    foreach ($fa_list as $fa_product) {
                                        if ($fa_product === $row['id']) {
                                            $heart_style = "_liked";
                                        }   
                                    }
                                }
                                if (isset($_COOKIE['cart_list']) OR trim($_COOKIE['cart_list']) == '') {
                                    $cart = $_COOKIE['cart_list'];
                                    $cart_list = explode(',', $cart);
                                    foreach ($cart_list as $cart_product) {
                                        if ($cart_product === $row['id']) {
                                            $btn_text = "Убрать";
                                            $btn_style = "_incart";
                                        }   
                                    }
                                }

                                echo '<div class="icons"><a onclick="likeBtn(this)" class="fas fa-heart '.$heart_style.'"></a>';
                                echo '<a onclick="cartBtn(this)" class="cart-btn '.$btn_style.'">'.$btn_text.'</a><a class="fas fa-share"></a>';
                                echo '</div></div><div class="content">';
                                echo '<h3>'.$row['name'].'</h3>';
                            	echo '<p>'.$row['info'].'</p>';
                                $price = $row['price'] * (1-$row['reduction']/100);
                                echo '<div class="Price">"'.$price.' тг." <span></span></div></div></div>';
                            }
                        }
                    }
                ?>
            </div>
            </section>

            <section class="icons-container">
                <div class="icons">
                    <img src="assets/news1.png" alt="">
                    <div class="info">
                        <h3>Свежие Цветы</h3>
                        <span>flowers сортов высокого класса</span>
                    </div>
                </div>
            
                <div class="icons">
                    <img src="assets/news2.png" alt="">
                    <div class="info">
                        <h3>Скидки</h3>
                        <span>Скидки и акции</span>
                    </div>
                </div>
            
                <div class="icons">
                    <img src="assets/news3.png" alt="">
                    <div class="info">
                        <h3>Оформление на ваш вкус</h3>
                        <span>Оформлением наших цветов занимаются профессионалы</span>
                    </div>
                </div>
            
                <div class="icons">
                    <img src="assets/news4.png" alt="">
                    <div class="info">
                        <h3>Консультация</h3>
                        <span></span>
                    </div>
                </div>
            </section>


       
            <section class="gifts" id="gifts">
                <h1 class="heading"> Дополнительные<span> Подарки</span></h1>
                <div class="box-container">
                    <?php 
                        if($product = mysqli_query($conn, "SELECT * FROM `product` ORDER BY `product`.`name` ASC;")){
                            foreach($product as $row){
                                if($row['type'] == 'gifts'){
                                    echo '<div class="box" data-id="'.$row['id'].'">';
                                    if($row['reduction'] != 0) {
                                        echo '<span class="discount">'.$row['reduction'].'%</span>';
                                    }
                                    echo '<div class="image"><img src="'.$row['img_path'].'" alt="">';
                                    $btn_text = "Добавить";
                                    $btn_style = "";
                                    $heart_style = "";
                                    if (isset($_COOKIE['fa_list']) OR trim($_COOKIE['fa_list']) == '') {
                                        $fa = $_COOKIE['fa_list'];
                                        $fa_list = explode(',', $fa);
                                        foreach ($fa_list as $fa_product) {
                                            if ($fa_product === $row['id']) {
                                                $heart_style = "_liked";
                                            }   
                                        }
                                    }
                                    if (isset($_COOKIE['cart_list']) OR trim($_COOKIE['cart_list']) == '') {
                                        $cart = $_COOKIE['cart_list'];
                                        $cart_list = explode(',', $cart);
                                        foreach ($cart_list as $cart_product) {
                                            if ($cart_product === $row['id']) {
                                                $btn_text = "Убрать";
                                                $btn_style = "_incart";
                                            }   
                                        }
                                    }

                                    echo '<div class="icons"><a onclick="likeBtn(this)" class="fas fa-heart '.$heart_style.'"></a>';
                                    echo '<a onclick="cartBtn(this)" class="cart-btn '.$btn_style.'">'.$btn_text.'</a><a class="fas fa-share"></a>';
                                    echo '</div></div><div class="content">';
                                    echo '<h3>'.$row['name'].'</h3>';
                            		echo '<p>'.$row['info'].'</p>';
                                    $price = $row['price'] * (1-$row['reduction']/100);
                                    echo '<div class="Price">"'.$price.' тг." <span></span></div></div></div>';
                                }
                            }
                        }
                    ?>
                </div>
            </section>
            
          

            <section class="contacts" id="contacts">

                <h1 class="heading"> <span>  </span>  </h1>
            
                <div class="row">
            
                    <form action="" method= post>
                       
                        
                        <input type="text" name="name" placeholder="имя" class="box" required>
                       
                        <input type="email" name="email"placeholder="email" class="box">
                        
                        <input type="number"name="number" placeholder="номер" class="box" required>
                       
                        <textarea name="" class="box" placeholder="комментарий" id="" cols="30" rows="10"></textarea>
                        <input type="submit" value="отправить" name="submit" class="btn">
                    </form>
            
                    <div class="image">
                        <img src="assets/phone.jpg" alt="">
                    </div>
            
                </div>
            
            </section>
            
        
            
            <section class="contact">
                <div class="contact-box">
                    <h4>MY ACCOUNT</h4>
                    <li><a href="userpage.php">My account</a></li>
                    <li><a href="#">Checkout</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="userpage.php#cart">Shopping Cart</a></li>
                    <li><a href="userpage.php#favourites">Wishlist</a></li>  
                </div>

                <div class="contact-box">
                    <h4>QUICK LINKS</h4>
                    <li><a href="#">Store Location</a></li>
                    <li><a href="#">Orders Tracking</a></li>
                    <li><a href="#">Size Guide</a></li>
                    <li><a href="userpage.php">My account</a></li>
                    <li><a href="#">FAQs</a></li>  
                </div>

                <div class="contact-box">
                    <h4>INFORMATION</h4>
                    <li><a href="#">Privacy Page</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Delivery Information</a></li>
                    <li><a href="#">Term & Conditions</a></li>  
                </div>

                <div class="contact-box">
                    <h4>CUSTOMER SERVICE</h4>
                    <li><a href="#">Shipping Policy</a></li>
                    <li><a href="#">Help & Contact Us</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                    <li><a href="#">Online Stores</a></li>
                    <li><a href="#">Term & Conditions</a></li>  
                </div>

                <div class="contact-box">
                    <h4>CONTACTS</h4>
                    <h5>Connect with us</h5>
                    <div class="social">
                    <a href="#"><i class='bx bxl-facebook'></i></a>
                    <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                    <a href="#"><i class='bx bxl-twitter'></i></a>
                </div>
                </div>
            </section>

            <a href="#" class="scroll-top"><i class='bx bx-chevrons-up' ></i></a>

            <div class="end-text">
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>

            
    <script src="js/script.js"></script>
    <script src="js/productsave.js"></script>
</body>
</html>


