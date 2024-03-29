<?php
include "../config/db.php";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form fields are set and not empty
    if (isset ($_POST["addtechproduct"])) {
        // Retrieve form data
        $techproductName = $_POST['techproduct_name'];
        $price = $_POST['price'];
        $techcategoryID = $_POST['techcategory1'];
        $description = $_POST['description'];

        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            // Check if the file is an image
            $fileType = exif_imagetype($_FILES["image"]["tmp_name"]);
            if ($fileType !== false) {
                // Generate a unique name for the image
                $imageName = uniqid("techproduct_image_") . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                // Specify the directory where uploaded images will be saved
                $uploadDirectory = "uploads/";

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDirectory . $imageName)) {
                    // File upload successful, now insert techproduct data into the database

                    // Prepare the SQL statement
                    $sql = "INSERT INTO techproducts (techproduct_name, price, techcategory_id, description, image) VALUES ('$techproductName', $price, $techcategoryID, '$description', '$imageName')";

                    // Execute the SQL statement
                    if (mysqli_query($conn, $sql)) {
                        // Product added successfully
                        // echo "Product added successfully.";
                        $successMessage = "Product added successfully!";
                        header("location: techproducts.php?successMessage=" . urlencode($successMessage));
                        exit;
                    } else {
                        // Error inserting techproduct into the database
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    // Error moving uploaded file
                    // echo "Error uploading image.";
                    $errorMessage = "Error uploading image.";
                    header("location: techproducts.php?errorMessage=" . urlencode($errorMessage));
                    exit;
                }
            } else {
                // File is not an image
                $errorMessage = "Uploaded file is not an image.";
                header("location: techproducts.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }
        } else {
            $errorMessage = "Error uploading file: " . $_FILES["image"]["error"];
            header("location: techproducts.php?errorMessage=" . urlencode($errorMessage));
            exit;
        }
    }

    if (isset ($_POST["edittechproduct"])) {
        $techcategory_id = $_POST["edit_techproduct_id"];
        $edit_techproduct_name = $_POST["edit_techproduct_name"];
        $edit_techproduct_price = $_POST["edit_techproduct_price"];
        $edit_techproduct_techcategory = $_POST["edit_techproduct_techcategory"];
        $edit_techproduct_description = $_POST["edit_techproduct_description"];

        // Check if a new image has been uploaded
        if ($_FILES["editimage"]["error"] === UPLOAD_ERR_OK) {
            // Retrieve the old image name
            $old_image_sql = "SELECT image FROM techproducts WHERE id = '$techcategory_id'";
            $old_image_result = mysqli_query($conn, $old_image_sql);
            $old_image_row = mysqli_fetch_assoc($old_image_result);
            $old_image = $old_image_row['image'];

            // Delete the old image
            unlink("uploads/$old_image");

            // Upload the new image
            $new_image_name = uniqid("techproduct_image_") . "." . pathinfo($_FILES["editimage"]["name"], PATHINFO_EXTENSION);
            $uploadDirectory = "uploads/";
            if (move_uploaded_file($_FILES["editimage"]["tmp_name"], $uploadDirectory . $new_image_name)) {
                // Update the techproduct data with the new image
                $sql = "UPDATE techproducts SET techproduct_name = '$edit_techproduct_name', price = '$edit_techproduct_price', techcategory_id = '$edit_techproduct_techcategory', description = '$edit_techproduct_description', image = '$new_image_name' WHERE id = '$techcategory_id'";
            } else {
                // Error moving uploaded file
                $errorMessage = "Error uploading new image.";
                header("location: techproducts.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }
        } else {
            // No new image uploaded, update techproduct data without changing the image
            $sql = "UPDATE techproducts SET techproduct_name = '$edit_techproduct_name', price = '$edit_techproduct_price', techcategory_id = '$edit_techproduct_techcategory', description = '$edit_techproduct_description' WHERE id = '$techcategory_id'";
        }

        // Execute the SQL statement
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $errorMessage = "Error updating techproduct: " . mysqli_error($conn);
            header("location: techproducts.php?errorMessage=" . urlencode($errorMessage));
            exit;
        }

        $successMessage = "Product updated successfully!";
        header("location: techproducts.php?successMessage=" . urlencode($successMessage));
        exit;
    }
} else {
    echo "ELse";
}

?>