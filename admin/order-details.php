<?php 
    include './header.php';
    ob_start();
    // kiểm tra session tồn tại hay không 
    if(!isset($_SESSION["login"])){
      header('Location: ./login.php');
    }
    if(isset($_GET['id'])){
        $id = $_GET['id'];
        $list = mysqli_query($conn,"SELECT * FROM order_detail WHERE order_detail.id_order = '$id'");
        $order = mysqli_query($conn,"SELECT orders.id, orders.id_user , orders.total_price , orders.address_ship , orders.phone , orders.note , orders.status , orders.created_at , user.name AS 'customer_name' , user.email FROM orders JOIN user ON orders.id_user = user.id WHERE orders.id = '$id'");
        $order = mysqli_fetch_assoc($order);

    }
   
?>
<?php include './sidebar.php'?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
            Invoice
            <small>#<?php echo $order['id'] ?></small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="#">Examples</a></li>
            <li class="active">Invoice</li>
        </ol>
    </section>

    <div class="pad margin no-print">
        <div class="callout callout-info" style="margin-bottom: 0!important;">
            <h4><i class="fa fa-info"></i> Note:</h4>
            <?php echo $order['note'] ?>.
        </div>
    </div>

    <!-- Main content -->
    <section class="invoice">
        <!-- title row -->
        <div class="row">
            <div class="col-xs-12">
                <h2 class="page-header">
                    <i class="fa fa-globe"></i> AdminLTE, Inc.
                    <small class="pull-right">Date: <?php echo $order['created_at'] ?></small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-4 invoice-col">
                From
                <address>
                    <strong>Omato Market</strong><br>
                    236 Hoang Quoc Viet, Nam Tu Liem, Ha Noi<br>
                    Phone: (84+) 971976699<br>
                    Email: omatomarket@gmail.com
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                To
                <address>
                    <strong><?php echo $order['customer_name'] ?></strong><br>
                    <?php echo $order['address_ship'] ?><br>
                    Phone: <?php echo $order['phone'] ?><br>
                    Email: <?php echo $order['email'] ?>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col">
                <b>Invoice #<?php echo $order['id'] ?></b><br>
                <br>
                <b>Order ID:</b> <?php echo $order['id'] ?><br>
                <b>Payment Due:</b> <?php echo $order['created_at'] ?><br>
                <b>Account:</b> <?php echo $order['id_user'] ?>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- Table row -->
        <div class="row">
            <div class="col-xs-12 table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Qty</th>
                            <th>Product Name</th>
                            <th>Image</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($list as $key => $value ){ ?>
                            <tr>
                                <td><?php echo $value['quantity'] ?></td>
                                <td><?php echo $value['name'] ?></td>
                                <td><img src="../uploads/<?php echo $value['image'] ?>" alt="" width="10%"></td>
                                <td>$ <?php echo $value['price'] ?></td>
                                <td>$ <?php echo $value['price']*$value['quantity'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <div class="row">
            <!-- accepted payments column -->
            <div class="col-xs-6">
                <p class="lead">Payment Methods:</p>
                <img src="./assets/dist/img/credit/visa.png" alt="Visa">
                <img src="./assets/dist/img/credit/mastercard.png" alt="Mastercard">
                <img src="./assets/dist/img/credit/american-express.png" alt="American Express">
                <img src="./assets/dist/img/credit/paypal2.png" alt="Paypal">

                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem
                    plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra.
                </p>
            </div>
            <!-- /.col -->
            <div class="col-xs-6">
                <p class="lead">Amount Due 2/22/2014</p>

                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th style="width:50%">Subtotal:</th>
                                <td>$ <?php echo $order['total_price'] ?></td>
                            </tr>
                            <tr>
                                <th>Shipping:</th>
                                <td>$0.00</td>
                            </tr>
                            <tr>
                                <th>Total:</th>
                                <td>$ <?php echo $order['total_price'] ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->

        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-xs-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fa fa-print"></i>
                    Print</a>
                <button type="button" class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Submit
                    Payment
                </button>
                <button type="button" class="btn btn-primary pull-right" style="margin-right: 5px;">
                    <i class="fa fa-download"></i> Generate PDF
                </button>
            </div>
        </div>
    </section>
    <!-- /.content -->
    <div class="clearfix"></div>

</div>

<?php include './footer.php'?>