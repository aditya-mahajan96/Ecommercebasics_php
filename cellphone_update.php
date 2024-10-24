<?php
// Connect to DB
require('dbinit.php');

// Initialize error variables
$cellphoneerror = '';
$cellPhoneDescriptionError = '';
$priceError = ''; 
$quantityError = '';
$companyError = '';

// Fetch existing cellphone data if not a form submission
if (isset($_GET['CellPhonesId'])) {
    $cellphoneId = $_GET['CellPhonesId'];

    // SQL to get the product data
    $sql = "SELECT * FROM cellphone WHERE CellPhonesId = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $cellphoneId);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) > 0) {
        $cellPhone = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    } else {
        echo "No cellphone found with the provided ID.";
        exit;  // Exit if no matching record is found
    }
} else {
    echo "CellPhonesId is not set!";
    exit;
}

if (isset($_POST['update'])) { // Checking for 'update' instead of 'submit'
    // Validate cell phone name
    if (!empty($_POST['txtCellPhoneName'])) {
        $cellPhoneName = mysqli_real_escape_string($conn, trim($_POST['txtCellPhoneName']));
    } else {
        $cellPhoneName = null;
        $cellphoneerror = "Cell Phone name is required!";
    }

    // Validate cell phone description
    if (!empty($_POST['txtCellPhoneDescription'])) {
        $cellPhoneDescription = mysqli_real_escape_string($conn, trim($_POST['txtCellPhoneDescription']));
    } else {
        $cellPhoneDescription = null;
        $cellPhoneDescriptionError = "Cell Phone description is required!";
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

    // Update query
    if (empty($cellphoneerror) && empty($cellPhoneDescriptionError) && empty($priceError) && empty($quantityError) && empty($companyError)) {
        $sql = "UPDATE cellphone SET CellPhoneName=?, cellPhoneDescription=?, QuantityAvailable=?, Price=?, CellPhoneCompany=? WHERE CellPhonesId=?";
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param($stmt, "ssdssi", $cellPhoneName, $cellPhoneDescription, $quantity, $price, $company, $cellphoneId);
            if (mysqli_stmt_execute($stmt)) {
                header('Location: index.php');
                exit;
            } else {
                echo "Error executing query: " . mysqli_error($conn); // Show error if query fails
            }
            mysqli_stmt_close($stmt);
        } else {
            echo "Error preparing statement: " . mysqli_error($conn);
        }
    }
    mysqli_close($conn);
}
?>

<?php include('header.php'); ?>
<div class="container mt-5">
    <h1>Edit Cell Phone</h1>

    

    <form method="POST" action="cellphone_update.php?CellPhonesId=<?php echo $cellphoneId; ?>">
        <div class="form-group">
            <label for="txtCellPhoneName">Cell Phone Name:</label>
            <input type="text" class="form-control" name="txtCellPhoneName" id="txtCellPhoneName" value="<?php echo $cellPhone['CellPhoneName']; ?>">
            <span class="text-danger"><?php echo $cellphoneerror; ?></span>
        </div>
        <div class="form-group">
            <label for="txtCellPhoneDescription">Cell Phone Description:</label>
            <input type="text" class="form-control" name="txtCellPhoneDescription" id="txtCellPhoneDescription" value="<?php echo $cellPhone['CellPhoneDescription']; ?>">
            <span class="text-danger"><?php echo $cellPhoneDescriptionError; ?></span>
        </div>
        <div class="form-group">
            <label for="txtQuantity">Quantity Available:</label>
            <input type="number" class="form-control" name="txtQuantity" id="txtQuantity" value="<?php echo $cellPhone['QuantityAvailable']; ?>">
            <span class="text-danger"><?php echo $quantityError; ?></span>
        </div>
        <div class="form-group">
            <label for="txtPrice">Price:</label>
            <input type="number" class="form-control" name="txtPrice" id="txtPrice" value="<?php echo $cellPhone['Price']; ?>">
            <span class="text-danger"><?php echo $priceError; ?></span>
        </div>
        <div class="form-group">
            <label for="CellPhoneCompany">Company:</label>
            <select id="CellPhoneCompany" name="CellPhoneCompany" class="form-control">
                <option value="" disabled selected>Choose a company...</option>
                <option value="Apple" <?php if ($cellPhone['CellPhoneCompany'] == 'Apple') echo 'selected'; ?>>Apple</option>
                <option value="Samsung" <?php if ($cellPhone['CellPhoneCompany'] == 'Samsung') echo 'selected'; ?>>Samsung</option>
                <option value="Google" <?php if ($cellPhone['CellPhoneCompany'] == 'Google') echo 'selected'; ?>>Google Pixel Edition</option>
            </select>
            <span class="text-danger"><?php echo $companyError; ?></span>
        </div>
        <button type="submit" class="btn btn-primary mb-3" name="update">Update</button>
        <a href="index.php" class="btn btn-secondary mb-3">Cancel</a>
    </form>
</div>

<?php include('footer.php'); ?>
