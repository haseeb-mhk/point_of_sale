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
  <title>Home | Users </title>
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
			  
			   Users 
				 <small style="font-size: 15px;font-weight: lighter">Manage Users</small>
			  
			  
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
                <h3 class="card-title" align="left">All Users</h3>
				  <div align="right">
				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>  Add</button>
				  
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
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
       
      </div>
      <div class="modal-body">
       <div class="row">
	
	<div class="col-12">
		<div class="card card-primary card-outline">
              <div class="card-header">
                <h3 class="card-title" align="left">Add Users</h3>
				
			</div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <form role="form" method="post" action="user_role.php">
                  
                  
         
          <!-- /.card-header -->
         
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Name *</label>
                       <input type="text" class="form-control" placeholder="Enter User Name" name="full_name" required>
                      </div>
               
              </div>
				 <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Email</label>
                       <input type="email" class="form-control" placeholder="Enter User Email" name="user_email" required>
                      </div>
				
                
             
           
            </div>
				</div>
					  
					<div class="row">
              <div class="col-md-6">
                   <div class="form-group p-0">
                      <label>User Name*</label>
                       <input type="text" class="form-control" placeholder="Enter User Email" name="user_name" required>
                      </div>
               
              </div> 
				<div class="col-md-6">
                <div class="form-group p-0">
                      <label>Password*</label>
                       <input type="text" class="form-control" placeholder="Enter User Password" name="user_pass" required>
                      </div>
               
              </div>
           
            </div>
                 
					  

        <div class="row">
              <div class="col-md-6">
                 <div class="form-group">
                  <label>Role</label>
                  <select class="form-control " style="width: 100%;" name="user_role">
                    <option selected="selected">Select role</option>
					  
					  <?php
					  
					 $roles = mysqli_query($con,"Select * from roles");
					  while($row_roles = mysqli_fetch_array($roles)){
					  ?>
					  
                    <option value="<?php echo($row_roles['roleid'])?>"><?php  echo($row_roles['rolename']); ?></option>
                    <?php  } ?>
                  </select>
                </div>
               
              </div> 
				<div class="col-md-6 mt-4">
					<div class="row">
					<div class="col-4">
						<label> Status:</label>
						</div>
						
						
						<div class="col-6">
								
                <input type="checkbox" class="form-check-input" name="user_status" value="Active" >
            <label class="form-check-label">Active</label>
						</div>
					</div>
			
               
              </div>
           
            </div>

                   <div class="row">
                    <div class="col-sm-12 ">
                      <!-- text input -->
                      <div class="form-group p-0">
                      <button type="submit" class="btn btn-primary" name="btnuser">Save</button>
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
