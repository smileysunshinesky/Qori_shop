<?php
include "../config/db.php";

$techcategory = "";

$errorMessage = "";
$successMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset ($_POST["newtechcategory1"])) {
        $techcategory = $_POST["techcategory"];

        $check_sql = "SELECT * FROM techcategories WHERE techcategory = '$techcategory'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $errorMessage = "Category already exists!";
            header("location: techcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the techcategory into the database
            $sql = "INSERT INTO techcategories (techcategory, parentId) VALUES ('$techcategory', 0)";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Invalid query : " . mysqli_error($conn));
            }

            $successMessage = "Successfully Added!";
            header("location: techcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }
    if (isset ($_POST["newtechcategory2"])) {
        $techcategory1 = $_POST["techcategory1"];
        $techcategory2 = $_POST["techcategory2"];

        $check_sql = "SELECT * FROM techcategories WHERE techcategory = '$techcategory2' AND parentId = $techcategory1";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            $errorMessage = "Category already exists!";
            header("location: techcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the techcategory into the database
            $sql = "INSERT INTO techcategories (techcategory, parentId) VALUES ('$techcategory2', '$techcategory1')";
            $result = mysqli_query($conn, $sql);

            if (!$result) {
                die("Invalid query : " . mysqli_error($conn));
            }

            $successMessage = "Successfully Added!";
            header("location: techcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }

    if (isset ($_POST["edittechcategory"])) {
        $techcategory_id = $_POST["edit_techcategory_id"];
        $techcategory = $_POST["edit_techcategory"];

        $check_sql = "SELECT * FROM techcategories WHERE techcategory = '$techcategory'";
        $check_result = mysqli_query($conn, $check_sql);

        if (mysqli_num_rows($check_result) > 0) {
            // $errorMessage = "Category already exists!";
            $errorMessage = mysqli_num_rows($check_result);
            header("location: techcategory.php?errorMessage=" . urlencode($errorMessage));
        } else {
            // Insert the techcategory into the database
            $sql = "UPDATE techcategories SET techcategory = '$techcategory' WHERE id = '$techcategory_id'";
            $result = mysqli_query($conn, $sql);
            // echo "SQL Query: " . $sql . "<br>";
            if (!$result) {
                $errorMessage = "Error updating techcategory: " . mysqli_error($conn);
                header("location: techcategory.php?errorMessage=" . urlencode($errorMessage));
                exit;
            }

            // $successMessage = "SQL Query: " . $sql . "<br>";
            $successMessage = "Successfully Updated!";
            header("location: techcategory.php?successMessage=" . urlencode($successMessage));
            exit;
        }
    }
} else {
    echo "ELse";
}

?>