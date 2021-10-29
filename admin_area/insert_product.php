<!DOCTYPE html>

<?php include('includes/db.php');
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inserting Products</title>
</head>
<body bgcolor="skyblue"> 
    <form action="insert_product.php" method="POST" enctype="multipart/form-data">
        <table align="center" width="795" border="2" bgcolor="#187eae">
            <tr align="center">
                <td colspan="7"><h2>Thêm sản phẩm mới</h2></td>
            </tr>

            <tr> <!-- Category-->
                <td align="right"><b>Tên sản phẩm</b></td>
                <td><input type="text" name="product_title" size="60" required></td>
            </tr>

            <tr>
                <td align="right"><b>Danh mục sản phẩm</b></td>
                <td>
                    <select name="product_cat" id="">
                        <option value="">Chọn một danh mục</option>

                        <?php
                            $get_cats = "select * from categories";

                            $run_cats = mysqli_query($con, $get_cats);
                    
                            while($row_cats=mysqli_fetch_array($run_cats)){
                                $cat_id = $row_cats['cat_id'];
                    
                                $cat_title = $row_cats['cat_title'];
                    
                                echo "<option value='$cat_id'>$cat_title</option>";
                            }
                        ?>
                    </select>
                </td>
            </tr>   <!-- End Category-->


            <tr>    <!-- Brand-->
                <td align="right"><b>Thương hiệu sản phẩm</b></td>
                <td>
                    <select name="product_brand" id="">
                        <option value="">Chọn một thương hiệu</option>

                        <?php
                           $get_brands = "select * from brands";

                           $run_brands = mysqli_query($con, $get_brands);
                           while($row_brands = mysqli_fetch_array($run_brands)){
                               $brand_id = $row_brands['brand_id'];

                               $brand_title = $row_brands['brand_title'];
                   
                               echo "<option value='$brand_id'>$brand_title</option>";
                           }
                        ?>
                    </select>
                </td>
            </tr>   <!-- End Brand-->
            

            <tr>
                <td align="right"><b>Hình ảnh sản phẩm: </b></td>
                <td><input type="file" name="product_image"></td>
            </tr>

            <tr>
                <td align="right"><b>Giá sản phẩm: </b></td>
                <td><input type="text" name="product_price"></td>
            </tr>
            
            <tr>
                <td align="right"><b>Mô tả sản phẩm: </b></td>
                <td><textarea name="product_desc" id="" cols="20" rows="10"></textarea></td>
            </tr>


            <tr>
                <td align="right"><b>Từ khoá tìm kiếm sản phẩm</b></td>
                <td><input type="text" name="product_keywords"></td>
            </tr>
            
            <tr align="center">
                <td colspan="7"><input type="submit" name="insert_post" value="Thêm sản phẩm mới"></td>    
            </tr>

        </table>    
    </form>

</body>
</html>


<!-- Thêm sản phẩm mới -->
<?php
    if (isset($_POST['insert_post'])) {
        $product_title = $_POST['product_title'];
        $product_cat = $_POST['product_cat'];
        $product_brand = $_POST['product_brand'];
        $product_price = $_POST['product_price'];
        $product_desc = trim(mysqli_real_escape_string($con, $_POST['product_desc']));
        $product_keywords = $_POST['product_keywords'];
    
        //getting the image from the field
        $product_image = $_FILES['product_image']['name'];
        $product_image_tmp = $_FILES['product_image']['tmp_name'];
    
        // echo( $product_title);
        // echo($product_cat);
        // echo($product_brand);
        echo ($product_price);
        // echo($product_desc);
        // echo($product_image);
        // echo($product_image_tmp);
    
        move_uploaded_file($product_image_tmp, "product_images/$product_image");
    
        $insert_product =
            "INSERT INTO products(product_cat,product_brand,product_title,product_price,product_desc,product_image,product_keywords) 
            value('$product_cat','$product_brand','$product_title','$product_price','$product_desc','$product_image','$product_keywords')";
        $insert_pro = mysqli_query($con, $insert_product);
    
        if ($insert_pro) {
            echo ("<script>alert('Thêm sản phẩm thành công!')</script>");
            // echo ("<script>window.open('index.php?action=view_pro','_self')</script>");
        }
    }
?>