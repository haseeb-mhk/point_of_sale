<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Page</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Select2 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
</head>
<body>

<div class="container">
    <h2>Invoice</h2>
    <!-- Searchable dropdown -->
    <div class="input-group mb-3">
        <!-- Add button to the left of the dropdown -->
        <div class="input-group-prepend">
            <button class="btn btn-primary" type="button" onclick="addNewProduct()">Add New Product</button>
        </div>
        <select id="productDropdown" class="form-control select2" style="width: 100%;">
            <option value="" selected disabled>Select a Product</option>
            <!-- PHP code to populate dropdown options -->
            <?php
            // Include your database connection file
            include 'Includes/Connection.php';

            // Fetch product names from database
            $sql = "SELECT productName FROM products_table";
            $result = mysqli_query($con, $sql);
            while($row = mysqli_fetch_assoc($result)) {
                echo "<option value='" . $row['productName'] . "'>" . $row['productName'] . "</option>";
            }
            ?>
        </select>
    </div>
    
    <!-- Invoice table -->
    <table class="table table-bordered" id="invoiceTable">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Quantity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <!-- Table rows will be dynamically added here -->
        </tbody>
    </table>

    <!-- Button to insert products into database -->
    <button class="btn btn-success" onclick="insertProducts()">Insert Products into Database</button>
</div>

<!-- Bootstrap JS -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<!-- Select2 JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

<script>
$(document).ready(function() {
    // Initialize Select2
    $('.select2').select2();

    // Bind event listener to dropdown selection change
    $('#productDropdown').on('change', function() {
        var selectedProduct = $(this).val();
        if (selectedProduct) {
            var newRow = `<tr>
                            <td>${selectedProduct}</td>
                            <td><input type="number" class="form-control" name="quantity[]"></td>
                            <td><button class="btn btn-danger" onclick="removeRow(this)">Remove</button></td>
                          </tr>`;
            $('#invoiceTable tbody').append(newRow);
        }
    });
});

// Function to remove a row from the table
function removeRow(btn) {
    $(btn).closest('tr').remove();
}

// Function to add a new product
function addNewProduct() {
    var newProductName = prompt("Enter the name of the new product:");
    if (newProductName) {
        // Add the new product to the dropdown
        $('#productDropdown').append($('<option>', {
            value: newProductName,
            text: newProductName
        }));
        // Select the newly added product
        $('#productDropdown').val(newProductName).trigger('change');
    }
}

// Function to insert products into database
function insertProducts() {
    var products = [];
    $('#invoiceTable tbody tr').each(function() {
        var productName = $(this).find('td:first-child').text();
        var quantity = $(this).find('input[name="quantity[]"]').val();
        products.push({
            productName: productName,
            quantity: quantity
        });
    });

    // Send data to server using AJAX
    $.ajax({
        type: 'POST',
        url: 'insert_products.php', // Specify your PHP file to handle the insertion
        data: { products: products },
        success: function(response) {
            alert(response); // Show a message indicating success or failure
            window.location.href = "invoice_table.php";
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
}
</script>

</body>
</html>
