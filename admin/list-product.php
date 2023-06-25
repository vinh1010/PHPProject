<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    $keyword = isset($_GET["keyword"]) ? $_GET["keyword"] : '';
    $list = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product 
    JOIN category ON product.category_id = category.id 
    WHERE product.name LIKE '%$keyword%'");
    // $list = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description, product.created_at , category.name AS 'category' FROM product 
    // LEFT JOIN category ON product.category_id = category.id ORDER BY product.id DESC");
    $toatal = mysqli_num_rows($list);
    $limit = 6;
    $toatal_page = ceil($toatal / $limit);
    $cr_page = isset($_GET['page']) ? $_GET['page'] : 1;
    $start = ($cr_page - 1) * $limit;
    $list = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product 
    JOIN category ON product.category_id = category.id  ORDER BY product.id DESC LIMIT $start,$limit");

    if(isset($_GET['keyword'])){
        $keyword = $_GET['keyword'];
        $list = mysqli_query($conn,"SELECT product.id , product.name , product.image , product.status , product.price , product.sale_price , product.description , category.name AS 'category' FROM product 
        JOIN category ON product.category_id = category.id 
        WHERE product.name LIKE '%$keyword%' LIMIT $start,$limit");
    }
?>
<?php include './sidebar.php'?>
    <div class="box">
        <div class="box-header">
            <div class="row">
                <div class="col-md-8">
                    <h3 class="box-title" style="font-weight: bold;padding-top: 15px">List Product</h3>
                </div>
                <div class="col-md-4">
                    <form method="GET" class="sidebar-form">
                        <div class="input-group">
                            <input type="text" value="<?php echo $_GET['keyword'] ?>" name="keyword" class="form-control" placeholder="Enter Name Product">
                            <span class="input-group-btn">
                                <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                    </form>
                </div>
             </div>
        </div>
        
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <table class="table" id="my-table">
                <?php if(isset($_SESSION['delete'])){ ?>    
                    <div class="alert alert-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <strong>Title!</strong><?php echo $_SESSION["delete"]?>.
                    </div>
                    <?php unset($_SESSION['delete']); ?>
                <?php } ?>
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name Product</th>
                        <th>Price</th>
                        <th>Sale Price</th>
                        <th style="width: 10%">Image</th>
                        <th>Category</th>
                        <th>Status</th>
                        <th style="width: 10%">Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $value ){ ?>
                        <tr>
                            <td style="padding-top: 20px">
                                <?php echo $key + 1 ?>
                            </td>
                            <td style="padding-top: 20px">
                                <?php echo $value['name'] ?>
                            </td>
                            <td style="padding-top: 20px">
                                <?php echo $value['price'] ?>
                            </td>
                            <td style="padding-top: 20px">
                                <?php echo $value['sale_price'] ?>
                            </td>
                            <td><img src="../uploads/<?php echo $value['image'] ?>" width="80%" alt=""></td>
                            <td style="padding-top: 20px">
                                <?php echo $value['category'] ?>
                            </td>
                            <?php if($value["status"] == 1){ ?>
                            <td style="padding-top: 20px">
                                <p class="badge bg-green">Stocking</p>
                            </td>
                            <?php }else{ ?>
                            <td style="padding-top: 20px">
                                <p class="badge bg-red">Out of stock</p>
                            </td>
                            <?php } ?>
                            <td style="padding-top: 20px">
                                <a href="./edit-product.php?id=<?php echo $value['id'] ?>"><i class="fa fa-pencil-square text-info" style="font-size: 20px" aria-hidden="true"></i></a>
                                <a href="./delete-product.php?id=<?php echo $value['id'] ?>"><i class="fa fa-trash text-danger" style="font-size: 20px" aria-hidden="true"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <div style="text-align: center;">
                <ul class="pagination">
                    <li class="<?php echo (($cr_page - 1 == 0) ? 'check' : '')?>">
                        <a href="list-product.php?page=<?php echo $cr_page - 1?>
                        <?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>">&laquo;</a>
                    </li>
                    <?php for( $i=1; $i <= $toatal_page ; $i++ ){?>
                        <li class="<?php echo (($cr_page  == $i) ? 'active' : '') ?>">
                            <a href="list-product.php?page=<?php echo $i ?>
                            <?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>"><?php echo $i ?></a>
                        </li>
                    <?php } ?>
                    <li class="<?php echo (($cr_page == $toatal_page) ? 'check' : '')?>">
                        <a href="list-product.php?page=<?php echo $cr_page + 1?>
                        <?php echo ($keyword != '') ? "&keyword=$keyword" : ''?>">&raquo;</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<?php include './footer.php'?>