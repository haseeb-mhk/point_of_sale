<?php
include("Includes/Connection.php");
//you have to make some changes in the table calculation it does not work properly



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
                <h3 class="card-title" align="left">Add Purchase</h3><br>
				  
			
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
                 <hr  style="height:2px;border-width:0;color:gray;background-color:gray">
           
                    <div class="row">
                    <div class="col-md-3">
                 <div class="form-group p-0">
                 <button type="button" class="btn btn-primary">Import Product</button>
                      </div>
			 </div>
				
				
              <div class="col-md-6">
              
               <select id="productDropdown" class="form-control select2" style="width: 100%;">
            <option value="" selected disabled>Select a Product</option>
            <!-- PHP code to populate dropdown options -->
            <?php
            // Include your database connection file
            include 'Includes/Connection.php';

            // Fetch product names from database
            $sql = "SELECT * FROM products";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo '<option value="' . $row['product_name'] . '" data-purchase-price="' . $row['purchase_price'] . '">';
    echo $row['product_name'] . ' ' . $row['purchase_price'];
    echo '</option>';
            }
            ?>
        </select>
                     
               
              </div>
              <div class="col-md-3">
                
              <div align="right">
                    
                    <button type="button" class="btn btn-primary btn-sm"  data-toggle="modal" data-target="#myModal"><i class="fa fa-plus"></i>  Add new product</button>
                    
                    </div> 
            </div> 

              <!-- /.card-header -->
              <div class="card-body">
            	<form method="POST" action="#">
    
 
      <table class="table table-bordered table-responsive" id="invoiceTable">
        <thead>
            <tr>
                <th>#</th>
            <th>Product Name</th>
            
            <th>Unit cost (before Discount)</th>
            <th>Discount %</th>
            <th>Unit cost </th>
            <th>Profit Margin % </th>
            <th> Unit selling Price </th>
				<th>Product Quantity</th>
            <th> Line total </th>
			
            <th><i class="fa fa-trash-alt"></i></th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically added here -->
        </tbody>
    </table>
 
   
</form>
				  
		
             
                    
               
              </div>
           
            </div>
		
		</div>
	</div>
	
	  </div>
	
	  
	
</section>
<section class="content">
  <div class="card card-primary card-outline">

  <div class="row"> 
  <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>Discount Type</label>
                      <select class="form-control" name="discount_type" id="">
                      <option value="select">--Please Select--</option>
    <option value="None">None</option>
    <option value="percentage">percentage</option>
    <option value="fixed">fixed</option>
     </select>
                      </div>
               
              </div>
              <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>Discount Amount</label>
                       <input type="number" class="form-control" placeholder="Enter discount amount" name="discount_amount" required>
                      </div>
               
              </div>
              <div class="col-md-4">
                   <div class="form-group p-0">
                      <label></label>
                      Discount:(-) ₨ 0.00
                      </div>
               
              </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>Purchase Tax</label>
                      <select class="form-control" name="purchase_tax" id="">
                      <option value="select">--Please Select--</option>
    <option value="recived">Recived</option>
    <option value="pending">Pending</option>
    <option value="orederd">Orderd</option>
     </select>
                      </div>
               
              </div>
              <div class="col-md-4">
                   <div class="form-group p-0">
                      
                      </div>
               
              </div>
              <div class="col-md-4">
                   <div class="form-group p-0">
                     Purchase Tax(+)Rs:0
                      </div>
               
              </div>
        </div>
        <div class="row">
        <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>Additional Notes</label>
                      <textarea id="" name="additional_notes" rows="4" cols="80">

</textarea>
                      </div>
               
              </div>
              
              
  </div>
        </section>




        <section class="content">
  <div class="card card-primary card-outline">

  <div class="row"> 
  <div class="col-md-6">
                   <div class="form-group p-0">
                      <label>Advance Balance Amount</label>
                      <input type="number" class="form-control" placeholder="Enter amount" name="advance_amount" required>
                      </div>
               
              </div>
              
              <div class="col-md-6">
                   <div class="form-group p-0">
                      <label>Paid On</label>
                      <input type="date" class="form-control" placeholder="Enter date" name="paid_on_date" required>
                      </div>
               
              </div>
        </div>
        
        <div class="row">
        <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>payment Method</label>
                      <select class="form-control" name="payment_method" id="">
                      <option value="select">--Please Select--</option>
    <option value="Check">Check</option>
    <option value="Bank_transfer">Bank transfer</option>
    <option value="other">other</option>
     </select>
                      </div>
               
              </div>
              <div class="col-md-4">
                   <div class="form-group p-0">
                      
                      </div>
               
              </div>
              
        </div>
        <div class="row">
        <div class="col-md-4">
                   <div class="form-group p-0">
                      <label>Payment Notes</label>
                      <textarea id="" name="payments_notes" rows="4" cols="80">

</textarea>
                      </div>
                      
              </div>
              
              
  </div>

  <hr style="height:2px;border-width:0;color:gray;background-color:gray">
  <div align="right">
                    Due Amount :Rs  1220 
                    </div> 
                    <div class="row">
                    <div class="col-sm-12 ">
                      <!-- text input -->
                      <div class="form-group p-0" align="right">
                      <button type="submit" class="btn btn-primary" name="btnuser">Save</button>
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
                <h3 class="card-title" align="left">Add Purchase</h3>
				
			</div>
              <!-- /.card-header -->
              <div class="card-body">
            	
				  
				  <form role="form" method="post" action="">
                  
                  
         
          <!-- /.card-header -->
         
            <div class="row">
              <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Product Name*</label>
                      <input type="varchar" class="form-control" placeholder="Enter product name" name="product_name" required>
                      </div>
               
              </div>
				
             <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Barcode Type</label>
                      <select class="form-control" name="barcode_type" id="">
                      <option value="select">--Please Select--</option>
  <option value="c128">code 128(c128)</option>
  <option value="c39">code 39(c 39)</option>
  <option value="EAN-13">EAN-13</option>
  <option value="EAN-8">EAN-8</option>
  <option value="UPC-A">UPC-A</option>
  <option value="UPC-E">UPC-E</option>
</select>
                      </div>
			 </div>
				</div>
				
					<div class="row">
                    <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Product quantity*</label>
                    <input type="varchar" class="form-control" placeholder="Enter product name" name="product_quantity" required>
                      </div>
			 </div>
				
				<div class="col-md-6">
                <div class="form-group p-0">
                      <label>Brand</label>
                      <select class="form-control" name="brands" id="">
                      <option value="select">--Please Select--</option>
    <option value="recived">Recived</option>
    <option value="pending">Pending</option>
    <option value="orederd">Orderd</option>
     </select>
                      </div>
               
              </div>
           
            </div>
                 
					  

            <div class="row">
                    <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Category*</label>
                      <select class="form-control" name="category" id="" value="plx">
                      <option value="select">--Please Select--</option>
  <option value="PCS">PCS</option>
  <option value="Yord">Yord</option>
  
</select>
                      </div>
			 </div>
				
				<div class="col-md-6">
               <div class="form-group p-0">
                      <label>Alert quantity*</label>
                      <input type="number" class="form-control" placeholder="Enter Alert quantity" name="A_quantity" required>
                      </div>
               
              </div>
           
            </div>
                 
				
          
            <div class="row">
                    <div class="col-md-6">
                 <div class="form-group p-0">
                      <label>Product Description*</label>
                      <textarea id="w3review" name="product_Description" rows="4" cols="60" class="form-control"></textarea>
                      </div>
			 </div>
				
				
           
            </div>

     


            <div class="row">
                    <div class="col-md-4">
                 <div class="form-group p-0">
                      <label>Purchase price</label>
                      <input type="number" class="form-control" placeholder="exc.tax" name="exc_tax" required>
                      </div>
			 </div>
				
				
              <div class="col-md-4">
                <div class="form-group p-0">
                      <label>Margin</label>
                      <input type="number" class="form-control" placeholder="margin" name="margin" required>
                      </div>
               
              </div>
              <div class="col-md-4">
                <div class="form-group p-0">
                      <label>Selling Price</label>
                       <input type="number" class="form-control" placeholder="exc tax" name="exc_tac" required>
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
	  
<script>
	$(document).ready(function() {
    var i = 0;

    // Bind event listener to dropdown selection change
    $('#productDropdown').on('change', function() {
        var selectedOption = $(this).find('option:selected');
        var selectedProductName = selectedOption.val();
        var selectedProductPrice = selectedOption.data('purchase-price');

        if (selectedProductName) {
            var newRow = `<tr>
                <td>${++i}</td>
                <td>${selectedProductName}</td>
                <td><input type="number" class="form-control product-price" name="product_price[]" value="${selectedProductPrice}"></td>
                <td><input type="number" class="form-control discount" name="discount[]" value="0.00"></td>
                <td><input type="text" class="form-control unit-cost" name="unit_cost[]" value="${selectedProductPrice}" readonly></td>
                <td><input type="number" class="form-control profit-margin" name="profit_margin[]" value="10.0"></td>
                <td><input type="text" class="form-control unit-selling-price" name="unit_selling_price[]" value="${selectedProductPrice}" readonly></td>
                <td><input type="number" class="form-control quantity" name="quantity[]" value="0.0" required></td>
                <td><input type="text" class="form-control line-total" name="line_total[]" value="0.00" ></td>
                <td><i class="fas fa-times" style="font-size: 24px; color: red;" onclick="removeRow(this)"></i></td>
            </tr>`;

            $('#invoiceTable tbody').append(newRow);

            // Trigger change event for the input fields of the previous row
            $('#invoiceTable tbody tr:last').prev().find('input').trigger('change');
        }
    });

    // Function to remove a row from the table
    window.removeRow = function(btn) {
        $(btn).closest('tr').remove();
    };

    // Event listener for input fields change
    $('#invoiceTable').on('change', 'input', function() {
        var row = $(this).closest('tr');
        var productPrice = parseFloat(row.find('.product-price').val());
        var discountPercent = parseFloat(row.find('.discount').val());
        var unitCost = productPrice * (1 - discountPercent / 100);
        row.find('.unit-cost').val(unitCost.toFixed(2));

        var profitMarginPercent = parseFloat(row.find('.profit-margin').val());
        var unitSellingPrice = unitCost * (1 + profitMarginPercent / 100);
        row.find('.unit-selling-price').val(unitSellingPrice.toFixed(2));

        var quantity = parseFloat(row.find('.quantity').val());
        var lineTotal = unitSellingPrice * quantity;
        row.find('.line-total').val(lineTotal.toFixed(2));
    });
});





	  // Function to remove a row from the table
  function removeRow(btn) {
        $(btn).closest('tr').remove();
    }
</script>	  

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>	  
</body>
</html>
