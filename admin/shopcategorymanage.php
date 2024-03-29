<?php
include "../config/db.php";

$shopcategory = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST["newshopcategory1"])) {
        $shopcategory = $_POST["shopcategory"];

        $check_sql = "SELECT * FROM shopcategories WHERE shopcategory = '$shopcategory'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $errorMessage = "Category already exists!";
            header("location: shopcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the shopcategory into the database
            $sql = "INSERT INTO shopcategories (shopcategory, parentId) VALUES ('$shopcategory', 0)";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Invalid query : " . mysqli_error($conn));
            }

            $successMessage = "Successfully Added!";
            header("location: shopcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }
    if (isset ($_POST["newshopcategory2"])) {
        $shopcategory1 = $_POST["shopcategory1"];
        $shopcategory2 = $_POST["shopcategory2"];

        $check_sql = "SELECT * FROM shopcategories WHERE shopcategory = '$shopcategory2' AND parentId = $shopcategory1";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $errorMessage = "Category already exists!";
            header("location: shopcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the shopcategory into the database
            $sql = "INSERT INTO shopcategories (shopcategory, parentId) VALUES ('$shopcategory2', '$shopcategory1')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Invalid query : " . mysqli_error($conn));
            }

            $successMessage = "Successfully Added!";
            header("location: shopcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }

    if (isset ($_POST["editshopcategory"])) {
        $shopcategory_id = $_POST["edit_shopcategory_id"];
        $shopcategory = $_POST["edit_shopcategory"];

        $check_sql = "SELECT * FROM shopcategories WHERE shopcategory = '$shopcategory'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // $errorMessage = "Category already exists!";
            $errorMessage = mysqli_num_rows($check_result);
            header("location: shopcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the shopcategory into the database
            $sql = "UPDATE shopcategories SET shopcategory = '$shopcategory' WHERE id = '$shopcategory_id'";
            $result = mysqli_query($conn, $sql);
            // echo "SQL Query: " . $sql . "<br>";
            if (!$result) {
                $errorMessage = "Error updating shopcategory: " . mysqli_error($conn);
                header("location: shopcategory.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }

            // $successMessage = "SQL Query: " . $sql . "<br>";
            $successMessage = "Successfully Updated!";
            header("location: shopcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }
} else {
    echo "ELse";
}

?>