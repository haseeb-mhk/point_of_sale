<?php
include("Includes/Connection.php");
$sql = "SELECT * FROM Permissions order by PermissionID ASC";
$result = $con->query($sql);

$permissions = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $permissions[] = $row;
    }
}




?>

<?php
if(isset($_GET["DID"])){
    $did = $_GET["DID"];
?>
    <script>
        var confirmation = confirm("Are you sure you want to delete this record?");
        if (confirmation) {
            // Redirect to the same page with confirmedDelete parameter
            window.location.href = "roles.php?confirmedDelete=<?php echo $did; ?>";
        }
    </script>
<?php
}

if(isset($_GET["confirmedDelete"])){
    $did = $_GET["confirmedDelete"];
    $delete_query  = mysqli_query($con, "DELETE FROM roles WHERE roleid='$did'");
    if($delete_query){
        echo("<script> alert('Data deleted successfully') </script>");
    }
}
?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Home | Roles</title>
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
			  
			   Roles 
				 <small style="font-size: 15px;font-weight: lighter">Manage Roles</small>
			  
			  
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
                <h3 class="card-title" align="left">All Roles</h3>
				  <div align="right">
				  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>  Add</button>
				  
				  </div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <table id="example1" class="table table-bordered table-striped">
                  <thead>
					
                  <tr>
                   
                    <th>Roles</th>
                    <th>Actions</th>
                    
                  </tr>
                  </thead>
                  <tbody>
					  
					    <?php
					  $select = mysqli_query($con,"select * from roles");
							
				while($row = mysqli_fetch_array($select)){
					  $roleid = $row["roleid"];
					  ?>
		<tr>
					  <td><?php echo($row["rolename"]); ?></td>
					  <td><a href="#" class="btn btn-success btn-sm"> Edit</a>
			<a href="roles.php?DID=<?php echo($roleid)?>" class="btn btn-danger btn-sm ml-2"> Delete</a>
			</td>
					 
					  
					  </tr>
					  
					  <?php } ?>
                  </tbody>
                  <tfoot>
                  <tr>
                  <th>Roles</th>
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
                <h3 class="card-title" align="left">Add Role</h3>
				
			</div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <form role="form" method="post" action="user_role.php">
                  <div class="row">
                    <div class="col-sm-6 p-0">
                      <!-- text input -->
                      <div class="form-group p-0">
                      <label>Name</label>
                       <input type="text" class="form-control" placeholder="Enter Roll Name" name="role_name" required>
                      </div>
                    </div>
                   
                  </div>
                  <hr/>
                  <div class="row">
                    <div class="col-sm-6">
						<label>Permissions:</label>
						<hr/>
						
					<div class="ml-2">
                      <!-- checkbox -->
                      <?php foreach ($permissions as $permission) : ?>
						<input type="checkbox" class="form-check-input" name="permissions[]" value="<?php echo $permission['PermissionID']; ?>">
            <label class="form-check-label"><?php echo $permission['PermissionName']; ?></label><br>

						
        <?php endforeach; ?>
						</div>
                    </div> 
                  </div>
<br>

                   <div class="row">
                    <div class="col-sm-12 ">
                      <!-- text input -->
                      <div class="form-group p-0">
                      <button type="submit" class="btn btn-primary" name="btnrole">Save</button>
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
