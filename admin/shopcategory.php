<?php
$pageTitle = "Zay Shop - Shopcategory Manage Page";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../components/admincss.php'; ?>
<?php
include "../config/db.php";
?>

<body>

    <?php include './header.php'; ?>

    <div class="modal fade" id="addNewItem1" tabindex="-1" aria-labelledby="addshopcategory1modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addshopcategory1modal">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="shopcategorymanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="shopcategory" class="col-form-label">Shopcategory:</label>
                            <input type="text" class="form-control" id="shopcategory" name="shopcategory" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="newshopcategory1"
                            value="Add New Item">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewItem2" tabindex="-1" aria-labelledby="addshopcategory2modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addshopcategory2modal">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="shopcategorymanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="shopcategory1" class="col-form-label">Shopcategory1:</label>
                            <select class="form-select" id="shopcategory1" name="shopcategory1" aria-label="Shopcategory1" required>
                                <?php
                                // Fetch shopcategories from the database
                                $sql = "SELECT * FROM shopcategories WHERE parentId = 0";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the shopcategories and display them
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $shopcategory = $row['shopcategory'];
                                        $shopcategory_id = $row['id'];
                                        echo "<option value='{$shopcategory_id}'>$shopcategory</option>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No shopcategories found.</td></tr>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="shopcategory2" class="col-form-label">Shopcategory2:</label>
                            <input type="text" class="form-control" id="shopcategory2" name="shopcategory2" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="newshopcategory2"
                            value="Add New Item">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="editshopcategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editshopcategory">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editShopcategoryForm" action="shopcategorymanage.php" method="post" enctype="multipart/form-data"
                    class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_shopcategory" class="col-form-label">Shopcategory:</label>
                            <input type="text" class="form-control" id="edit_shopcategory" name="edit_shopcategory" required>
                            <input type="hidden" id="edit_shopcategory_id" name="edit_shopcategory_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="editshopcategory"
                            value="Edit Item">
                    </div>
                </form>
            </div>
        </div>
    </div>


    <div class="container-fluid pb-3 flex-grow-1 d-flex flex-column flex-sm-row overflow-auto pt-4">
        <div class="row flex-grow-sm-1 flex-grow-1">
            
            <?php include './leftnav.php'; ?>

            <main class="col overflow-auto h-100">
                <div class="bg-light border rounded-3 p-3">
                    <?php
                    if (isset ($_GET['successMessage'])) {
                        $successMessage = $_GET['successMessage'];
                        echo "
                            <div class='offset-sm-3 col-sm-6'>
                                <div id='successMessage' class='alert alert-success alert-dismissible fade show' role='alert'>
                                    <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                </div>
                            </div>
                            <script>
                                setTimeout(function() {
                                    document.getElementById('successMessage').style.display = 'none';
                                    // Remove the successMessage parameter from the URL
                                    var url = window.location.href;
                                    if (url.includes('?successMessage=')) {
                                        var newUrl = url.split('?')[0];
                                        window.history.replaceState({}, document.title, newUrl);
                                    }
                                }, 5000);
                            </script>";

                    }
                    ?>
                    <?php
                    if (isset ($_GET['errorMessage'])) {
                        $errorMessage = $_GET['errorMessage'];
                        echo "
                        <div id='errorMessageContainer' class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                                <strong>$errorMessage</strong>
                                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                            </div>
                        </div>
                        <script>
                            setTimeout(function() {
                                document.getElementById('errorMessageContainer').style.display = 'none';
                                // Remove the errorMessageContainer parameter from the URL
                                var url = window.location.href;
                                if (url.includes('?errorMessageContainer=')) {
                                    var newUrl = url.split('?')[0];
                                    window.history.replaceState({}, document.title, newUrl);
                                }
                            }, 5000);
                        </script>";
                    }
                    ?>
                    <div class="main-content row">
                        <div class="mt-5 col-md-6">
                            <!-- Table -->
                            <h2 class="mb-3">Shopcategory1</h2>
                            <div class="row">
                                <!-- Dark table -->
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <div class="row justify-content-between">
                                                    <h3 class="text-white mb-0 col-md-9">Shopcategory1 tables</h3>
                                                    <button type="button" class="btn btn-outline-info col-md-3"
                                                        data-bs-toggle="modal" data-bs-target="#addNewItem1"
                                                        data-bs-whatever="@mdo"><i class="fa fa-plus"></i>Add New
                                                        Item</button>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-items-center table-dark table-flush">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col text-end">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Fetch shopcategories from the database
                                                        $sql = "SELECT * FROM shopcategories WHERE parentId = 0";
                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the shopcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $shopcategory = $row['shopcategory'];
                                                                $shopcategory_id = $row['id'];
                                                                echo "
                                                                <tr>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-shopcategory-id='{$shopcategory_id}'>$shopcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-shopcategory' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editItem'
                                                                        data-bs-whatever='@mdo' data-shopcategory-id='{$shopcategory_id}' edit-shopcategory='{$shopcategory}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-shopcategory' href='#' role='button' data-shopcategory-id='{$shopcategory_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No shopcategories found.</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="mt-5 col-md-6">
                            <!-- Table -->
                            <h2 class="mb-3">Shopcategory2</h2>
                            <div class="row">
                                <!-- Dark table -->
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <div class="row justify-content-between">
                                                    <h3 class="text-white mb-0 col-md-9">Shopcategory2 tables</h3>
                                                    <button type="button" class="btn btn-outline-info col-md-3"
                                                        data-bs-toggle="modal" data-bs-target="#addNewItem2"
                                                        data-bs-whatever="@mdo"><i class="fa fa-plus"></i>Add New
                                                        Item</button>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-items-center table-dark table-flush">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Shopcategory1</th>
                                                            <th scope="col text-md-end">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Fetch shopcategories from the database
                                                        $sql = "SELECT * FROM shopcategories WHERE parentId != 0";

                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the shopcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $shopcategory = $row['shopcategory'];
                                                                $shopcategory_parentId = $row['parentId'];
                                                                $shopcategory1_query = mysqli_query($conn, "SELECT * FROM shopcategories WHERE id = $shopcategory_parentId");
                                                                if ($shopcategory1_query) {
                                                                    $shopcategory1_row = mysqli_fetch_assoc($shopcategory1_query);
                                                                    $shopcategory1 = $shopcategory1_row['shopcategory']; // Retrieve the shopcategory name from the parent shopcategory query result
                                                                    $shopcategory_id1 = $shopcategory1_row['id']; // Retrieve the shopcategory name from the parent shopcategory query result
                                                                } else {
                                                                    // Handle query error if necessary
                                                                }
                                                                $shopcategory_id = $row['id'];
                                                                echo "
                                                                <tr>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-shopcategory-id2='{$shopcategory_id}'>$shopcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-shopcategory-id1='{$shopcategory_id1}'>$shopcategory1</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-shopcategory' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editItem'
                                                                        data-bs-whatever='@mdo' data-shopcategory-id='{$shopcategory_id}' edit-shopcategory='{$shopcategory}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-shopcategory' href='#' role='button' data-shopcategory-id='{$shopcategory_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No shopcategories found.</td></tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php include '../components/adminjs.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var editButtons = document.querySelectorAll('.edit-shopcategory');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var shopcategoryId = button.getAttribute('data-shopcategory-id');
                    var shopcategoryValue = button.getAttribute('edit-shopcategory');
                    document.getElementById('edit_shopcategory_id').value = shopcategoryId;
                    document.getElementById('edit_shopcategory').value = shopcategoryValue;
                    console.log(shopcategoryId + shopcategoryValue);
                });
            });

            var deleteButtons = document.querySelectorAll('.delete-shopcategory');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var shopcategoryId = button.getAttribute('data-shopcategory-id');
                    if (confirm("Are you sure you want to delete this shopcategory?")) {
                        deleteShopcategory(shopcategoryId);
                    }
                });
            });

            function deleteShopcategory(shopcategoryId) {
                // Send an AJAX request to delete-shopcategory.php with the shopcategory ID
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page
                            // location.reload();
                            $successMessage = "Successfully Deleted!";
                            location.href = "shopcategory.php?successMessage=" + $successMessage;
                        } else {
                            // If there's an error, display an error message
                            console.error('Error deleting shopcategory: ' + xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'delete-shopcategory.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('shopcategory_id=' + shopcategoryId);
            }
        });
    </script>

</body>

</html>