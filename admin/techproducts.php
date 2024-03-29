<?php
$pageTitle = "Zay Tech - Techproduct Listing Page";
?>
<!DOCTYPE html>
<html lang="en">
<?php include '../components/admincss.php'; ?>

<?php
include "../config/db.php";
?>

<body>
    <?php include './header.php'; ?>

    <div class="modal fade" id="addNewItem" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Item</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="techproductmanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="techproduct_name" class="col-form-label">Techproduct Name:</label>
                            <input type="text" class="form-control" id="techproduct_name" name="techproduct_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="col-form-label">Price:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="price" type="number" id="price" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" required>
                            </div>
                            <!-- <input type="number" class="form-control" id="techproduct_name" required min="1"> -->
                        </div>
                        <div class="mb-3">
                            <label for="techcategory" class="col-form-label">Category:</label>
                            <select class="form-select" id="techcategory1" name="techcategory1" aria-label="Category1" required>
                                <?php
                                $sql = "SELECT * FROM techcategories";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                // Initialize an array to hold techcategories grouped by parent IDs
                                $techcategoriesByParent = array();

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the techcategories and group them by parent ID
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $techcategory_id = $row['id'];
                                        $techcategory = $row['techcategory'];
                                        $parentId = $row['parentId'];

                                        // If parentId is 0, it's a parent techcategory
                                        if ($parentId == 0) {
                                            // Add the parent techcategory to the techcategoriesByParent array
                                            $techcategoriesByParent[$techcategory_id]['name'] = $techcategory;
                                        } else {
                                            // If parentId is not 0, it's a child techcategory
                                            // Check if the parent techcategory exists in techcategoriesByParent array
                                            if (isset ($techcategoriesByParent[$parentId])) {
                                                // Add the child techcategory to the parent techcategory's children array
                                                $techcategoriesByParent[$parentId]['children'][] = array('id' => $techcategory_id, 'name' => $techcategory);
                                            }
                                        }
                                    }

                                    // Loop through the grouped techcategories and output optgroup labels and options
                                    foreach ($techcategoriesByParent as $parentCategoryId => $parentCategory) {
                                        $parentCategoryName = $parentCategory['name'];
                                        // Output the optgroup label for parent techcategory
                                        echo "<optgroup label='{$parentCategoryName}'>";

                                        // Output the options within the optgroup
                                        if (isset ($parentCategory['children'])) {
                                            foreach ($parentCategory['children'] as $childCategory) {
                                                echo "<option value='{$childCategory['id']}'>{$childCategory['name']}</option>";
                                            }
                                        }

                                        // Close the optgroup
                                        echo "</optgroup>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="description" id="description"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="image">Image:</label>
                            <input type="file" name="image" id="image" accept="image/*" value="" required />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-secondary btn-success" type="submit" name="addtechproduct"
                            value="Add New Techproduct">
                        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editTechproduct" tabindex="-1" aria-labelledby="editTechproductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editTechproductLabel">Edit Techproduct</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="techproductmanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <input type="hidden" id="edit_techproduct_id" name="edit_techproduct_id">
                        <div class="mb-3">
                            <label for="edit_techproduct_name" class="col-form-label">Techproduct Name:</label>
                            <input type="text" class="form-control" id="edit-techproduct-name" name="edit_techproduct_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_techproduct_price" class="col-form-label">Price:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="edit_techproduct_price" type="number" id="edit-techproduct-price" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_techproduct_techcategory" class="col-form-label">Category:</label>
                            <select class="form-select" id="edit-techproduct-techcategory" name="edit_techproduct_techcategory" aria-label="Category1" required>
                                <?php
                                $sql = "SELECT * FROM techcategories";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                // Initialize an array to hold techcategories grouped by parent IDs
                                $techcategoriesByParent = array();

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the techcategories and group them by parent ID
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $techcategory_id = $row['id'];
                                        $techcategory = $row['techcategory'];
                                        $parentId = $row['parentId'];

                                        // If parentId is 0, it's a parent techcategory
                                        if ($parentId == 0) {
                                            // Add the parent techcategory to the techcategoriesByParent array
                                            $techcategoriesByParent[$techcategory_id]['name'] = $techcategory;
                                        } else {
                                            // If parentId is not 0, it's a child techcategory
                                            // Check if the parent techcategory exists in techcategoriesByParent array
                                            if (isset ($techcategoriesByParent[$parentId])) {
                                                // Add the child techcategory to the parent techcategory's children array
                                                $techcategoriesByParent[$parentId]['children'][] = array('id' => $techcategory_id, 'name' => $techcategory);
                                            }
                                        }
                                    }

                                    // Loop through the grouped techcategories and output optgroup labels and options
                                    foreach ($techcategoriesByParent as $parentCategoryId => $parentCategory) {
                                        $parentCategoryName = $parentCategory['name'];
                                        // Output the optgroup label for parent techcategory
                                        echo "<optgroup label='{$parentCategoryName}'>";

                                        // Output the options within the optgroup
                                        if (isset ($parentCategory['children'])) {
                                            foreach ($parentCategory['children'] as $childCategory) {
                                                echo "<option value='{$childCategory['id']}'>{$childCategory['name']}</option>";
                                            }
                                        }

                                        // Close the optgroup
                                        echo "</optgroup>";
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="edit_techproduct_description" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="edit_techproduct_description" id="edit-techproduct-description"></textarea>
                        </div>
                        <div class="mb-3 row">
                            <div class='col-md-4'>
                                <a href='#' class='imagepreview mr-3'>
                                    <img alt='Image placeholder' id="edit-techproduct-image"
                                        src=''>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <label for="editimage">Image:</label>
                                <input type="file" name="editimage" id="edit-techproduct-imageval" accept="image/*" value="" />

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-secondary btn-success" type="submit" name="edittechproduct"
                            value="Edit Techproduct">
                        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
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
                                if (url.includes('?errorMessage=')) {
                                    var newUrl = url.split('?')[0];
                                    window.history.replaceState({}, document.title, newUrl);
                                }
                            }, 5000);
                        </script>";
                    }
                    ?>
                    <div class="main-content">
                        <div class="container mt-5">
                            <!-- Table -->
                            <h2 class="mb-3">Techproducts</h2>
                            <div class="row">
                                <!-- Dark table -->
                                <div class="row mt-5">
                                    <div class="col">
                                        <div class="card bg-default shadow">
                                            <div class="card-header bg-transparent border-0">
                                                <div class="row justify-content-between">
                                                    <h3 class="text-white mb-0 col-md-9">Card tables</h3>
                                                    <button type="button" class="btn btn-outline-info col-md-3"
                                                        data-bs-toggle="modal" data-bs-target="#addNewItem"
                                                        data-bs-whatever="@mdo"><i class="fa fa-plus"></i>Add New
                                                        Item</button>
                                                </div>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table align-items-center table-dark table-flush">
                                                    <thead class="thead-dark">
                                                        <tr>
                                                            <th scope="col">Image</th>
                                                            <th scope="col">Name</th>
                                                            <th scope="col">Price</th>
                                                            <th scope="col">Category</th>
                                                            <th scope="col">Description</th>
                                                            <th scope="col">Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php

                                                        // Define variables for pagination
                                                        $recordsPerPage = 5; // Number of records per page
                                                        $page = isset ($_GET['page']) ? $_GET['page'] : 1; // Current page, default is 1
                                                        
                                                        // Calculate the starting record for the current page
                                                        $start = ($page - 1) * $recordsPerPage;

                                                        // Fetch total number of records
                                                        $totalRecordsQuery = "SELECT COUNT(*) AS total FROM techproducts";
                                                        $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                                                        $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
                                                        $totalRecords = $totalRecordsRow['total'];

                                                        // Calculate total number of pages
                                                        $totalPages = ceil($totalRecords / $recordsPerPage);

                                                        // Modify your SQL query to fetch records for the current page
                                                        $sql = "SELECT * FROM techproducts LIMIT $start, $recordsPerPage";
                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the techcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $techproduct = $row['techproduct_name'];
                                                                $price = $row['price'];
                                                                $techcategory_id = $row['techcategory_id'];
                                                                $description = $row['description'];
                                                                $techproduct_image = $row['image'];
                                                                $techproduct_id = $row['id'];
                                                                $techcategory_query = mysqli_query($conn, "SELECT * FROM techcategories WHERE id = $techcategory_id");
                                                                $techcategory_row = mysqli_fetch_assoc($techcategory_query);
                                                                $techcategory = $techcategory_row['techcategory']; // Retrieve the techcategory name from the parent techcategory query result
                                                                echo "
                                                                <tr>
                                                                    
                                                                    <th scope='row'>
                                                                        <div class='media align-items-center'>
                                                                            <a href='#' class='avatar rounded-circle mr-3'>
                                                                                <img alt='Image placeholder'
                                                                                    src='uploads/$techproduct_image'>
                                                                            </a>
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$techproduct</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                    <span class='badge badge-dot mr-4'>
                                                                    <i class='bg-warning'></i> {$price} USD
                                                                    </span>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$techcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$description</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-techproduct' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editTechproduct'
                                                                        data-bs-whatever='@mdo' data-techproduct-id='{$techproduct_id}' edit-techproduct-image='{$techproduct_image}' edit-techproduct-name='{$techproduct}' edit-techproduct-price='{$price}' edit-techproduct-techcategory='{$techcategory_id}' edit-techproduct-description='{$description}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-techproduct' href='#' role='button' data-techproduct-id='{$techproduct_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No techcategories found.</td></tr>";
                                                        }
                                                        // Close the database connection
                                                        // mysqli_close($conn);
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="card-footer py-4">
                                            <!-- Pagination -->
                                            <nav aria-label="Page navigation">
                                                <ul class="pagination justify-content-end mb-0">
                                                    <li class="page-item <?php echo $page <= 1 ? 'disabled' : ''; ?>">
                                                        <a class="page-link" href="?page=<?php echo $page - 1; ?>"
                                                            tabindex="-1" aria-disabled="true"><i
                                                                class="fas fa-angle-left"></i>
                                                            <span class="sr-only">Previous</span>
                                                        </a>
                                                    </li>
                                                    <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                                            <a class="page-link" href="?page=<?php echo $i; ?>">
                                                                <?php echo $i; ?>
                                                            </a>
                                                        </li>
                                                    <?php endfor; ?>
                                                    <li
                                                        class="page-item <?php echo $page >= $totalPages ? 'disabled' : ''; ?>">
                                                        <a class="page-link"
                                                            href="?page=<?php echo $page + 1; ?>"><i class="fas fa-angle-right"></i>
                                                            <span class="sr-only">Next</span></a>
                                                    </li>
                                                </ul>
                                            </nav>

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
            // Edit Techproduct
            var editButtons = document.querySelectorAll('.edit-techproduct');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var techcategoryId = button.getAttribute('data-techproduct-id');
                    var techproductname = button.getAttribute('edit-techproduct-name');
                    var techproductimage = button.getAttribute('edit-techproduct-image');
                    var techproductprice = button.getAttribute('edit-techproduct-price');
                    var techproducttechcategory = button.getAttribute('edit-techproduct-techcategory');
                    var techproductdescription = button.getAttribute('edit-techproduct-description');

                    document.getElementById('edit_techproduct_id').value = techcategoryId;
                    document.getElementById('edit-techproduct-name').value = techproductname;
                    document.getElementById('edit-techproduct-image').setAttribute('src', 'uploads/' + techproductimage);
                    // document.getElementById('edit-techproduct-imageval').value = techproductimage;
                    document.getElementById('edit-techproduct-price').value = techproductprice;
                    document.getElementById('edit-techproduct-techcategory').value = techproducttechcategory;
                    document.getElementById('edit-techproduct-description').value = techproductdescription;
                    // var editTechproductImageVal = document.getElementById('edit-techproduct-imageval');
                    // if (editTechproductImageVal) {
                    //     editTechproductImageVal.value = techproductimage;
                    // }
                    console.log(techcategoryId + techproducttechcategory);
                });
            });

            // Delete Techproduct
            var deleteButtons = document.querySelectorAll('.delete-techproduct');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var techcategoryId = button.getAttribute('data-techproduct-id');
                    if (confirm("Are you sure you want to delete this techcategory?")) {
                        deleteCategory(techcategoryId);
                    }

                });
            });

            function deleteCategory(techcategoryId) {
                // Send an AJAX request to delete-techproduct.php with the techcategory ID
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page
                            // location.reload();
                            $successMessage = "Successfully Deleted!";
                            location.href = "techproducts.php?successMessage=" + $successMessage;
                        } else {
                            // If there's an error, display an error message
                            console.error('Error deleting techcategory: ' + xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'delete-techproduct.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('techcategory_id=' + techcategoryId);
            }
        });
    </script>

</body>

</html>