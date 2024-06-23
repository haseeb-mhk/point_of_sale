<?php
$user_id = $_SESSION['user_id'];
$username = $_SESSION['username'];

// Query to retrieve user's roles
$sql = "SELECT r.RoleName FROM roles r INNER JOIN userroles ur ON r.RoleID = ur.RoleID WHERE ur.UserID = $user_id";
$result = $con->query($sql);

$user_roles = array();
$user_role_p = "";
while ($row = $result->fetch_assoc()) {
    $user_roles[] = $row['RoleName'];
    $user_roles_p = $row['RoleName'];
	
}

// Query to retrieve user's permissions
$sql_user_p = "SELECT p.PermissionName FROM permissions p INNER JOIN rolepermissions rp ON p.PermissionID = rp.PermissionID INNER JOIN roles r ON rp.RoleID = r.RoleID WHERE r.RoleName IN ('" . implode("','", $user_roles) . "')";
$result_user_p = $con->query($sql_user_p);
if($result_user_p){

$user_permissions = array();
while ($row_user_p = $result_user_p->fetch_assoc()) {
//	echo($row_user_p["PermissionName"]);
    $user_permissions[] = $row_user_p['PermissionName'];
}

}

?>

<!--Header-->

<!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
		  
      </li>
   </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     
     
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-plus-circle"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" >
            <i class="fas fa-calendar-alt mr-2"></i> Calender
         
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> To do List
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> Application Tour
          </a>
           </div>
      </li>
<!--		calculator-->
		  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="calculator">
          <i class="fas fa-calculator"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        this is calculator
       
           </div>
      </li>
		<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="POS">
          <i class="fas fa-th-large"></i>
          <span class="badge badge-warning navbar-badge">POS</span>
        </a>
        
      </li>
		<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="Today's Profit">
          <i class="fas fa-money-bill-alt"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        
      </li>
		<li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
         <strong>2/4/2024</strong>
      
        </a>
        
      </li>
       <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" title="calculator">
          <i class="fas fa-user-alt"></i>
          <span class="badge badge-warning navbar-badge"></span>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
        <div class="row">
          <div class="col-md-12">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="dist/img/user2-160x160.jpg"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center"><?php echo($username) ?></h3>

                <p class="text-muted text-center"><?php echo($user_roles_p) ?></p>
				  <hr/>
				  <form method="post" action="logout.php">
		
		<button type="submit" class="btn btn-danger" name="logout" style="margin-left: 80px">LogOut</button>
		
		</form>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

    
            <!-- /.card -->
          </div>
          
          <!-- /.col -->
        </div>
       
           </div>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->


<!--Sidepanel-->

  <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">Admin Panel POS</span>
		
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
           <?php if (in_array('Home', $user_permissions)) { ?>
          <li class="nav-item">
            <a href="index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Home
               
              </p>
            </a>
          </li>
			<?php } ?>	
	 <?php if(in_array('User Management', $user_permissions)) : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                User Management
                <i class="fas fa-angle-left right"></i>
               
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="users.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Users</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="roles.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
            
            </ul>
          </li>
			<?php endif;?>
	<?php if (in_array('Contacts', $user_permissions)) : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-address-book"></i>
              <p>
                Contacts
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="supplier.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Suppliers</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="costumer.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer</p>
                </a>
              </li>
             
            </ul>
          </li>
			<?php endif; ?>
			
			<?php if (in_array('Products', $user_permissions)) : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Products
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Print Barcode labels</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Units</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Categories</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Warranties</p>
                </a>
              </li>
             
            </ul>
          </li>
			<?php  endif; ?>
			
			<?php if (in_array('Purchases', $user_permissions)) : ?>
       
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-arrow-circle-down"></i>
              <p>
                Purchases
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchases List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="Add_purchase.php" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Purchases</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Purchase Returns</p>
                </a>
              </li>
            </ul>
          </li>
			<?php endif; ?>
			<?php if (in_array('Sells', $user_permissions)) : ?>
       
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-arrow-circle-up"></i>
              <p>
                Sells
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>All Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sales</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Quotation</p>
                </a>
              </li>
				<li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quotation List</p>
                </a>
              </li>
				<li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>List Sell Returns</p>
                </a>
              </li>
            </ul>
          </li>
			
			<?php endif; ?>
         <?php if (in_array('Expenses', $user_permissions)) : ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-minus-circle"></i>
              <p>
                Expenses
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pages/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Expensess</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expenses List</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="pages/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expenses Category</p>
                </a>
              </li>
            </ul>
          </li>
			
			<?php endif; ?>
	<?php if (in_array('Reports', $user_permissions)) : ?>
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-bar"></i>
              <p>
                Reports
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profit/loss</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Purchase Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sales Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Expense Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sell Payment Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Product Sell Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Purchase Report</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Costumer Report</p>
                </a>
              </li>
            </ul>
          </li>
		<?php endif; ?>
			
			<?php if (in_array('Documentation', $user_permissions)) : ?>
       
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
      
      <?php endif; ?>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>            