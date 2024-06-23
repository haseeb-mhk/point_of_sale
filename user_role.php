<?php
include("Includes/Connection.php");


if(isset($_POST["btnrole"])){
	
	$role_name = $_POST['role_name'];

    // Insert new role into Roles table
    $sql = "INSERT INTO roles (roleName) VALUES ('$role_name')";
    if ($con->query($sql) === TRUE) {
        $role_id = $con->insert_id; // Get the ID of the newly inserted role
        // Insert role permissions into RolePermissions table
        if (!empty($_POST['permissions'])) {
            foreach ($_POST['permissions'] as $permission_id) {
                $sql = "INSERT INTO RolePermissions (RoleID, PermissionID) VALUES ('$role_id', '$permission_id')";
//				echo($permission_id);
                $con->query($sql);
            }
        }
        echo "Role created successfully.";
		header("location:roles.php");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
}

if(isset($_POST["btnuser"])){
	$fullname = $_POST["full_name"];
	$useremail = $_POST["user_email"];
	$username = $_POST["user_name"];
	$userpass = $_POST["user_pass"];
	$userrole_id = $_POST["user_role"];
	if (isset($_POST['user_status'])) {
  $user_status = $_POST['user_status'];
}else{
		$user_status = "InActive";
	}

	$sql = "INSERT INTO Users (fullname,username,useremail,userpassword,status ) VALUES ('$fullname', '$username','$useremail','$userpass','$user_status')";
    if ($con->query($sql) === TRUE) {
        $user_id = $con->insert_id; // Get the ID of the newly inserted user
        // Insert user roles into UserRoles table
        if (!empty($_POST['user_role'])) {
          $sql = "INSERT INTO userroles (UserID, RoleID) VALUES ('$user_id', '$userrole_id')";
                $con->query($sql);
            
        }
        echo "User created successfully.";
		header("location:users.php");
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
	
	
	
	
}
?>