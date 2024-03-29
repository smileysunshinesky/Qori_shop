<?php
$pageTitle = "Qori";
?>
<!DOCTYPE html>
<html lang="en">

<?php include 'components/externalcss.php'; ?>

<body>
    
    
    <?php include 'components/header.php'; ?>

    <!-- Start Banner Hero -->
    <div id="template-mo-zay-hero-carousel" class="carousel slide" data-bs-ride="carousel">
        <ol class="carousel-indicators">
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="1"></li>
            <li data-bs-target="#template-mo-zay-hero-carousel" data-bs-slide-to="2"></li>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_logo_01.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left align-self-center">
                                <h1 class="h1 text-success"><b>Qori</b> company</h1>
                                <h3 class="h2">Los mejores precios del mercado</h3>
                                <p>
                                    En <b>Qori Company</b>, nos dedicamos a la importación de productos de la
                                    más alta calidad, comprometidos a ofrecer a nuestros usuarios los precios más
                                    competitivos del mercado.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_celulares_01.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Marcas reconocidas</h1>
                                <h3 class="h2">Todo lo excelente en un unico lugar</h3>
                                <p>
                                    En nuestro catálogo, encontrarás una amplia gama de productos de primera calidad,
                                    con precios inigualables en el mercado nacional.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <div class="container">
                    <div class="row p-5">
                        <div class="mx-auto col-md-8 col-lg-6 order-lg-last">
                            <img class="img-fluid" src="./assets/img/banner_marcas_03.png" alt="">
                        </div>
                        <div class="col-lg-6 mb-0 d-flex align-items-center">
                            <div class="text-align-left">
                                <h1 class="h1">Productos de Calidad Garantizada</h1>
                                <h3 class="h2">Encuentra Todo lo que Necesitas Aquí</h3>
                                <p>
                                    Te ofrecemos una amplia selección de productos de primera calidad. En nuestra
                                    empresa, nos esforzamos por brindarte la mejor experiencia de compra, con atención
                                    personalizada y precios irresistibles. ¡No esperes más para descubrir lo que tenemos
                                    para ti!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev text-decoration-none w-auto ps-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="prev">
            <i class="fas fa-chevron-left"></i>
        </a>
        <a class="carousel-control-next text-decoration-none w-auto pe-3" href="#template-mo-zay-hero-carousel"
            role="button" data-bs-slide="next">
            <i class="fas fa-chevron-right"></i>
        </a>
    </div>
    <!-- End Banner Hero -->


    <!-- Start Categories of The Month -->
    <section class="container py-5">
        <div class="row text-center pt-3">
            <div class="col-lg-6 m-auto">
                <h1 class="h1">¿Que ofrecemos?</h1>
                <p>
                    Ofrecemos una amplia variedad de productos en tecnología, negocios y moda y para
                    adaptarnos mejor a tus necesidades nos hemos diversificado. Así podemos brindarte
                    una atención más personalizada y satisfacer tus gustos e intereses. </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/banner_tecnologia_01.png"
                        class="rounded-circle img-fluid border"></a>
                <p class="text-center"><a class="btn btn-success">Ver mas</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/banner_shop_01.png" class="rounded-circle img-fluid border"></a>
                <p class="text-center"><a class="btn btn-success">Ver mas</a></p>
            </div>
            <div class="col-12 col-md-4 p-5 mt-3">
                <a href="#"><img src="./assets/img/banner_negocios_02.png" class="rounded-circle img-fluid border"></a>
                <p class="text-center"><a class="btn btn-success">Ver mas</a></p>
            </div>
        </div>
    </section>
    <!-- End Categories of The Month -->


    <!-- Start Featured Product -->
    <section class="bg-light">
        <div class="container py-5">
            <div class="row text-center py-3">
                <div class="col-lg-6 m-auto">
                    <h1 class="h1">Destacados</h1>
                    <p>
                        Entre la amplia variedad de productos disponibles en nuestro inventario, hemos identificado
                        aquellos que destacan por
                        su alta demanda continua y constante entre nuestros clientes, lo cual refleja su calidad y
                        relevancia en el contexto
                        de las preferencias y exigencias.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php">
                            <img src="./assets/img/feature_prod_01.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">S/. 2200.00</li>
                            </ul>
                            <a href="shop-single.php" class="h2 text-decoration-none text-dark">iPhone 14 pro max</a>
                            <p class="card-text">
                                Con diseño elegante, ofrece una experiencia única con su avanzada tecnología, potente
                                rendimiento e interfaz intuitiva.
                            </p>
                            <p class="text-muted">Reviews (27)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php">
                            <img src="./assets/img/feature_prod_02.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-muted fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">S/. 280.00</li>
                            </ul>
                            <a href="shop-single.php" class="h2 text-decoration-none text-dark">Guess Noelle
                                Crossbody</a>
                            <p class="card-text">
                                Guess Noelle Crossbody: Elegancia y funcionalidad en un diseño compacto y sofisticado.
                            </p>
                            <p class="text-muted">Reviews (48)</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="shop-single.php">
                            <img src="./assets/img/feature_prod_03.jpg" class="card-img-top" alt="...">
                        </a>
                        <div class="card-body">
                            <ul class="list-unstyled d-flex justify-content-between">
                                <li>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                    <i class="text-warning fa fa-star"></i>
                                </li>
                                <li class="text-muted text-right">S/. 160.00</li>
                            </ul>
                            <a href="shop-single.php" class="h2 text-decoration-none text-dark">Nike Air Force 1
                                MCA</a>
                            <p class="card-text">
                                Nike Air Force 1 MCA: Icono de estilo y comodidad en un diseño moderno y versátil,
                                perfecto para cualquier ocasión.
                            </p>
                            <p class="text-muted">Reviews (74)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End Featured Product -->

    <?php include 'components/footer.php'; ?>

    <?php include 'components/externaljs.php'; ?>

</body>
<!-- test change -->

</html>