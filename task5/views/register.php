<?php
include_once "shared/header.php";
include_once "../middlewares/Guards/un-auth.php";
include_once "shared/navbar.php";
include_once "../models/user.model.php";
include_once "../controllers/auth/register.controllers.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';


if ($_POST) {
    $errors = [];
    $validation = new registerControllers;

    $validation->setPassword($_POST['user-password']);
    $validation->setconfirmPassword($_POST['confirm-password']);
    $passwordValidationResult = $validation->validationPassowrd();
    $validation->setEmail($_POST['user-email']);
    $emailValidationResult = $validation->emailValidation();
    //instert to database
    if (empty($emailValidationResult) and empty($passwordValidtionResult)) {
        $user = new User;
        $user->setEmail($_POST['user-email']);
        $emailExistResult = $user->emailCheck();
        if ($emailExistResult) {
            $errors['email'] = "<div class='alert alert-danger'> Email Already Exists </div>";
        } else {
            $code = rand(10000, 99999);
            $user->setName($_POST['user-name']);
            $user->setPhone($_POST['user-phone']);
            $user->setPassword($_POST['user-password']);
            $user->setGender($_POST['user-gender']);
            $user->setCode($code);
            $inserResult = $user->insertData();
            if ($inserResult) {
                $mail = new PHPMailer(true);
                try {
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'phpnti300100@gmail.com';                     //SMTP username
                    $mail->Password   = 'Nti300100';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                    $mail->setFrom('phpnti300100@gmail.com', 'Ecommerce');
                    $mail->addAddress($_POST['user-email']);     //Add a recipient
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Verification Code';
                    $mail->Body    = "Dear {$_POST['user-name']},<br>Your Veification code:<b>$code</b><br>Thank You.";
                    $mail->send();
                    $_SESSION['check-code-email'] = $_POST['user-email'];
                    header('location:check-code.php?page=register');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $errors['someThing'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
            }
        }
    }
}

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Register</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">register</li>
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
                            <h4> register </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg2" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="text" name="user-name" placeholder="Username" value="<?php if (isset($_POST['user-name'])) {
                                                                                                                echo $_POST['user-name'];
                                                                                                            } ?>">
                                        <input type="text" name="user-phone" placeholder="Phone" value="<?php if (isset($_POST['user-phone'])) {
                                                                                                            echo $_POST['user-phone'];
                                                                                                        } ?>">
                                        <input name="user-email" placeholder="Email" type="email" value="<?php if (isset($_POST['user-email'])) {
                                                                                                                echo $_POST['user-email'];
                                                                                                            } ?>">

                                        <?php
                                        if (isset($errors['email'])) {
                                            echo $errors['email'];
                                        }
                                        if (isset($emailValidationResult) && !empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        } ?>

                                        <input type="password" name="user-password" placeholder="Password">

                                        <input type="password" name="confirm-password" placeholder="confirm-password">
                                        <?php if (isset($passwordValidationResult) && !empty($passwordValidationResult)) {
                                            foreach ($passwordValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        } ?>
                                        <select name="user-gender" class="form-control">
                                            <option
                                                <?= (isset($_POST['user-gender']) && $_POST['user-gender'] == 'm') ? 'selected' : '' ?>
                                                value="m">Male</option>
                                            <option
                                                <?= (isset($_POST['user-gender']) && $_POST['user-gender'] == 'f') ? 'selected' : '' ?>
                                                value="f">Female</option>
                                        </select>
                                        <div class="button-box mt-2">
                                            <button type="submit"><span>Register</span></button>
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
<!-- Footer style Start -->
<?php include_once "shared/footer.php" ?>