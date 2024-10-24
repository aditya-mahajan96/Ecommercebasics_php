<?php
// Connect to DB
require('dbinit.php');

// Initialize message variable
$message = '';

// Check if cellphoneId is set for deletion
if (isset($_GET['CellPhonesId'])) {
    $cellphoneId = intval($_GET['CellPhonesId']);

    // Fetch the cellphone data to display
    $sql = "SELECT * FROM cellphone WHERE CellPhonesId=$cellphoneId";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $cellphone = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
    } else {
        $message = "Error fetching product data.";
        exit;
    }

    // Handle deletion confirmation
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm'])) {
        $deleteSql = "DELETE FROM cellphone WHERE CellPhonesId=$cellphoneId";
        if (mysqli_query($conn, $deleteSql)) {
            $message = "Cell phone deleted successfully.";
            header('Location: index.php'); // Redirect after deletion
            exit;
        } else {
            $message = "Error deleting cell phone: " . mysqli_error($conn);
        }
    }
} else {
    $message = "Invalid request.";
}

// Close the connection
mysqli_close($conn);
include('header.php');
?>

<div class="container mt-5">
    <h1>Delete Cell Phone</h1>
    
    <?php if ($message): ?>
        <div class="alert alert-danger"><?php echo $message; ?></div>
    <?php endif; ?>

    <?php if (isset($cellphone)): ?>
        <p>Are you sure you want to delete the following cell phone?</p>
      
        <form method="POST" action="cellphone_delete.php?CellPhonesId=<?php echo $cellphoneId; ?>">
            <table class="table table-bordered">
                <tr>
                    <td><strong>Cell Phone Name:</strong></td>
                    <td><?php echo htmlspecialchars($cellphone['CellPhoneName']); ?></td>
                </tr>
                <tr>
                    <td><strong>Description:</strong></td>
                    <td><?php echo htmlspecialchars($cellphone['CellPhoneDescription']); ?></td>
                </tr>
                <tr>
                    <td><strong>Price:</strong></td>
                    <td><?php echo htmlspecialchars($cellphone['Price']); ?></td>
                </tr>
                <tr>
                    <td><strong>Quantity Available:</strong></td>
                    <td><?php echo htmlspecialchars($cellphone['QuantityAvailable']); ?></td>
                </tr>
                <tr>
                    <td><strong>Company:</strong></td>
                    <td><?php echo htmlspecialchars($cellphone['CellPhoneCompany']); ?></td>
                </tr>
            </table>
            <button type="submit" name="confirm" class="btn btn-danger">Confirm Deletion</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    <?php endif; ?>
</div>

<?php include('footer.php'); ?>
