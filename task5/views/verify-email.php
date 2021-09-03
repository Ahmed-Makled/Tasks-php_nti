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
if (isset($_POST['verify-email'])) {

    $errors = [];
    $emailValidation = new registerControllers;
    $emailValidation->setEmail($_POST['user-email']);
    $emailValidationResult = $emailValidation->emailValidation();
    if (empty($emailValidationResult)) {
        $checkEmail = new user;
        $checkEmail->setEmail($_POST['user-email']);
        $checkEmailResult = $checkEmail->emailCheck();
        if ($checkEmailResult) {
            $forgetPasswordUser = $checkEmailResult->fetch_object();
            $code = rand(10000, 99999);
            $checkEmail->setCode($code);
            $updateCodeResult = $checkEmail->updateCode();
            if ($updateCodeResult) {
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
                    $mail->Body    = "Dear $forgetPasswordUser->name,<br>Your Veification code:<b>$code</b><br>Thank You.";
                    $mail->send();
                    $_SESSION['check-code-email'] = $_POST['user-email'];
                    header('location:check-code.php?page=verify');
                } catch (Exception $ex) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            } else {
                $errors['something-wrong'] = "<div class='alert alert-danger'> Something Went Wrong </div>";
            }
        } else {
            $errors['wrong-email'] = "<div class='alert alert-danger'> Email dosen't exists in our records </div>";
        }
    }
}
?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>Verify Email</h3>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li class="active">Verify Email</li>
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
                            <h4> Verify Email </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form method="post">
                                        <input type="email" name="user-email" placeholder="Email">
                                        <?php
                                        if (!empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        }

                                        if (!empty($errors)) {
                                            foreach ($errors as $key => $error) {
                                                echo $error;
                                            }
                                        }


                                        ?>
                                        <div class="button-box">
                                            <button name="verify-email" type="submit"><span>Verify Email</span></button>
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