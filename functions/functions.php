
<?php
    $con = mysqli_connect("localhost","root","","doan");
    if(mysqli_connect_errno()){
        echo "The Connection was not established: ". mysqli_connect_error();
    }


    function cart(){
        global $con;

        if(isset($_GET['add_cart'])){
                        
            $product_id = $_GET['add_cart'];
            
            $ip= get_ip();

            $run_check_pro = mysqli_query($con, "select * from cart where product_id='$product_id' ");

            if(mysqli_num_rows($run_check_pro) > 0){
                echo "";
            } else {
                
                $fetch_pro = mysqli_query($con, "select * from products where product_id='$product_id' ");

                $fetch_pro = mysqli_fetch_array($fetch_pro);

                $pro_title = $fetch_pro['product_title'];

                $run_insert_pro = mysqli_query($con, "insert into cart (product_id, product_title, ip_address) values('$product_id','$pro_title','$ip') ");

                
            }
        }
    }

    function total_price(){
        global $con;
      
        $total = 0;
      
        $ip = get_ip();
      
        $run_cart = mysqli_query($con, "select * from cart where ip_address='$ip'");
        
        while($fetch_cart = mysqli_fetch_array($run_cart)){
      
          $product_id = $fetch_cart['product_id'];
      
          $result_product = mysqli_query($con,"select * from products where product_id = '$product_id'");
      
          while($fetch_product = mysqli_fetch_array($result_product)){
      
            $product_price = array($fetch_product['product_price']);
      
            $product_title = $fetch_product['product_title'];
      
            $product_image = $fetch_product['product_image'];
      
            $sing_price = $fetch_product['product_price'];
      
            $values = array_sum($product_price);
      
            $run_qty = mysqli_query($con, "select * from cart where product_id = '$product_id'");
      
            $row_qty = mysqli_fetch_array($run_qty);
      
            $qty = $row_qty['quality'];
      
            $values_qty = $values * $qty;
      
            $total += $values_qty;
          }
        }
        /*????y l?? h??m ?????nh d???ng ti???n t??? VN currency_format()*/ 
                  /*b???t ?????u currency_format()*/
                  if (!function_exists('currency_format')) {
                    function currency_format($number, $suffix = '???')
                    {
                        if (!empty($number)) {
                            return number_format($number, 0, ',', '.') . "{$suffix}";
                        }
                    }
                }
                /* k???t th??c currency_format()*/
                $total = currency_format($total);
        echo $total;
      }

    function total_items(){
        global $con;

        $ip = get_ip();

        $run_items = mysqli_query($con, "select * from cart where ip_address='$ip' ");

        echo $count_items = mysqli_num_rows($run_items);
    }

    function get_ip(){
        if(!empty($_SERVER['HTTP_CLIENT_IP'])){
            //ip from share internet
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        }elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
            //ip pass from proxy
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        return $ip;
    }
    


    function getCats(){
        global $con;
        $get_cats = "select * from categories";

        $run_cats = mysqli_query($con, $get_cats);

        while($row_cats=mysqli_fetch_array($run_cats)){
            $cat_id = $row_cats['cat_id'];

            $cat_title = $row_cats['cat_title'];

            echo " <li> <a href='index.php?cat=$cat_id'>$cat_title</a> </li>";
        }
    }


    function getBrands(){
        global $con;
        $get_brands = "select * from brands";

        $run_brands = mysqli_query($con, $get_brands);
        while($row_brands = mysqli_fetch_array($run_brands)){
            $brand_id = $row_brands['brand_id'];
            $brand_title = $row_brands['brand_title'];

            echo " <li> <a href='index.php?brand=$brand_id'>$brand_title</a> </li>";
        }
    }


    function getPro(){
        if(!isset($_GET['cat'])){ 
            if(!isset($_GET['brand'])){

        
            global $con;
            $get_pro = " select * from products order by RAND() LiMIT 0,8 ";

            $run_pro = mysqli_query($con, $get_pro);

            while($row_pro = mysqli_fetch_array($run_pro)){
                $pro_id = $row_pro['product_id'];
                $pro_cat = $row_pro['product_cat'];
                $pro_brand = $row_pro['product_brand'];
                $pro_title = $row_pro['product_title'];
                $pro_price = $row_pro['product_price'];
                $pro_image = $row_pro['product_image'];
                /*????y l?? h??m ?????nh d???ng ti???n t??? VN currency_format()*/ 
            /*b???t ?????u currency_format()*/
            if (!function_exists('currency_format')) {
                function currency_format($number, $suffix = '???')
                {
                    if (!empty($number)) {
                        return number_format($number, 0, ',', '.') . "{$suffix}";
                    }
                }
            }
            /* k???t th??c currency_format()*/

            

            $pro_pricess = currency_format($pro_price); /* t???o 1 c??i bi???n ????? l??u l???i hihi*/



                echo "
                    <div id='single_product'>
                       <a href='details.php?pro_id=$pro_id'>
                            <img src='admin_area/product_images/$pro_image' width='220' height='150' />
                            <h3>$pro_title</h3>
                        </a>

                        <p><b>$pro_pricess </b></p>

                      

                        <a href='index.php?add_cart=$pro_id'>
                            <button>Mua s???n ph???m</button>
                        </a>
                    </div>
                    ";
                }
            } 
        }
    }

    function get_pro_by_cat_id(){
        global $con; 
        if(isset($_GET['cat'])){
            $cat_id = $_GET['cat'];
            
            $get_cat_pro = "select * from products where product_cat='$cat_id' ";

            $run_cat_pro = mysqli_query($con, $get_cat_pro);

            $count_cats = mysqli_num_rows($run_cat_pro);

            if($count_cats == 0){
                echo "<h2 style='padding:20px;'>No products where found</h2>";
                // include('notification_products.php');
            }

            while($row_cat_pro = mysqli_fetch_array($run_cat_pro)){
                $pro_id = $row_cat_pro['product_id'];
                $pro_cat = $row_cat_pro['product_cat'];
                $pro_brand = $row_cat_pro['product_brand'];
                $pro_title = $row_cat_pro['product_title'];
                $pro_price = $row_cat_pro['product_price'];
                $pro_image = $row_cat_pro['product_image'];

                  /*????y l?? h??m ?????nh d???ng ti???n t??? VN currency_format()*/ 
                /*b???t ?????u currency_format()*/
                if (!function_exists('currency_format')) {
                function currency_format($number, $suffix = '???')
                {
                    if (!empty($number)) {
                        return number_format($number, 0, ',', '.') . "{$suffix}";
                        }
                }
    }
    /* k???t th??c currency_format()*/
  
    
    /*??? ????y l?? n???u $count_cats !=0 th?? xu???t ra s???n ph???m theo danh m???c ???? ch???n*/
    $pro_pricess = currency_format($pro_price); /* t???o 1 c??i bi???n ????? l??u l???i hihi*/

                echo " 
                <div id='single_product'>
                    <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_image' width='220' height='150' />
                        <h3>$pro_title</h3>
                    </a>

                    <p><b>$pro_pricess </b></p>

                  

                    <a href='index.php?add_cart=$pro_id'>
                        <button>Mua s???n ph???m</button>
                    </a>
                </div>
                ";
            }
        }
    }


    function get_pro_by_brand_id(){
        global $con;
        if(isset($_GET['brand'])){
            $brand_id = $_GET['brand'];
            
            $get_brand_pro = "select * from products where product_brand='$brand_id' ";

            $run_brand_pro = mysqli_query($con, $get_brand_pro);

            $count_brands = mysqli_num_rows($run_brand_pro);

            if($count_brands == 0){
                echo "<h2 style='padding:20px;'>No products where found</h2>";
            }

            while($row_brand_pro = mysqli_fetch_array($run_brand_pro)){
                $pro_id = $row_brand_pro['product_id'];
                $pro_cat = $row_brand_pro['product_cat'];
                $pro_brand = $row_brand_pro['product_brand'];
                $pro_title = $row_brand_pro['product_title'];
                $pro_price = $row_brand_pro['product_price'];
                $pro_image = $row_brand_pro['product_image'];
                

                  /*????y l?? h??m ?????nh d???ng ti???n t??? VN currency_format()*/ 
                /*b???t ?????u currency_format()*/
                if (!function_exists('currency_format')) {
                    function currency_format($number, $suffix = '???')
                    {
                        if (!empty($number)) {
                            return number_format($number, 0, ',', '.') . "{$suffix}";
                            }
                    }
        }
        /* k???t th??c currency_format()*/
      
        
        /*??? ????y l?? n???u $count_cats !=0 th?? xu???t ra s???n ph???m theo danh m???c ???? ch???n*/
        $pro_pricess = currency_format($pro_price); /* t???o 1 c??i bi???n ????? l??u l???i hihi*/
    

                echo " 
                <div id='single_product'>
                    <a href='details.php?pro_id=$pro_id'>
                        <img src='admin_area/product_images/$pro_image' width='220' height='150' />
                        <h3>$pro_title</h3>
                    </a>

                    <p><b>$pro_pricess </b></p>

                   

                    <a href='index.php?add_cart=$pro_id'>
                        <button>Mua s???n ph???m</button>
                    </a>
                </div>
                ";
            }
        }
    }
?>