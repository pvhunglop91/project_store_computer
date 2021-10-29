
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

                    <?php
                        getCats();
                    ?>
                </ul>

                <div id="sidebar_title">Thương hiệu</div>
                <ul id="cats">
                 
                    <?php
                        getBrands();
                    ?>
                </ul>
            </div> <!-- #Sidebar-->
             
            
            <div id="content_area">
                <div class="shopping_cart_container">

                
                    <div id="shopping_cart" align="right" style="padding:15px">
                        <?php
                            if(isset($_SESSION['customer_email'])){
                                echo "<b>Email:</b>" . $_SESSION['customer_email'];
                            }else{
                                echo "";
                            }

                        ?>
                        <b style="font-family: Arial, Helvetica, sans-serif;">Giỏ hàng của tôi - </b> Số lượng : <?php total_items();?> Tổng tiền : <?php total_price();?>

                    </div>    <!-- / .shopping_cart-->
                    <form action="" method="post" enctype="multipart/form-data">     
                    <table align="center" width="100%" id="fonttable">
                            <tr align="center">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Số lượng</th>
                                <th>Thành tiền</th>
                            </tr>

                            <?php
                                $total = 0;
      
                                $ip = get_ip();
                              
                                $run_cart = mysqli_query($con, "select * from cart where ip_address='$ip'");
                                
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

                                    while($fetch_cart = mysqli_fetch_array($run_cart)){
                          
                                        $product_id = $fetch_cart['product_id'];
                                    
                                        $result_product = mysqli_query($con,"select * from products where product_id = '$product_id'");
                                    
                                        while($fetch_product = mysqli_fetch_array($result_product)){
                                    
                                          $product_price = array($fetch_product['product_price']);
                                    
                                          $product_title = $fetch_product['product_title'];
                                    
                                          $product_image = $fetch_product['product_image'];
                                    
                                          $sing_price = $fetch_product['product_price'];
          
                                          $sing_price = currency_format($sing_price);
                                    
                                          $values = array_sum($product_price);
                                    
                                          $run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id'");
                                    
                                          $row_qty = mysqli_fetch_array($run_qty);
                                    
                                          $qty = $row_qty['quality'];
                                    
                                          $values_qty = $values * $qty;
                                    
                                          $total += $values_qty;
                                      
                            ?>

                            <tr align="center">
                                <td align="left"><input type="checkbox" name="remove[]" style="margin-left: 8.5px;" value="<?php echo $product_id; ?>"></td>
                                <td><img src="admin_area/product_images/<?php echo $product_image ?> "  width='73' height='50'  /></td>
                                <td><?php echo $product_title;?></td>
                            <!-- <td class="buttons_added">
                              <input class="minus is-form" type="button" value="-">
                              <input aria-label="quantity" class="input-qty" max="100" min="1" name="qty" type="number" value="<?php echo $qty;?>">
                              <input class="plus is-form" type="button" value="+">
                            </td> -->
                                <td><input type="text" size="1" name="qty" value="<?php echo $qty;?>"></td>
                                <td><?php echo $sing_price;?></td>
                                <td colspan="2" id="delete"><button name name="update_cart"><img src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/trash.svg"></button></td>
                            </tr>

                           <?php } } //End While ?>
                            
                             <!-- <tr>
                            <td colspan="4" align="right">Số lượng : <?php total_items();?></td>
                          </tr>

                          <tr>
                            <td colspan="4" align="right">Tổng tiền : <?php echo total_price(); ?></td>
                          </tr> -->

                          <tr align="left">
                            <td colspan="2" id="delete"><button name="update_cart"><img src="https://frontend.tikicdn.com/_desktop-next/static/img/icons/trash.svg"></button></td>
                            <td></td>
                            <td></td>
                            <!-- <td><button class="buttoncheckout" ><a href="checkout.php">Thanh toán</a></button></td> -->
                            <td>
                                  <div class="pay"><button type="submit" class="custom-btn btn-15" style="margin-left: 135px;"><a href="checkout.php">Thanh toán</a></button></div>
                            </td>
                          </tr>
                    </table>
                    </form> 

                </div> <!-- / .shopping_cart_container-->
                <div id="products_box">


                </div> <!-- / #products_box-->
            </div> <!-- / #content_area -->

        </div>  <!-- / .Content Wrapper Ends ---->

        <?php 
            include ('includes/footer.php');
        ?>