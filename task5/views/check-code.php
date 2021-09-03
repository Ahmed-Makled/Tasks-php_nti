<?php
include_once "shared/header.php";
include_once "shared/navbar.php";
include_once "../models/user.model.php";
include_once "../controllers/auth/register.controllers.php";
if (!isset($_SESSION['check-code-email'])) {
    header('location:404.php');
}


if (isset($_POST['check-code'])) {
    $errors = [];
    if (empty($_POST['code'])) {
        $errors['code-requried'] = "<div class='alert alert-danger'> Code Is Required </div>";
    }
    if (empty($errors)) {
        $check = new user;
        $check->setEmail($_SESSION['check-code-email']);
        $check->setCode($_POST['code']);
        $checkResult = $check->checkCode();

        if ($checkResult) {

            $check->setStatus(1);
            $statusResult = $check->updateStatus();

            if ($statusResult) {

                $_SESSION['user'] = $checkResult->fetch_object();
                header('location:index.php');
                // print_r($page);
                // die;
            } else {
                $errors['something-wrong'] = "<div class='alert alert-danger'> something wrong...</div>";
            }
        } else {
            $errors['code-wrong'] = "<div class='alert alert-danger'> Wrong Code... </div>";
        }
    }
}

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Check Code</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Check Code</li>
            </ul>
        </div>
    </div>
</div>
<!-- Breadcrumb Area End -->
<div class="login-register-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 col-md-12 ml-auto mr-auto">
                <div class="login-register-wrapper">
                    <div class="login-register-tab-list nav">
                        <a class="active" data-toggle="tab" href="#lg1">
                            <h4> Check Code </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="code" placeholder="Code">
                                        <?php
                                        if (isset($errors)) {
                                            foreach ($errors as $error) {
                                                echo $error;
                                            }
                                        }

                                        ?>


                                        <div class="button-box">
                                            <button name="check-code" type="submit"><span>Check Code</span></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include_once "../views/shared/footer.php";
?>