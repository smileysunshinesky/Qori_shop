<?php
// Include your database connection code
include "../config/db.php";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['techcategory_id'])) {
    $shopcategoryId = mysqli_real_escape_string($conn, $_POST['techcategory_id']);

    $getParentId_sql = "SELECT parentId FROM techcategories WHERE id = '$shopcategoryId'";
    $getParentId_result = mysqli_query($conn, $getParentId_sql);
    if ($getParentId_result) {
        $parent_row = mysqli_fetch_assoc($getParentId_result);
        $parentId = $parent_row['parentId'];

        if($parentId == 0) {
            $delete_sql = "DELETE FROM techcategories WHERE id = '$shopcategoryId' OR parentId = '$shopcategoryId'";
        } else {
            $delete_sql = "DELETE FROM techcategories WHERE id = '$shopcategoryId'";
        }

        $delete_result = mysqli_query($conn, $delete_sql);

        if ($delete_result) {
            // Deletion successful
            echo "Deleted Successfully!";
        } else {
            // Error in deletion
            echo "Error deleting category: " . mysqli_error($conn);
        }
    } else {
        // Error in retrieving parent ID
        echo "Error retrieving parent ID: " . mysqli_error($conn);
    }
} else {
    // Invalid request
    echo "Invalid request.";
}

// Close the database connection
mysqli_close($conn);
?>