<?php
include '../config/functions.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="container">
        <header class="header">
            <?php
            include ('header.php');
            ?>
        </header>
        <!-- Header End -->

        <!-- Main Section Start -->
        <div class="main shadow">
            <!-- PHP Script Start -->
            <?php
            $conn = mysqli_connect('localhost', 'root', '', 'onlineshop') or die ("Database connection error!");
            $sql = "SELECT * FROM brands";
            $retVal = mysqli_query($conn, $sql) or die ('Database query error!');
            ?>
            <!-- PHP Script End -->


            <!-- HTML Form -->
            <form class="addForm" action="insertBrand.php" method="post">
                <div class="mb-3">
                    <label for="inputBrandName" class="form-label"> Type Brand Name</label>
                    <input type="text" name="brandName" class="form-control" id="inputBrandName">
                </div>
                <input type="submit" value="Submit">
            </form>
        </div>
    </div>


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
        crossorigin="anonymous"></script>
</body>

</html>