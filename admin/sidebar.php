<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="./assets/dist/user-image.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>
          <?php if(isset($_SESSION['login'])){
                echo $_SESSION['login']['name'];
              }?>
        </p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu" data-widget="tree">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="index.php" class="">
          <i class="fa fa-th"></i> <span>Dashboard</span>
          <span class="pull-right-container">
            <small class="label pull-right bg-green">new</small>
          </span>
        </a>
      </li>
      <li class="active">
        <a href="cart-management.php">
          <i class="fa fa-dashboard"></i> Cart Management<span></span>
        </a>
      </li>
      <li class="active treeview">
        <a style="cursor: pointer">
          <i class="fa fa-dashboard"></i> <span>Category</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="list-category.php"><i class="fa fa-circle-o"></i> List
              Category</a></li>
          <li><a href="add-category.php"><i class="fa fa-circle-o"></i> Add
              Category</a></li>
        </ul>
      </li>
      <li class="active treeview">
        <a style="cursor: pointer">
          <i class="fa fa-dashboard"></i> <span>Product</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="list-product.php"><i class="fa fa-circle-o"></i> List
              Product</a></li>
          <li><a href="add-product.php"><i class="fa fa-circle-o"></i> Add
              Product</a></li>
        </ul>
      </li>

    </ul>
  </section>
  <!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
      <small>Version 2.0</small>
    </h1>
    <ol class="breadcrumb">
      <li class="active">Dashboard</li>
    </ol>
  </section>