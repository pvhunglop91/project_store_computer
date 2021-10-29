
<?php
    include("functions/functions.php");
    include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Do An Website</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Main containet start here -->
    <div class="main_wrapper">
        <div class="header_wrapper">
            <div class="header_logo">
                <a href="index.php">
                    <img src="./Image/Untitled_transparent.png" alt="">
                </a>
                
            </div> <!--/. header_logo -->
        
            <div id="form">
                <form method="get" action="results.php" enctype="multipart/form-data">
                    <input id="search" type="text" name="user_query" placeholder="Tìm kiếm sản phầm ..." />
                    <input type="submit" name="search" value="Search" />
                </form>
                
                
            </div>

            <div class="cart">
                <ul>
                    <li class="dropdown_header_cart">
                        <div id="notification_total_cart" class="shopping_cart">
                            <img src="./Image/cart_icon.png" id="cart_image" alt="">
                            <div class="noti_cart_number">
                                <?php
                                    total_items(); 
                                ?>
                            </div> <!-- /. noti_cart_number-->
                        </div>
                    </li>
                </ul>
            </div>
            

            <div class="register_login">
                <div class="login">
                    <a href="index.php?action=login">Login</a>
                </div>
                <div class="register">
                    <a href="customer_register.php">Register</a>
                </div>
            </div>
        </div> <!-- /. header_wrapper -->