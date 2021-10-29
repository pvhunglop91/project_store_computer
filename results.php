
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
                <div id="sidebar_title">
                    Sản phẩm
                </div>
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
                <div id="products_box">

                    <?php
                        if(isset($_GET['search'])){
                           $search_query = $_GET['user_query'];

                           $run_query_by_pro_id = mysqli_query($con, "select * from products where product_keywords like '%$search_query%' ");

                            while($row_pro = mysqli_fetch_array($run_query_by_pro_id)){
                                $pro_id = $row_pro['product_id'];
                                $pro_cat = $row_pro['product_cat'];
                                $pro_brand = $row_pro['product_brand'];
                                $pro_title = $row_pro['product_title'];
                                $pro_price = $row_pro['product_price'];
                                $pro_image = $row_pro['product_image'];
                                /*đây là hàm định dạng tiền tệ VN currency_format()*/ 
                                /*bắt đầu currency_format()*/
                                if (!function_exists('currency_format')) {
                                    function currency_format($number, $suffix = '₫')
                                        {
                                            if (!empty($number)) {
                                                return number_format($number, 0, ',', '.') . "{$suffix}";
                                            }
                                        }
                                }
                                 /* kết thúc currency_format()*/

            

                                $pro_pricess = currency_format($pro_price); /* tạo 1 cái biến để lưu lại hihi*/

                                echo " 
                                <div id='single_product'>
                                     <a href='details.php?pro_id=$pro_id'>
                                        <img src='admin_area/product_images/$pro_image' width='220' height='150' />
                                        <h3>$pro_title</h3>
                                    </a>

                                    <p><b>$pro_pricess </b></p>

                                   

                                    <a href='index.php?add_cart=$pro_id'>
                                        <button>Mua sản phẩm</button>
                                    </a>
                                </div>
                                ";
                            }
                        }     
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