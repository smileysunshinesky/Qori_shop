<?php
$pageTitle = "Zay Tech - Techcategory Manage Page";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../components/admincss.php'; ?>
<?php
include "../config/db.php";
?>

<body>

    <?php include './header.php'; ?>

    <div class="modal fade" id="addNewItem1" tabindex="-1" aria-labelledby="addtechcategory1modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtechcategory1modal">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="techcategorymanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="techcategory" class="col-form-label">Techcategory:</label>
                            <input type="text" class="form-control" id="techcategory" name="techcategory" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="newtechcategory1"
                            value="Add New Item">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addNewItem2" tabindex="-1" aria-labelledby="addtechcategory2modal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addtechcategory2modal">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="techcategorymanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="techcategory1" class="col-form-label">Techcategory1:</label>
                            <select class="form-select" id="techcategory1" name="techcategory1" aria-label="Techcategory1" required>
                                <?php
                                // Fetch techcategories from the database
                                $sql = "SELECT * FROM techcategories WHERE parentId = 0";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the techcategories and display them
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $techcategory = $row['techcategory'];
                                        $techcategory_id = $row['id'];
                                        echo "<option value='{$techcategory_id}'>$techcategory</option>";
                                    }
                                } else {
                                    echo "<tr><td colspan='2'>No techcategories found.</td></tr>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="techcategory2" class="col-form-label">Techcategory2:</label>
                            <input type="text" class="form-control" id="techcategory2" name="techcategory2" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="newtechcategory2"
                            value="Add New Item">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editItem" tabindex="-1" aria-labelledby="edittechcategory" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edittechcategory">Edit Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editTechcategoryForm" action="techcategorymanage.php" method="post" enctype="multipart/form-data"
                    class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="edit_techcategory" class="col-form-label">Techcategory:</label>
                            <input type="text" class="form-control" id="edit_techcategory" name="edit_techcategory" required>
                            <input type="hidden" id="edit_techcategory_id" name="edit_techcategory_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input class="btn btn-secondary btn-success" type="submit" name="edittechcategory"
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
                            <h2 class="mb-3">Techcategory1</h2>
                            <div class="row">
                                <!-- Dark table -->
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <div class="row justify-content-between">
                                                    <h3 class="text-white mb-0 col-md-9">Techcategory1 tables</h3>
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
                                                        // Fetch techcategories from the database
                                                        $sql = "SELECT * FROM techcategories WHERE parentId = 0";
                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the techcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $techcategory = $row['techcategory'];
                                                                $techcategory_id = $row['id'];
                                                                echo "
                                                                <tr>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-techcategory-id='{$techcategory_id}'>$techcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-techcategory' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editItem'
                                                                        data-bs-whatever='@mdo' data-techcategory-id='{$techcategory_id}' edit-techcategory='{$techcategory}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-techcategory' href='#' role='button' data-techcategory-id='{$techcategory_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No techcategories found.</td></tr>";
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
                            <h2 class="mb-3">Techcategory2</h2>
                            <div class="row">
                                <!-- Dark table -->
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <div class="row justify-content-between">
                                                    <h3 class="text-white mb-0 col-md-9">Techcategory2 tables</h3>
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
                                                            <th scope="col">Techcategory1</th>
                                                            <th scope="col text-md-end">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        // Fetch techcategories from the database
                                                        $sql = "SELECT * FROM techcategories WHERE parentId != 0";

                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the techcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $techcategory = $row['techcategory'];
                                                                $techcategory_parentId = $row['parentId'];
                                                                $techcategory1_query = mysqli_query($conn, "SELECT * FROM techcategories WHERE id = $techcategory_parentId");
                                                                if ($techcategory1_query) {
                                                                    $techcategory1_row = mysqli_fetch_assoc($techcategory1_query);
                                                                    $techcategory1 = $techcategory1_row['techcategory']; // Retrieve the techcategory name from the parent techcategory query result
                                                                    $techcategory_id1 = $techcategory1_row['id']; // Retrieve the techcategory name from the parent techcategory query result
                                                                } else {
                                                                    // Handle query error if necessary
                                                                }
                                                                $techcategory_id = $row['id'];
                                                                echo "
                                                                <tr>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-techcategory-id2='{$techcategory_id}'>$techcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm' edit-techcategory-id1='{$techcategory_id1}'>$techcategory1</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-techcategory' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editItem'
                                                                        data-bs-whatever='@mdo' data-techcategory-id='{$techcategory_id}' edit-techcategory='{$techcategory}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-techcategory' href='#' role='button' data-techcategory-id='{$techcategory_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No techcategories found.</td></tr>";
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
            var editButtons = document.querySelectorAll('.edit-techcategory');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var techcategoryId = button.getAttribute('data-techcategory-id');
                    var techcategoryValue = button.getAttribute('edit-techcategory');
                    document.getElementById('edit_techcategory_id').value = techcategoryId;
                    document.getElementById('edit_techcategory').value = techcategoryValue;
                    console.log(techcategoryId + techcategoryValue);
                });
            });

            var deleteButtons = document.querySelectorAll('.delete-techcategory');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var techcategoryId = button.getAttribute('data-techcategory-id');
                    if (confirm("Are you sure you want to delete this techcategory?")) {
                        deleteTechcategory(techcategoryId);
                    }
                });
            });

            function deleteTechcategory(techcategoryId) {
                // Send an AJAX request to delete-techcategory.php with the techcategory ID
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page
                            // location.reload();
                            $successMessage = "Successfully Deleted!";
                            location.href = "techcategory.php?successMessage=" + $successMessage;
                        } else {
                            // If there's an error, display an error message
                            console.error('Error deleting techcategory: ' + xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'delete-techcategory.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('techcategory_id=' + techcategoryId);
            }
        });
    </script>

</body>

</html>