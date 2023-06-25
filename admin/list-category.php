<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    $list = mysqli_query($conn,"SELECT * FROM category");
?>
<?php include './sidebar.php'?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title" style="font-weight: bold">List Category</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <?php if(isset($_SESSION['delete'])){ ?>    
               <div class="alert alert-danger">
                   <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                   <strong>Title!</strong><?php echo $_SESSION["delete"]?>.
               </div>
               <?php unset($_SESSION['delete']); ?>
            <?php } ?>
            <table class="table" id="my-table">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Name Category</th>
                        <th>Status</th>
                        <th style="width: 20%">Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $value ){ ?>
                    <tr>
                        <td>
                            <?php echo $key + 1 ?>
                        </td>
                        <td>
                            <?php echo $value['name'] ?>
                        </td>
                        <?php if($value["status"] == 1){ ?>
                        <td>
                            <p class="badge bg-green">Show</p>
                        </td>
                        <?php }else{ ?>
                        <td>
                            <p class="badge bg-yellow">Hidden</p>
                        </td>
                        <?php } ?>
                        <td>
                            <a href="./edit-category.php?id=<?php echo $value['id'] ?>"><i class="fa fa-pencil-square text-info" style="font-size: 20px" aria-hidden="true"></i></a>
                            <a href="./delete-category.php?id=<?php echo $value['id'] ?>"><i class="fa fa-trash text-danger" style="font-size: 20px" aria-hidden="true"></i></a>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './footer.php'?>