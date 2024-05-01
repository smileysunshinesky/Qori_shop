<?php
$pageTitle = "Zay Shop - Shopproduct Listing Page";
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
                <form action="shopproductmanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="shopproduct_name" class="col-form-label">Shopproduct Name:</label>
                            <input type="text" class="form-control" id="shopproduct_name" name="shopproduct_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="price" class="col-form-label">Price:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="price" type="number" id="price" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" required>
                            </div>
                            <!-- <input type="number" class="form-control" id="shopproduct_name" required min="1"> -->
                        </div>
                        <div class="mb-3">
                            <label for="shopcategory" class="col-form-label">Category:</label>
                            <select class="form-select" id="shopcategory1" name="shopcategory1" aria-label="Category1" required>
                                <?php
                                $sql = "SELECT * FROM shopcategories";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                // Initialize an array to hold shopcategories grouped by parent IDs
                                $shopcategoriesByParent = array();

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the shopcategories and group them by parent ID
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $shopcategory_id = $row['id'];
                                        $shopcategory = $row['shopcategory'];
                                        $parentId = $row['parentId'];

                                        // If parentId is 0, it's a parent shopcategory
                                        if ($parentId == 0) {
                                            // Add the parent shopcategory to the shopcategoriesByParent array
                                            $shopcategoriesByParent[$shopcategory_id]['name'] = $shopcategory;
                                        } else {
                                            // If parentId is not 0, it's a child shopcategory
                                            // Check if the parent shopcategory exists in shopcategoriesByParent array
                                            if (isset ($shopcategoriesByParent[$parentId])) {
                                                // Add the child shopcategory to the parent shopcategory's children array
                                                $shopcategoriesByParent[$parentId]['children'][] = array('id' => $shopcategory_id, 'name' => $shopcategory);
                                            }
                                        }
                                    }

                                    // Loop through the grouped shopcategories and output optgroup labels and options
                                    foreach ($shopcategoriesByParent as $parentCategoryId => $parentCategory) {
                                        $parentCategoryName = $parentCategory['name'];
                                        // Output the optgroup label for parent shopcategory
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
                        <input class="btn btn-secondary btn-success" type="submit" name="addshopproduct"
                            value="Add New Shopproduct">
                        <!-- <button type="button" class="btn btn-primary">Send message</button> -->
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="editShopproduct" tabindex="-1" aria-labelledby="editShopproductLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editShopproductLabel">Edit Shopproduct</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="shopproductmanage.php" method="post" enctype="multipart/form-data" class="border-secondary">
                    <div class="modal-body">
                        <input type="hidden" id="edit_shopproduct_id" name="edit_shopproduct_id">
                        <div class="mb-3">
                            <label for="edit_shopproduct_name" class="col-form-label">Shopproduct Name:</label>
                            <input type="text" class="form-control" id="edit-shopproduct-name" name="edit_shopproduct_name" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_shopproduct_price" class="col-form-label">Price:</label>
                            <div class="input-group mb-3">
                                <span class="input-group-text">$</span>
                                <input name="edit_shopproduct_price" type="number" id="edit-shopproduct-price" class="form-control"
                                    aria-label="Amount (to the nearest dollar)" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="edit_shopproduct_shopcategory" class="col-form-label">Category:</label>
                            <select class="form-select" id="edit-shopproduct-shopcategory" name="edit_shopproduct_shopcategory" aria-label="Category1" required>
                                <?php
                                $sql = "SELECT * FROM shopcategories";
                                $result = mysqli_query($conn, $sql) or die ('Database query error!');

                                // Initialize an array to hold shopcategories grouped by parent IDs
                                $shopcategoriesByParent = array();

                                if (mysqli_num_rows($result) > 0) {
                                    // Loop through the shopcategories and group them by parent ID
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $shopcategory_id = $row['id'];
                                        $shopcategory = $row['shopcategory'];
                                        $parentId = $row['parentId'];

                                        // If parentId is 0, it's a parent shopcategory
                                        if ($parentId == 0) {
                                            // Add the parent shopcategory to the shopcategoriesByParent array
                                            $shopcategoriesByParent[$shopcategory_id]['name'] = $shopcategory;
                                        } else {
                                            // If parentId is not 0, it's a child shopcategory
                                            // Check if the parent shopcategory exists in shopcategoriesByParent array
                                            if (isset ($shopcategoriesByParent[$parentId])) {
                                                // Add the child shopcategory to the parent shopcategory's children array
                                                $shopcategoriesByParent[$parentId]['children'][] = array('id' => $shopcategory_id, 'name' => $shopcategory);
                                            }
                                        }
                                    }

                                    // Loop through the grouped shopcategories and output optgroup labels and options
                                    foreach ($shopcategoriesByParent as $parentCategoryId => $parentCategory) {
                                        $parentCategoryName = $parentCategory['name'];
                                        // Output the optgroup label for parent shopcategory
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
                            <label for="edit_shopproduct_description" class="col-form-label">Description:</label>
                            <textarea class="form-control" name="edit_shopproduct_description" id="edit-shopproduct-description"></textarea>
                        </div>
                        <div class="mb-3 row">
                            <div class='col-md-4'>
                                <a href='#' class='imagepreview mr-3'>
                                    <img alt='Image placeholder' id="edit-shopproduct-image"
                                        src=''>
                                </a>
                            </div>
                            <div class="col-md-8">
                                <label for="editimage">Image:</label>
                                <input type="file" name="editimage" id="edit-shopproduct-imageval" accept="image/*" value="" />

                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input class="btn btn-secondary btn-success" type="submit" name="editshopproduct"
                            value="Edit Shopproduct">
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
                            <h2 class="mb-3">Shopproducts</h2>
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
                                                        $totalRecordsQuery = "SELECT COUNT(*) AS total FROM shopproducts";
                                                        $totalRecordsResult = mysqli_query($conn, $totalRecordsQuery);
                                                        $totalRecordsRow = mysqli_fetch_assoc($totalRecordsResult);
                                                        $totalRecords = $totalRecordsRow['total'];

                                                        // Calculate total number of pages
                                                        $totalPages = ceil($totalRecords / $recordsPerPage);

                                                        // Modify your SQL query to fetch records for the current page
                                                        $sql = "SELECT * FROM shopproducts LIMIT $start, $recordsPerPage";
                                                        $result = mysqli_query($conn, $sql);

                                                        if (mysqli_num_rows($result) > 0) {
                                                            // Loop through the shopcategories and display them
                                                            while ($row = mysqli_fetch_assoc($result)) {
                                                                $shopproduct = $row['shopproduct_name'];
                                                                $price = $row['price'];
                                                                $shopcategory_id = $row['shopcategory_id'];
                                                                $description = $row['description'];
                                                                $shopproduct_image = $row['image'];
                                                                $shopproduct_id = $row['id'];
                                                                $shopcategory_query = mysqli_query($conn, "SELECT * FROM shopcategories WHERE id = $shopcategory_id");
                                                                $shopcategory_row = mysqli_fetch_assoc($shopcategory_query);
                                                                $shopcategory = $shopcategory_row['shopcategory']; // Retrieve the shopcategory name from the parent shopcategory query result
                                                                echo "
                                                                <tr>
                                                                    
                                                                    <th scope='row'>
                                                                        <div class='media align-items-center'>
                                                                            <a href='#' class='avatar rounded-circle mr-3'>
                                                                                <img alt='Image placeholder'
                                                                                    src='uploads/$shopproduct_image'>
                                                                            </a>
                                                                        </div>
                                                                    </th>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$shopproduct</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                    <span class='badge badge-dot mr-4'>
                                                                    <i class='bg-warning'></i> {$price} USD
                                                                    </span>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$shopcategory</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class='media-body'>
                                                                            <span class='mb-0 text-sm'>$description</span>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <a class='btn btn-sm btn-icon-only text-primary edit-shopproduct' href='#' role='button' 
                                                                        data-bs-toggle='modal' data-bs-target='#editShopproduct'
                                                                        data-bs-whatever='@mdo' data-shopproduct-id='{$shopproduct_id}' edit-shopproduct-image='{$shopproduct_image}' edit-shopproduct-name='{$shopproduct}' edit-shopproduct-price='{$price}' edit-shopproduct-shopcategory='{$shopcategory_id}' edit-shopproduct-description='{$description}'>
                                                                            <i class='fas fa-edit'></i>
                                                                        </a>
                                                                        <a class='btn btn-sm btn-icon-only text-danger delete-shopproduct' href='#' role='button' data-shopproduct-id='{$shopproduct_id}'>
                                                                            <i class='fas fa-trash-alt'></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>";
                                                            }
                                                        } else {
                                                            echo "<tr><td colspan='2'>No shopcategories found.</td></tr>";
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
            // Edit Shopproduct
            var editButtons = document.querySelectorAll('.edit-shopproduct');
            editButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var shopcategoryId = button.getAttribute('data-shopproduct-id');
                    var shopproductname = button.getAttribute('edit-shopproduct-name');
                    var shopproductimage = button.getAttribute('edit-shopproduct-image');
                    var shopproductprice = button.getAttribute('edit-shopproduct-price');
                    var shopproductshopcategory = button.getAttribute('edit-shopproduct-shopcategory');
                    var shopproductdescription = button.getAttribute('edit-shopproduct-description');

                    document.getElementById('edit_shopproduct_id').value = shopcategoryId;
                    document.getElementById('edit-shopproduct-name').value = shopproductname;
                    document.getElementById('edit-shopproduct-image').setAttribute('src', 'uploads/' + shopproductimage);
                    // document.getElementById('edit-shopproduct-imageval').value = shopproductimage;
                    document.getElementById('edit-shopproduct-price').value = shopproductprice;
                    document.getElementById('edit-shopproduct-shopcategory').value = shopproductshopcategory;
                    document.getElementById('edit-shopproduct-description').value = shopproductdescription;
                    // var editShopproductImageVal = document.getElementById('edit-shopproduct-imageval');
                    // if (editShopproductImageVal) {
                    //     editShopproductImageVal.value = shopproductimage;
                    // }
                    console.log(shopcategoryId + shopproductshopcategory);
                });
            });

            // Delete Shopproduct
            var deleteButtons = document.querySelectorAll('.delete-shopproduct');

            deleteButtons.forEach(function (button) {
                button.addEventListener('click', function (event) {
                    event.preventDefault();
                    var shopcategoryId = button.getAttribute('data-shopproduct-id');
                    if (confirm("Are you sure you want to delete this shopcategory?")) {
                        deleteCategory(shopcategoryId);
                    }

                });
            });

            function deleteCategory(shopcategoryId) {
                // Send an AJAX request to delete-shopproduct.php with the shopcategory ID
                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function () {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            // If deletion is successful, reload the page
                            // location.reload();
                            $successMessage = "Successfully Deleted!";
                            location.href = "shopproducts.php?successMessage=" + $successMessage;
                        } else {
                            // If there's an error, display an error message
                            console.error('Error deleting shopcategory: ' + xhr.status);
                        }
                    }
                };
                xhr.open('POST', 'delete-shopproduct.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhr.send('shopcategory_id=' + shopcategoryId);
            }
        });
    </script>

</body>

</html>