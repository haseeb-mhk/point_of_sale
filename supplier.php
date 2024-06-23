<?php
include("Includes/Connection.php");

if(isset($_POST["btnsupplier"])){
	$name = $_POST["name"];
	$email = $_POST["email"];
	$contact = $_POST["contact_number"];
	$address = $_POST["address"];
	$notes = $_POST["notes"];
	
	$insert_supplier = mysqli_query($con,"INSERT INTO `suppliers`( `SupplierName`, `Email`, `Phone`, `Address`, `Notes`) VALUES ('$name','$email','$contact','$address','$notes')");
	if($insert_supplier){
		
		
		echo("data inserted successfully");
	}
	else{
		echo(mysqli_errno($insert_supplier));
	}
}


?>

<?php
//if(isset($_GET["DID"])){
//    $did = $_GET["DID"];
?>
    <script>
//        var confirmation = confirm("Are you sure you want to delete this record?");
//        if (confirmation) {
//            // Redirect to the same page with confirmedDelete parameter
//            window.location.href = "users.php?confirmedDelete=<?php echo $did; ?>";
//        }
    </script>
<?php
//}
//
//if(isset($_GET["confirmedDelete"])){
//    $did = $_GET["confirmedDelete"];
////	echo($did);
//    $delete_query  = mysqli_query($con, "DELETE FROM users WHERE userid='$did'");
//    if($delete_query){
//		
////		echo("Data deleted from the table");
//        echo("<script> alert('Data deleted successfully') </script>");
//    }
//	else{
//		echo(mysqli_errno($delete_query));
//	}
//}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | Suppliers </title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--This link is only for those pages which contain the datatables-->
	<?php  include("Includes/dtlinks.php") ?>

<style>
    @media screen and (min-width: 676px) {
        .modal-dialog {
          max-width: 700px; /* New width for default modal */
        }
    }
</style>	
	
</head>
	
	
<body class="hold-transition sidebar-mini">
<div class="wrapper">
	
 <?php include('Includes/sidepanel.php')?>
  <!-- Navbar -->
  
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
			 <h1>
			  
			 Suppliers
				 <small style="font-size: 15px;font-weight: lighter">Manage your Suppliers</small>
			  
			  
			  </h1>
		  
			
            
          </div><!-- /.col -->
         
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
  <section class="content">
<!-- this is main content -->
	<div class="row">
	
	<div class="col-12">
		<div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title" align="left">All Suppliers</h3>
				  <div align="right">
				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>  Add</button>
				  
				  </div></div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <table id="example1" class="table table-bordered table-striped">
                  <thead>
					
                  <tr>
                   
                  <th>First Name</th>
                    <th> Last Name</th>
                    <th>Contact Number </th>
                    <th>Address</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
					  
					    <?php
					  $select = mysqli_query($con,"SELECT users.userid, users.fullname, users.username, users.useremail, roles.rolename
FROM users
INNER JOIN userroles ON users.userid = userroles.UserID
INNER JOIN roles ON userroles.RoleID = roles.roleid;
");
							
				while($row = mysqli_fetch_array($select)){
					  $userid = $row["userid"];
					
					  ?>
		<tr>
					  <td><?php echo($row["username"]); ?></td>
					  <td><?php echo($row["fullname"]); ?></td>
					  <td><?php echo($row["rolename"]); ?></td>
					  <td><?php echo($row["useremail"]); ?></td>
					  <td><a href="#" class="btn btn-success btn-sm"> Edit</a>
			<a href="users.php?DID=<?php echo($userid)?>" class="btn btn-danger btn-sm ml-2"> Delete</a>
			</td>
					 
					  
					  </tr>
					  
					  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                 <th>First Name</th>
                    <th> Last Name</th>
                    <th>Contact Number </th>
                    <th>Address</th>
                    <th>Actions</th>
                   
                  </tr>
                  </tfoot>
                </table>


              </div>
           
            </div>
		
		</div>
	</div>
	
	  </div>
	
	
	
</section>
    <!-- /.content -->
<!-- modal start -->

	  <div class="row">
	  
	  <div class="col-12">
		  
	  <div id="myModal" class="modal fade" role="dialog" style="width: 100%">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body">
       <div class="row">
	
	<div class="col-12">
		<div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title" align="left">Add Suppliers</h3>
				 <button type="button" class="close" data-dismiss="modal">&times;</button>
			</div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <form role="form" method="post" action="">
                  
                  
         
          <!-- /.card-header -->
         
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group p-0">
                      <label> Name*</label>
                       <input type="text" class="form-control" placeholder="Enter Supplier Name" name="name" required>
                      </div>
               
              </div>
				 <div class="col-md-6">
                <div class="form-group p-0">
                      <label>Email</label>
                       <input type="email" class="form-control" placeholder="Enter supplier email" name="email" >
                      </div>
				
                
             
           
            </div>
				</div>
					  
					<div class="row">
              <div class="col-md-6">
                   <div class="form-group p-0">
                      <label>Contact Number</label>
                       <input type="number" class="form-control" placeholder="Enter Contact number" name="contact_number" >
                      </div>
               
              </div> 
				<div class="col-md-6">
                <div class="form-group p-0">
                      <label>Address</label>
                       <input type="text" class="form-control" placeholder="Enter Supplier address" name="address" >
                      </div>
               
              </div>
           
            </div>
                 
					  
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Notes</label>
                      <textarea class="form-control" placeholder="Enter additional information" name="notes"></textarea>
                      </div>
               
              </div>
				
       
				
                
             
           
            </div>
				</div>
        
			
                   <div class="row">
                    <div class="col-sm-12 ">
                      <!-- text input -->
                      <div class="form-group ml-2">
                      <button type="submit" class="btn btn-primary" name="btnsupplier">Save</button>
                      </div>
                    </div>
                   
                  </div>
                </form>


              </div>
           
            </div>
		
		</div>
	</div>
	
	  </div>
      </div>
     
    </div>

  </div>
</div>
		  </div>
	  
	  </div>
	  
<!-- /. modal start -->
	  
  </div>
  <!-- /.content-wrapper -->
<?php include("Includes/dtscript.php") ?>
</body>
</html>
