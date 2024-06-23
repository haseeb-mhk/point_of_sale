<?php
include("Includes/Connection.php");




?>

<?php
if(isset($_GET["DID"])){
    $did = $_GET["DID"];
?>
    <script>
        var confirmation = confirm("Are you sure you want to delete this record?");
        if (confirmation) {
            // Redirect to the same page with confirmedDelete parameter
            window.location.href = "users.php?confirmedDelete=<?php echo $did; ?>";
        }
    </script>
<?php
}

if(isset($_GET["confirmedDelete"])){
    $did = $_GET["confirmedDelete"];
//	echo($did);
    $delete_query  = mysqli_query($con, "DELETE FROM users WHERE userid='$did'");
    if($delete_query){
		
//		echo("Data deleted from the table");
        echo("<script> alert('Data deleted successfully') </script>");
    }
	else{
		echo(mysqli_errno($delete_query));
	}
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | purchase </title>
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
			  
			   Purchase 
				 <small style="font-size: 15px;font-weight: lighter">Manage Purchase</small>
			  
			  
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
                <h3 class="card-title" align="left">All Purchases</h3>
				  <div align="right">
					  <form method="post" action="Add_purchase.php">
				  <button type="submit" class="btn btn-primary" ><i class="fa fa-plus"></i>  Add</button>
				  </form>
				  </div></div>
<!--
                  <div class="row">
              <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Supplier</label>
                      <select class="form-control"  name="supplier" id="">
                      <option value="select">--Please Select--</option>
    <option value="recived">Recived</option>
    <option value="pending">Pending</option>
    <option value="orederd">Orderd</option>
     </select>
                      </div>
               
              </div>
				 <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Refernce Number</label>
                       <input type="varchar" class="form-control" placeholder="Enter Reference number" name="refrence_number" required>
                      </div>
				
                
             
           
            </div>
				</div>
-->
					  
<!--
					<div class="row">
              <div class="col-md-6">
                   <div class="form-group p-0">
                      <label>Purchase Date</label>
                       <input type="date" class="form-control" placeholder="Enter date" name="date" required>
                      </div>
               
              </div> 
				<div class="col-md-6">
                <div class="form-group p-0">
                      <label>Purchase  Status</label>
                      <select class="form-control" name="purchase_status" id="">
                      <option value="select">--Please Select--</option>
    <option value="recived">Recived</option>
    <option value="pending">Pending</option>
    <option value="orederd">Orderd</option>
     </select>
                      </div>
               
              </div>
           
            </div>
-->
<!--                 <hr  style="height:2px;border-width:0;color:gray;background-color:gray">-->
           
                    <div class="row">
                 
				
				
             
              <div class="col-md-3">
                
            
            </div> 

              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <table id="example1" class="table table-bordered table-striped">
                  <thead>
					
                  <tr>
                   
                    <th>User Name</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
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
                 <th>User Name</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Email</th>
                    <th>Actions</th>
                   
                  </tr>
                  </tfoot>
                </table>
                <hr  style="height:2px;border-width:0;color:gray;background-color:gray">
                <div align="right">
                    
                 Total Amount : 0
                    
                    </div> 
                    <div align="right">
                    Net Total Amount : 0 
                    </div> 
              </div>
           
            </div>
		
		</div>
	</div>
	
	  </div>
	
	  
	
</section>

	  
<!-- /. modal start -->
	  
  </div>
  <!-- /.content-wrapper -->
<?php include("Includes/dtscript.php") ?>
</body>
</html>
