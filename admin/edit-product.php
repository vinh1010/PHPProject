<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    $get_category = mysqli_query($conn,"SELECT * FROM category");

    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // Lấy bản ghi theo id dưới dạng object
        $get = mysqli_query($conn,"SELECT product.id , product.name, product.category_id , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product JOIN category ON product.category_id = category.id WHERE product.id = $id");
        // Dùng hàm mysqli_fetch_assoc để chuyển kiểu object thành array
        $data = mysqli_fetch_assoc($get);
        // xử lí update
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $price = $_POST['price'];
            $sale_price = $_POST['sale_price'];
            $status = $_POST['status'];
            $category_id = $_POST['category_id'];
            $description = $_POST['description'];
            $errors = [];

            if($_FILES['image']['error'] == 0){
                $upload = $_FILES['image'];
                $image = $upload['name'];
                move_uploaded_file($upload['tmp_name'], '../uploads/'.$image);
                if($name == ''){
                    $errors['name'] = "You have not entered the product name";
                }
                else if($price == ''){
                    $errors['price'] = "You have not entered the price";
                }
                else{
                    $query = "UPDATE product SET name = '$name' , image = '$image' , status = '$status' , price = '$price' , sale_price = '$sale_price' , description = '$description' , category_id = '$category_id' WHERE id = $id";
                    $update = mysqli_query($conn,$query);
                    if($update){
                        header('Location: ./list-product.php');
                    }
                }
            }
            // trường hợp không chỉnh sửa ảnh
            else{
                if($name == ''){
                    $errors['name'] = "You have not entered the product name";
                }
                else if($price == ''){
                    $errors['price'] = "You have not entered the price";
                }
                else{
                    // gán ảnh cũ
                    $image_old = $data['image'];
                    $query = "UPDATE product SET name = '$name' , image = '$image_old' , status = '$status' , price = '$price' , sale_price = '$sale_price' , description = '$description' , category_id = '$category_id' WHERE id = $id";
                    $update = mysqli_query($conn,$query);
                    if($update){
                        header('Location: ./list-product.php');
                    }
                }
            }
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
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name Product" name="name"
                        value="<?php echo $data['name'] ?>">
                    <?php if(isset($errors["name"])){ ?>
                    <p style="color:red">
                        <?php echo $errors["name"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Price</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Price" name="price"
                        value="<?php echo $data['price'] ?>">
                    <?php if(isset($errors["price"])){ ?>
                    <p style="color:red">
                        <?php echo $errors["price"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Sale Price</label>
                    <input type="number" class="form-control" id="exampleInputPassword1" placeholder="Sale Price"
                        name="sale_price" value="<?php echo $data['sale_price'] ?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <br>
                    <img src="../uploads/<?php echo $data['image'] ?>" alt="">
                    <input type="file" id="exampleInputFile" name="image">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <br>
                    <input type="radio" class="form-check-input" name="status" id="" value="1" <?php echo
                        ($data['status']==1)?'checked':'' ?>> CÒn Hàng
                    <input type="radio" class="form-check-input" name="status" id="" value="0" <?php echo
                        ($data["status"]==0)?'checked':'' ?>> Hết Hàng
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Category</label>
                    <select class="form-control" name="category_id">
                        <?php foreach ($get_category as $value){ ?>
                        <option value="<?php echo $value["id"] ?>"
                            <?php echo ($data['category_id'] == $value['id'])?'selected':''?>>
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
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Description..."
                        name="description" value="<?php echo $data['description'] ?>">
                </div>
                <!-- /.box-body -->

                <div class="box-footer">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
        </form>
    </div>
</div>
</div>
<?php 
    include './footer.php';
?>

db.products.aggregate([
  {
    $lookup: {
      from: "categorys",
      localField: "cateId",
      foreignField: "idCategory",
      as: "nameCate",
    },
  },
  {
    $limit: 1
  }
])