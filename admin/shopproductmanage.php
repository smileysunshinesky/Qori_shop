<?php
include "../config/db.php";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Check if the form fields are set and not empty
    if (isset ($_POST["addshopproduct"])) {
        // Retrieve form data
        $shopproductName = $_POST['shopproduct_name'];
        $price = $_POST['price'];
        $shopcategoryID = $_POST['shopcategory1'];
        $description = $_POST['description'];

        if ($_FILES["image"]["error"] === UPLOAD_ERR_OK) {
            // Check if the file is an image
            $fileType = exif_imagetype($_FILES["image"]["tmp_name"]);
            if ($fileType !== false) {
                // Generate a unique name for the image
                $imageName = uniqid("shopproduct_image_") . "." . pathinfo($_FILES["image"]["name"], PATHINFO_EXTENSION);

                // Specify the directory where uploaded images will be saved
                $uploadDirectory = "uploads/";

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $uploadDirectory . $imageName)) {
                    // File upload successful, now insert shopproduct data into the database

                    // Prepare the SQL statement
                    $sql = "INSERT INTO shopproducts (shopproduct_name, price, shopcategory_id, description, image) VALUES ('$shopproductName', $price, $shopcategoryID, '$description', '$imageName')";

                    // Execute the SQL statement
                    if (mysqli_query($conn, $sql)) {
                        // Product added successfully
                        // echo "Product added successfully.";
                        $successMessage = "Product added successfully!";
                        header("location: shopproducts.php?successMessage=" . urlencode($successMessage));
                        exit;
                    } else {
                        // Error inserting shopproduct into the database
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    // Error moving uploaded file
                    // echo "Error uploading image.";
                    $errorMessage = "Error uploading image.";
                    header("location: shopproducts.php?errorMessage=" . urlencode($errorMessage));
                    exit;
                }
            } else {
                // File is not an image
                $errorMessage = "Uploaded file is not an image.";
                header("location: shopproducts.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }
        } else {
            $errorMessage = "Error uploading file: " . $_FILES["image"]["error"];
            header("location: shopproducts.php?errorMessage=" . urlencode($errorMessage));
            exit;
        }
    }

    if (isset ($_POST["editshopproduct"])) {
        $shopcategory_id = $_POST["edit_shopproduct_id"];
        $edit_shopproduct_name = $_POST["edit_shopproduct_name"];
        $edit_shopproduct_price = $_POST["edit_shopproduct_price"];
        $edit_shopproduct_shopcategory = $_POST["edit_shopproduct_shopcategory"];
        $edit_shopproduct_description = $_POST["edit_shopproduct_description"];

        // Check if a new image has been uploaded
        if ($_FILES["editimage"]["error"] === UPLOAD_ERR_OK) {
            // Retrieve the old image name
            $old_image_sql = "SELECT image FROM shopproducts WHERE id = '$shopcategory_id'";
            $old_image_result = mysqli_query($conn, $old_image_sql);
            $old_image_row = mysqli_fetch_assoc($old_image_result);
            $old_image = $old_image_row['image'];

            // Delete the old image
            unlink("uploads/$old_image");

            // Upload the new image
            $new_image_name = uniqid("shopproduct_image_") . "." . pathinfo($_FILES["editimage"]["name"], PATHINFO_EXTENSION);
            $uploadDirectory = "uploads/";
            if (move_uploaded_file($_FILES["editimage"]["tmp_name"], $uploadDirectory . $new_image_name)) {
                // Update the shopproduct data with the new image
                $sql = "UPDATE shopproducts SET shopproduct_name = '$edit_shopproduct_name', price = '$edit_shopproduct_price', shopcategory_id = '$edit_shopproduct_shopcategory', description = '$edit_shopproduct_description', image = '$new_image_name' WHERE id = '$shopcategory_id'";
            } else {
                // Error moving uploaded file
                $errorMessage = "Error uploading new image.";
                header("location: shopproducts.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }
        } else {
            // No new image uploaded, update shopproduct data without changing the image
            $sql = "UPDATE shopproducts SET shopproduct_name = '$edit_shopproduct_name', price = '$edit_shopproduct_price', shopcategory_id = '$edit_shopproduct_shopcategory', description = '$edit_shopproduct_description' WHERE id = '$shopcategory_id'";
        }

        // Execute the SQL statement
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            $errorMessage = "Error updating shopproduct: " . mysqli_error($conn);
            header("location: shopproducts.php?errorMessage=" . urlencode($errorMessage));
            exit;
        }

        $successMessage = "Product updated successfully!";
        header("location: shopproducts.php?successMessage=" . urlencode($successMessage));
        exit;
    }
} else {
    echo "ELse";
}

?>