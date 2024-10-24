<?php
require('dbinit.php');
include('header.php');

// Initialize error variables
$cellphoneerror = '';
$cellPhoneDescriptionError = '';
$priceError = ''; 
$quantityError = '';
$companyError = '';

if (isset($_POST['submit'])) {
    // Validate cell phone name
    if (!empty($_POST['txtCellPhoneName'])) {
        $cellPhoneName = mysqli_real_escape_string($conn, trim($_POST['txtCellPhoneName']));
    } else {
        $cellPhoneName = null;
        $cellphoneerror = "Cell Phone name is required!!";
    }

    // Validate cell phone description
    if (!empty($_POST['txtCellPhoneDescription'])) {
        $cellPhoneDescription = mysqli_real_escape_string($conn, trim($_POST['txtCellPhoneDescription']));
    } else {
        $cellPhoneDescription = null;
        $cellPhoneDescriptionError = "Cell Phone description is required!!";
    }

    // Validate price
    if (empty($_POST['txtPrice']) || !is_numeric($_POST['txtPrice'])) {
        $priceError = "Please enter a valid price";
    } else {
        $price = mysqli_real_escape_string($conn, trim($_POST['txtPrice']));
    }

    // Validate quantity
    if (empty($_POST['txtQuantity']) || !is_numeric($_POST['txtQuantity'])) {
        $quantityError = "Please enter a valid quantity";
    } else {
        $quantity = mysqli_real_escape_string($conn, trim($_POST['txtQuantity']));
    }

    // Validate company selection
    if (empty($_POST['CellPhoneCompany'])) {
        $companyError = "Please select a company";
    } else {
        $company = mysqli_real_escape_string($conn, $_POST['CellPhoneCompany']);
    }

    // Insert query
    if (empty($cellphoneerror) && empty($cellPhoneDescriptionError) && empty($priceError) && empty($quantityError) && empty($companyError)) {
        $sql = "INSERT INTO cellphone (CellPhoneName, cellPhoneDescription, QuantityAvailable, Price, ProductAddedBy, CellPhoneCompany) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            $ProductAddedBy = "Aditya Mahajan";
            mysqli_stmt_bind_param($stmt, "ssdiss", $cellPhoneName, $cellPhoneDescription, $quantity, $price, $ProductAddedBy, $company);
            $result = mysqli_stmt_execute($stmt);
            
            if ($result) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error: Could not execute query.";
            }
            
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    } else {
        echo '<span style="color: orange;">Please enter all details!</span>';
    }

    mysqli_close($conn);
}

function is_text_only($input_value) {
    return preg_match("/^[a-zA-Z- ]*$/", $input_value);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Cell Phones</title>
    <link rel="stylesheet" href="style.css" type="text/css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add Cell Phone</h2>
    <form method="POST" action="addCellPhones.php">
        <div class="form-group row">
            <label for="txtCellPhoneName" class="col-sm-2 col-form-label">Cell Phone Name:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="txtCellPhoneName" id="txtCellPhoneName" value="<?php echo $cellPhoneName ?? ''; ?>" placeholder="Please Enter cell phone name">
                <small class="text-danger"><?php echo $cellphoneerror; ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="txtCellPhoneDescription" class="col-sm-2 col-form-label">Cell Phone Description:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="txtCellPhoneDescription" id="txtCellPhoneDescription" value="<?php echo $cellPhoneDescription ?? ''; ?>" placeholder="Please Enter cell Phone Description">
                <small class="text-danger"><?php echo $cellPhoneDescriptionError; ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="txtQuantity" class="col-sm-2 col-form-label">Quantity Available:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="txtQuantity" id="txtQuantity" value="<?php echo $quantity ?? ''; ?>" placeholder="Quantity in Stock">
                <small class="text-danger"><?php echo $quantityError; ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="txtPrice" class="col-sm-2 col-form-label">Price:</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="txtPrice" id="txtPrice" value="<?php echo $price ?? ''; ?>" placeholder="Please enter price of each item">
                <small class="text-danger"><?php echo $priceError; ?></small>
            </div>
        </div>
        <div class="form-group row">
            <label for="CellPhoneCompany" class="col-sm-2 col-form-label">Company:</label>
            <div class="col-sm-10">
                <select id="CellPhoneCompany" name="CellPhoneCompany" class="form-control">
                    <option value="" disabled selected>Choose a company...</option>
                    <option value="Apple">Apple</option>
                    <option value="Samsung">Samsung</option>
                    <option value="Google">Google Pixel Edition</option>
                </select>
                <small class="text-danger"><?php echo $companyError; ?></small>
            </div>
        </div>
        <button type="submit" class="btnSubmit" name="submit">Submit</button>
    </form>
</div>
<?php
include('footer.php'); 
?>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
