<?php
include_once "shared/header.php";
include_once "shared/navbar.php";
include_once "../controllers/auth/register.controllers.php";
include_once "../controllers/auth/login.controllers.php";
include_once "../models/user.model.php";



use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/autoload.php';
if (isset($_POST['login'])) {

    $errors = [];
    $emailValidation = new registerControllers;
    $emailValidation->setEmail($_POST['user-email']);

    $emailValidationResult = $emailValidation->emailValidation();
    $validationPassowrd = new loginControllers;
    $validationPassowrd->setPassword($_POST['user-password']);

    $validationPassowrdResult = $validationPassowrd->validationPassowrd();

    if (empty($emailValidationResult) and empty($validationPassowrdResult)) {

        $checkUser = new user;
        $checkUser->setEmail($_POST['user-email']);
        $checkUser->setPassword($_POST['user-password']);
        $loginResult = $checkUser->login();

        if ($loginResult) {
            $loggedInUser = $loginResult->fetch_object();


            if ($loggedInUser->status == 1) {
                $_SESSION['user'] = $loggedInUser;
                header('location:index.php');
            } elseif ($loggedInUser->status == 2) {
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
                    $mail->Body    = "Dear $loggedInUser->name,<br>Your Veification code:<b>$loggedInUser->code</b><br>Thank You.";
                    $mail->send();
                    $_SESSION['check-code-email'] = $_POST['user-email'];
                    header('location:check-code.php?page=login');
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        } else {

            $errors['authentication-failed'] = "<div class='alert alert-danger'> Athentication Login Failed </div>";
        }
    }
}

?>
<!-- Breadcrumb Area Start -->
<div class="breadcrumb-area bg-image-3 ptb-150">
    <div class="container">
        <div class="breadcrumb-content text-center">
            <h3>LOGIN</h3>
            <ul>
                <li><a href="index.html">Home</a></li>
                <li class="active">Login</li>
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
                            <h4> login </h4>
                        </a>
                    </div>
                    <div class="tab-content">
                        <div id="lg1" class="tab-pane active">
                            <div class="login-form-container">
                                <div class="login-register-form">
                                    <form action="#" method="post">
                                        <input type="text" name="user-email" placeholder="Email">
                                        <?php
                                        if (!empty($emailValidationResult)) {
                                            foreach ($emailValidationResult as $key => $error) {
                                                echo $error;
                                            }
                                        }
                                        ?>
                                        <input type="password" name="user-password" placeholder="Password">
                                        <?php
                                        if (!empty($validationPassowrdResult)) {
                                            foreach ($validationPassowrdResult as $key => $error) {
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
                                            <div class="login-toggle-btn">
                                                <!-- <input type="checkbox"> -->
                                                <!-- <label>Remember me</label> -->
                                                <a href="verify-email.php">Forgot Password?</a>
                                            </div>
                                            <button name="login" type="submit"><span>Login</span></button>
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