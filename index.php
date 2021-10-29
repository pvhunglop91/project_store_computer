
<!-- Header Starts ---->
<?php
    include('includes/header.php');
?>  
<!-- Header ends ---->

        <!-- Navigation Bar starts ---->
        <div class="menu_bar">
            <ul id="menu">
                <li><a href="index.php" data-item='Home'>Trang chủ</a></li>
                <li><a href="all_products.php" data-item='All Products'>Tất cả sản phẩm</a></li>
                <li><a href="customer/my_account.php" data-item='My Account'>Tài khoản</a></li>
                <li><a href="cart.php" data-item='Shopping Cart'>Giỏ hàng</a></li>
                <li><a href="contact.php" data-item='Contact us'>Hỗ trợ</a></li>
            </ul>
        </div> <!-- / .Menubar ---->

        <!-- Navigation Bar Ends ---->


          <!-- Content wrapper starts ---->
        <div class="content_wrapper">
            <div id="sidebar">
                <div id="sidebar_title">Sản phẩm</div>
                <ul id="cats">
                    <!-- <li> <a href="index.php">Laptop</a> </li>
                    <li> <a href="index.php">Cameras</a> </li>
                    <li> <a href="index.php">Mobiles</a> </li> -->

                    <?php
                        getCats();
                    ?>
                </ul>

                <div id="sidebar_title">Thương hiệu</div>
                <ul id="cats">
                    <!-- <li> <a href="index.php">HP</a> </li>
                    <li> <a href="index.php">DELL</a> </li>
                    <li> <a href="index.php">LG</a> </li> -->
                    <?php
                        getBrands();
                    ?>
                </ul>
            </div> <!-- #Sidebar-->
             
            
            <div id="content_area">

                <?php
                    cart(); 
                ?>

                <div id="products_box">

                    <?php
                        getPro();     
                    ?>
                    
                    <?php
                        get_pro_by_cat_id();
                    ?>

                    <?php
                        get_pro_by_brand_id();
                    ?>    

                </div> <!-- / #products_box-->
            </div> <!-- / #content_area -->

        </div>  <!-- / .Content Wrapper Ends ---->

        <?php 
            include ('includes/footer.php');
        ?>