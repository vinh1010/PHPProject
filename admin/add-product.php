<?php 
    include 'header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    $get_category = mysqli_query($conn,"SELECT * FROM category");

    if(isset($_POST['submit'])){
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sale_price = $_POST['sale_price'];
        $status = $_POST['status'];
        $category_id = $_POST['category_id'];
        $description = $_POST['description'];
        $errors = [];

        // Hàm kiểm tra ảnh

        if($_FILES['image']['error'] == 0){
            $upload = $_FILES['image'];
            $image = $upload['name'];
            move_uploaded_file($upload['tmp_name'], '../uploads/'.$image);
          
            // validate form
            if($name == ''){
                $errors['name'] = "You have not entered the product name";
            }
            if($price == ''){
                $errors['price'] = "You have not entered the price";
            }
            if($sale_price >= $price){
                $errors['sale_price'] = "Sale price must be less than price";
            }
            if($category_id == '----Vui lòng chọn category----'){
                $errors['category_id'] = "You have not selected a category";
            }
            else{
                $query = "INSERT INTO product(name,image,status,price,sale_price,description,category_id) VALUES ('$name','$image','$status','$price','$sale_price','$description','$category_id')";
                $add = mysqli_query($conn,$query);
                if($add){
                    header('Location: list-product.php');
                }
            }
        }
        else{
            $errors['image'] = 'You have not uploaded a image yet';
        }
    }
?>
<?php include './sidebar.php'?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-weight: bold;">Add Product</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST" enctype="multipart/form-data">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name Product</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name Product" name="name">
                    <?php if(isset($errors["name"])){ ?>
                    <p style="color:red">
                        <?php echo $errors["name"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Price" name="price">
                    <?php if(isset($errors["price"])){ ?>
                    <p style="color:red">
                        <?php echo $errors["price"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sale Price</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" value="0" placeholder="Sale Price" name="sale_price">
                    <?php if(isset($errors["sale_price"])){ ?>
                    <p style="color:red">
                        <?php echo $errors["sale_price"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <input type="file" id="exampleInputFile" name="image">
                    <?php if(isset($errors["image"])){ ?>
                        <p style="color:red">
                            <?php echo $errors["image"]?>
                        </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <br>
                    <input type="radio" class="form-check-input" name="status" id="" value="1" checked> CÒn Hàng
                    <input type="radio" class="form-check-input" name="status" id="" value="0"> Hết Hàng
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select class="form-control" name="category_id">
                        <option>----Vui lòng chọn category----</option>
                        <?php foreach($get_category as $value){ ?>
                            <option value="<?php echo $value["id"] ?>">
                                <?php echo $value['name']?>
                            </option>
                        <?php } ?>
                    </select>
                    <?php if(isset($errors["category_id"])){ ?>
                        <p style="color:red">
                            <?php echo $errors["category_id"]?>
                        </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label>Description</label>
                    <textarea class="form-control" rows="3" name="description" placeholder="Description ..."
                        style="margin: 0px -1.4px 0px 0px; height: 100px;"></textarea>
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?php include 'footer.php'?>