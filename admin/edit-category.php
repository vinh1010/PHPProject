<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        // Lấy bản ghi theo id dưới dạng object
        $get = mysqli_query($conn,"SELECT * FROM category WHERE id = $id");
        // Dùng hàm mysqli_fetch_assoc để chuyển kiểu object thành array
        $data = mysqli_fetch_assoc($get);
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $status = $_POST['status'];
    
            $errors = [];
            $check_name = mysqli_query($conn,"SELECT * FROM category");
            if(mysqli_num_rows($check_name) != 0 ){
                $errors['name'] = "$name already exists please choose another name";
            }
            if($name == ''){
                $errors['name'] = "You have not entered your name";
            }
            else{
                $query = "UPDATE category SET name = '$name', status = '$status' WHERE id = $id";
                $update = mysqli_query($conn, $query);
                if($update){
                    header("Location: ./list-category.php");
                }
            }
        }
    }
    
?>
<?php include './sidebar.php'?>
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title" style="font-weight: bold">Add Category</h3>
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form role="form" method="POST">
            <div class="box-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name Category</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" placeholder="Name category" name="name"
                        value="<?php echo $data['name'] ?>">
                    <?php if(isset($errors['name'])){ ?>
                    <p style="color:red">
                        <?php echo $errors["name"]?>
                    </p>
                    <?php } ?>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Status</label>
                    <br>
                    <input type="radio" class="form-check-input" name="status" id="" value="1" <?php echo
                        ($data["status"]==1)?'checked':'' ?>>Hiện
                    <input type="radio" class="form-check-input" name="status" id="" value="0" <?php echo
                        ($data["status"]==0)?'checked':'' ?>>Ẩn
                </div>
            </div>
            <!-- /.box-body -->

            <div class="box-footer">
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
<?php include './footer.php'?>