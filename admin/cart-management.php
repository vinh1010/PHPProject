<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    $list = mysqli_query($conn,"SELECT orders.id , orders.total_price , orders.address_ship , orders.phone , orders.note , orders.status , orders.created_at , user.name AS 'customer_name' FROM orders JOIN user ON orders.id_user = user.id");
?>
<?php include './sidebar.php'?>
    <div class="box">
        <div class="box-header">
            <h3 class="box-title" style="font-weight: bold">List Orders</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body no-padding">
            <?php if(isset($_SESSION['errors'])){ ?>    
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Title!</strong><?php echo $_SESSION["errors"]?>.
                </div>
                <?php unset($_SESSION['errors']); ?>
            <?php } ?>
            <?php if(isset($_SESSION['complate'])){ ?>    
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong>Title!</strong><?php echo $_SESSION["complate"]?>.
                </div>
                <?php unset($_SESSION['complate']); ?>
            <?php } ?>
            <table class="table" id="my-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name Customer</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Status</th>
                        <th>Total Price</th>
                        <th>Created At</th>
                        <th>Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($list as $key => $value ){ ?>
                    <tr>
                        <td>
                            <?php echo $value['id'] ?>
                        </td>
                        <td>
                            <?php echo $value['customer_name'] ?>
                        </td>
                        <td>
                            <?php echo $value['address_ship']?>
                        </td>
                        <td>
                            <?php echo $value['phone']?>
                        </td>
                        <?php if($value["status"] == 1){ ?>
                            <td>
                                <p class="badge bg-red">Waiting for processing</p>
                            </td>
                        <?php } else if($value["status"] == 2){ ?>
                            <td>
                                <p class="badge bg-yellow">Confirmed</p>
                            </td>
                        <?php } else if($value["status"] == 3){ ?>
                            <td>
                                <p class="badge bg-blue">Delivery</p>
                            </td>
                        <?php } else if($value["status"] == 4){ ?>
                            <td>
                                <p class="badge bg-green">Complete</p>
                            </td> 
                        <?php }else{ ?>
                            <td>
                                <p class="badge bg-gray">Canceled</p>
                            </td>  
                        <?php } ?>
                        <td style="font-weight: bold">
                            $ <?php echo $value['total_price']?>
                        </td>
                        <td>
                            <?php echo $value['created_at']?>
                        </td>
                        <td>
                            <span style="display: flex;" class="reason">
                                <a href="./order-details.php?id=<?php echo $value['id'] ?>" title="View"><i class="fa fa-eye" style="font-size: 20px;margin-top: 5px" aria-hidden="true"></i></a>
                                <form method="POST" id="form" action="update-status-order.php">
                                    <input type="hidden" name="id" value="<?php echo $value['id'] ?>">         
                                    <div class="dropdown" style="margin-left: 20px">
                                        <p class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">Action</p>
                                        <ul class="dropdown-menu">
                                            <li><button type="submit" name="value" value="2"><i class="fa fa-check-circle" aria-hidden="true"></i> Confirmed</button></li>
                                            <li><button type="submit" name="value" value="3"><i class="fa fa-truck" aria-hidden="true"></i> Delivery</button></li>
                                            <li><button type="submit" name="value" value="4"><i class="fa fa-credit-card" aria-hidden="true"></i> Accomplished</button></li>
                                            <li><button type="submit" name="value" value="5"><i class="fa fa-times-circle" aria-hidden="true"></i> Cancel</button></li>
                                        </ul>
                                    </div>
                                </form>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include './footer.php'?>