<?php
// Include your database connection code
include 'db_connection.php';

// Check if category ID is provided in the request
if (isset ($_GET['id'])) {
    // Sanitize the input to prevent SQL injection
    $categoryId = mysqli_real_escape_string($conn, $_GET['id']);

    // Query to fetch category data based on category ID
    $sql = "SELECT * FROM categories WHERE id = '$categoryId'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    if ($result) {
        // Check if any category data is returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch category data as an associative array
            $categoryData = mysqli_fetch_assoc($result);

            // Return the category data as JSON
            echo json_encode($categoryData);
        } else {
            // If no category data found for the provided ID, return an error message
            echo json_encode(array('error' => 'No category found for the provided ID'));
        }
    } else {
        // If there's an error executing the query, return an error message
        echo json_encode(array('error' => 'Error executing the query'));
    }
} else {
    // If category ID is not provided in the request, return an error message
    echo json_encode(array('error' => 'Category ID is not provided'));
}

// Close the database connection
mysqli_close($conn);
?>