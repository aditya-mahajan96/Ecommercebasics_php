<?php
// Connect to DB
require('dbinit.php');

// Retrieve all products for listing
$listSql = "SELECT * FROM cellphone";
$listResult = mysqli_query($conn, $listSql);

if (!$listResult) {
    die("Query failed: " . mysqli_error($conn));
}

// Close the connection
mysqli_close($conn);
include('header.php');
?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12 d-flex justify-content-between align-items-center mb-4">
            <h1 class="display-4">Product List</h1>
            <!-- Add New Item Button -->
            <a href="addCellPhones.php" class="btn btn-success btn-lg">Add New Item</a>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <table class="table table-striped table-hover">
                <thead class="thead-dark">
                    <tr>
                        
                        <th>Name</th>
                        <th>Description</th>
                        <th>Quantity Available</th>
                        <th>Price</th>
                        <th>Product Added By</th>
                        <th>Cell Phone Company</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($listResult) > 0): ?>
                        <?php while ($row = mysqli_fetch_assoc($listResult)): ?>
                            <tr>
                               
                                <td><?php echo htmlspecialchars($row['CellPhoneName']); ?></td>
                                <td><?php echo htmlspecialchars($row['CellPhoneDescription']); ?></td>
                                <td><?php echo htmlspecialchars($row['QuantityAvailable']); ?></td>
                                <td><?php echo htmlspecialchars($row['Price']); ?></td>
                                <td><?php echo htmlspecialchars($row['ProductAddedBy']); ?></td>
                                <td><?php echo htmlspecialchars($row['CellPhoneCompany']); ?></td>
                                <td>
                                    <a href="cellphone_update.php?CellPhonesId=<?php echo $row['CellPhonesId']; ?>" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="cellphone_delete.php?CellPhonesId=<?php echo $row['CellPhonesId']; ?>" class="btn btn-danger btn-sm">Delete</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="8" class="text-center">No products found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include('footer.php'); ?>
