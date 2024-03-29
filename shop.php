<?php
$pageTitle = "Zay Shop - Product Listing Page";
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'components/externalcss.php'; ?>

<?php
include "config/db.php";
?>

<body>
    <!-- Header -->
    <?php include 'components/header.php'; ?>

    <!-- Start Content -->
    <div class="container py-5">
        <div class="row">

            <div class="col-lg-3">
                <h1 class="h2 pb-4">Categorias</h1>
                <ul class="list-unstyled templatemo-accordion">
                    <?php
                    // Fetch shopcategories from the database
                    $sql = "SELECT * FROM shopcategories WHERE parentId = 0";
                    $result = mysqli_query($conn, $sql);

                    if (mysqli_num_rows($result) > 0) {
                        // Loop through the parent shopcategories
                        while ($row = mysqli_fetch_assoc($result)) {
                            $parentCategoryId = $row['id'];
                            $parentCategoryName = $row['shopcategory'];

                            // Output the parent shopcategory
                            echo '<li class="pb-3">';
                            echo '<a class="collapsed d-flex justify-content-between h3 text-decoration-none" href="?shopcategory_id=' . $parentCategoryId . '">';
                            echo $parentCategoryName;
                            echo '<i class="fa fa-fw fa-chevron-circle-down mt-1"></i>';
                            echo '</a>';

                            // Fetch child shopcategories
                            $childSql = "SELECT * FROM shopcategories WHERE parentId = $parentCategoryId";
                            $childResult = mysqli_query($conn, $childSql);

                            if (mysqli_num_rows($childResult) > 0) {
                                echo '<ul class="collapse list-unstyled pl-3'; // Add show class here
                                // if ($_GET['parent_id'] == $parentCategoryId) {
                                //     echo ' d-block'; // Add show class if the shopcategory is active
                                // }
                                echo '">';

                                while ($childRow = mysqli_fetch_assoc($childResult)) {
                                    $childCategoryName = $childRow['shopcategory'];
                                    // Output the child shopcategory with a link
                                    echo '<li><a class="text-decoration-none" href="?shopcategory_id=' . $childRow['id'] . '">' . $childCategoryName . '</a></li>';
                                }
                                echo '</ul>';
                            }
                            echo '</li>';
                        }
                    }
                    ?>
                </ul>
            </div>

            <div class="col-lg-9">
                <div class="row">
                    <div class="col-md-6">
                        <ul class="list-inline shop-top-menu pb-3 pt-1">
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="shop.php">Todo</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none mr-3" href="#">Hombres</a>
                            </li>
                            <li class="list-inline-item">
                                <a class="h3 text-dark text-decoration-none" href="#">Mujeres</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 pb-4">
                        <div class="d-flex">
                            <select class="form-control" onchange="sortProducts(this.value)">
                                <option value="">Orden de los productos</option>
                                <option value="name_asc">A - Z</option>
                                <option value="price_asc">Menor Precio ↑</option>
                                <option value="price_desc">Mayor Precio ↓</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="product-container" class="row">
                    <?php
                    // Fetch shopproducts based on the current page and shopcategory
                    $shopcategoryFilter = isset ($_GET['shopcategory_id']) ? "AND shopcategory_id = {$_GET['shopcategory_id']}" : "";
                    $totalProductsSql = "SELECT COUNT(*) AS total FROM shopproducts WHERE 1 $shopcategoryFilter";
                    $page = isset ($_GET['page']) ? intval($_GET['page']) : 1;
                    $totalProductsResult = mysqli_query($conn, $totalProductsSql);
                    $totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
                    $limit = 9; // Number of shopproducts per page
                    $totalProducts = $totalProductsRow['total'];
                    $totalPages = ceil($totalProducts / $limit);
                    $offset = ($page - 1) * $limit; // Offset for pagination
                    
                    $sort = isset ($_GET['sort']) ? $_GET['sort'] : '';
                    $productSql = "SELECT * FROM shopproducts WHERE 1 $shopcategoryFilter";

                    // Apply sorting
                    if (!empty ($sort)) {
                        switch ($sort) {
                            case 'name_asc':
                                $productSql .= " ORDER BY shopproduct_name ASC";
                                break;
                            case 'price_asc':
                                $productSql .= " ORDER BY price ASC";
                                break;
                            case 'price_desc':
                                $productSql .= " ORDER BY price DESC";
                                break;
                        }
                    }

                    $productSql .= " LIMIT $limit OFFSET $offset";

                    

                    $productResult = mysqli_query($conn, $productSql);
                    // Display shopproducts
                    if (mysqli_num_rows($productResult) > 0) {
                        while ($productRow = mysqli_fetch_assoc($productResult)) {
                            // Output product HTML
                            ?>
                            <div class="col-md-4">
                                <div class="card mb-4 product-wap rounded-0">
                                    <div class="card rounded-0">
                                        <div class="card-img-container">
                                            <img class="card-img rounded-0 img-fluid"
                                                src="admin/uploads/<?php echo $productRow['image']; ?>">
                                        </div>
                                        <div
                                            class="card-img-overlay rounded-0 product-overlay d-flex align-items-center justify-content-center">
                                            <ul class="list-unstyled">
                                                <li><a class="btn btn-success text-white" href="shop-single.php"><i
                                                            class="far fa-heart"></i></a></li>
                                                <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i
                                                            class="far fa-eye"></i></a></li>
                                                <li><a class="btn btn-success text-white mt-2" href="shop-single.php"><i
                                                            class="fas fa-cart-plus"></i></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="card-body" style="height: 140px">
                                        <a href="shop-single.php" class="h3 text-decoration-none">
                                            <?php echo $productRow['shopproduct_name']; ?>
                                        </a>
                                        <ul class="w-100 list-unstyled d-flex justify-content-between mb-0">
                                            <li>M/L/X/XL</li>
                                            <li class="pt-2">
                                                <span
                                                    class="product-color-dot color-dot-red float-left rounded-circle ml-1"></span>
                                                <span
                                                    class="product-color-dot color-dot-blue float-left rounded-circle ml-1"></span>
                                                <span
                                                    class="product-color-dot color-dot-black float-left rounded-circle ml-1"></span>
                                                <span
                                                    class="product-color-dot color-dot-light float-left rounded-circle ml-1"></span>
                                                <span
                                                    class="product-color-dot color-dot-green float-left rounded-circle ml-1"></span>
                                            </li>
                                        </ul>
                                        <ul class="list-unstyled d-flex justify-content-center mb-1">
                                            <li>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-warning fa fa-star"></i>
                                                <i class="text-muted fa fa-star"></i>
                                            </li>
                                        </ul>
                                        <p class="text-center mb-0">$
                                            <?php echo $productRow['price']; ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo "<p>No shopproducts found.</p>";
                    }
                    ?>
                    <!-- End Products -->
                </div>


                <!-- Start Pages -->

                <div class="py-4">
                    <nav aria-label="Page navigation">
                        <ul class="pagination pagination-lg justify-content-end mb-0">
                            <?php if ($page > 1): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?php echo $page - 1 . (isset ($_GET['shopcategory_id']) ? '&shopcategory_id=' . $_GET['shopcategory_id'] : ''); ?>"
                                        tabindex="-1" aria-disabled="true"><i class="fas fa-angle-left"></i><span
                                            class="sr-only">Previous</span></a>
                                </li>
                            <?php endif; ?>
                            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link"
                                        href="?page=<?php echo $i . (isset ($_GET['shopcategory_id']) ? '&shopcategory_id=' . $_GET['shopcategory_id'] : ''); ?>">
                                        <?php echo $i; ?>
                                    </a>
                                </li>
                            <?php endfor; ?>
                            <?php if ($page < $totalPages): ?>
                                <li class="page-item">
                                    <a class="page-link"
                                        href="?page=<?php echo $page + 1 . (isset ($_GET['shopcategory_id']) ? '&shopcategory_id=' . $_GET['shopcategory_id'] : ''); ?>"><i
                                            class="fas fa-angle-right"></i><span class="sr-only">Next</span></a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </nav>
                </div>
                <!-- End Pages -->
            </div>

        </div>
    </div>
    <!-- End Content -->

    <!-- Start Brands -->
    <section class="bg-light py-5">
        <div class="container my-4">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Nuestras Marcas</h1>
                </div>
                <div class="col-lg-9 m-auto tempaltemo-carousel">
                    <div class="row d-flex flex-row">
                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="prev">
                                <i class="text-light fas fa-chevron-left"></i>
                            </a>
                        </div>
                        <!--End Controls-->

                        <!--Carousel Wrapper-->
                        <div class="col">
                            <div class="carousel slide carousel-multi-item pt-2 pt-md-0" id="templatemo-slide-brand"
                                data-bs-ride="carousel">
                                <!--Slides-->
                                <div class="carousel-inner product-links-wap" role="listbox">
                                    <!--First slide-->
                                    <div class="carousel-item active">
                                        <div class="row">
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_01.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_02.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_03.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End First slide-->

                                    <!--Second slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_04.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_05.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_06.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Second slide-->

                                    <!--Third slide-->
                                    <div class="carousel-item">
                                        <div class="row">
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_07.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_08.png" alt="Brand Logo"></a>
                                            </div>
                                            <div class="col-4 p-md-5">
                                                <a href="#"><img class="img-fluid brand-img"
                                                        src="assets/img/brand_09.png" alt="Brand Logo"></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--End Third slide-->
                                </div>
                                <!--End Slides-->
                            </div>
                        </div>

                        <!--End Carousel Wrapper-->

                        <!--Controls-->
                        <div class="col-1 align-self-center">
                            <a class="h1" href="#templatemo-slide-brand" role="button" data-bs-slide="next">
                                <i class="text-light fas fa-chevron-right"></i>
                            </a>
                        </div>
                        <!--End Controls-->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--End Brands-->

    <?php include 'components/footer.php'; ?>

    <?php include 'components/externaljs.php'; ?>

    <script>
        function sortProducts(sortBy) {
            // Redirect to the same page with a query parameter indicating the sorting option
            var currentUrl = window.location.href.split('?')[0]; // Get the current URL without query parameters
            window.location.href = currentUrl + (sortBy ? '?sort=' + sortBy : '');
        }
    </script>

</body>

</html>