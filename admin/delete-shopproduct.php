<?php
// Include your database connection code
include "../config/db.php";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['shopcategory_id'])) {
    $categoryId = mysqli_real_escape_string($conn, $_POST['shopcategory_id']);

    // Perform the deletion of the category
    $delete_sql = "DELETE FROM shopproducts WHERE id = '$categoryId'";
    $delete_result = mysqli_query($conn, $delete_sql);

    if ($delete_result) {
        // Deletion successful
        echo "Deleted Successfully!";
    } else {
        // Error in deletion
        echo "Error deleting category: " . mysqli_error($conn);
    }
} else {
    // Invalid request
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>