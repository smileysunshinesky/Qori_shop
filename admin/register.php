<?php require_once "usercontroller.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Signup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/auth.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-4 offset-md-4 form">
                <form action="register.php" method="POST" autocomplete="">
                    <h2 class="text-center"><span
                            class="align-middle">Signup</span></h2>
                    <p class="text-center">It's quick and easy.</p>
                    <?php
                    if (count($errors) == 1) {
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach ($errors as $showerror) {
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    } elseif (count($errors) > 1) {
                        ?>
                        <div class="alert alert-danger">
                            <?php
                            foreach ($errors as $showerror) {
                                ?>
                                <li>
                                    <?php echo $showerror; ?>
                                </li>
                                <?php
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
                    <div class="input-group mb-3">
                        <input class="form-control" type="text" name="name" placeholder="Full Name" required
                            value="<?php echo $name ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="email" name="email" placeholder="Email Address" required
                            value="<?php echo $email ?>">
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="input-group mb-3">
                        <input class="form-control" type="password" name="cpassword" placeholder="Confirm password"
                            required>
                    </div>
                    <div class="input-group mb-3 row">
                        <div class="col-md-5">
                            <input class="form-control button" type="submit" name="signup" value="Signup">
                        </div>
                        <div class="col-md-2"></div>
                        <div class="col-md-5">
                            <a class="form-control btn btn-secondary" href="../" role="button">Back Home</a>
                        </div>
                        <!-- <input class="form-control button" type="" name="" value="Back home"> -->
                    </div>
                    <div class="link login-link text-center">Already a member? <a href="login.php">Login here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>

</html>