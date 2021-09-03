<?php


SESSION_start();
if ($_POST) {




    if (!empty($_POST['phone'])) {
        $phoneNumber = formatPhoneNumber($_POST['phone']);
        $_SESSION['phone'] = $phoneNumber;
        header('location:survey.php');
    } else {
        $err = "
    <div class='alert alert-success' role='alert'>
  <span class='fs-6 fw-bold text-danger'>
    You Must Be Enter Your Phone
     </span>  
  
  </div> ";
    }
}
function formatPhoneNumber($phoneNumber)
{
    $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);;
    if (strlen($phoneNumber) > 10) {
        $countryCode = substr($phoneNumber, 0, strlen($phoneNumber) - 10);
        $companyCode = substr($phoneNumber, -10, 3);
        $nextThree = substr($phoneNumber, -7, 3);
        $lastFour = substr($phoneNumber, -4, 4);
        $phoneNumber = '+' . $countryCode . ' (' . $companyCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 10) {
        $companyCode = substr($phoneNumber, 0, 3);
        $nextThree = substr($phoneNumber, 3, 3);
        $lastFour = substr($phoneNumber, 6, 4);
        $phoneNumber = '(' . $companyCode . ') ' . $nextThree . '-' . $lastFour;
    } else if (strlen($phoneNumber) == 7) {
        $nextThree = substr($phoneNumber, 0, 3);
        $lastFour = substr($phoneNumber, 3, 4);
        $phoneNumber = $nextThree . '-' . $lastFour;
    }
    return $phoneNumber;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Survey</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
    body {
        background: #000000;
        background-image: url(http://medicure-html.cmsmasters.net/images/image-2.jpg);
        background-size: cover;
        background-repeat: no-repeat;

    }

    input[name="phone"] {
        height: 70px;
        margin-bottom: 0;
        padding-right: 10px;
        padding-left: 28px;
        border: 2px solid #01b289;
        border-top-left-radius: 4px;
        border-bottom-left-radius: 4px;
        font-size: 16px;
        font-weight: 600;
        outline-style: none;

    }

    #button-addon2 {

        padding-right: 37px;
        padding-left: 37px;

        background-color: #00a37e;

        font-size: 14px;
        font-weight: 700;
        letter-spacing: .6px;
        text-transform: uppercase;
        color: #fff;
        outline-style: none;
        border: none;

    }

    .container {
        min-height: 100vh;
    }
    </style>
</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center mt-5 ">
            <div class="me-auto col-6 text-center mt-5 ">
                <form method="post" class="mt-5">
                    <!-------------------Title ------------------->
                    <div class="mb-3">
                        <img src="logo-hospital.png" alt="">
                    </div>

                    <!-------------------Get Number ------------------->

                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="phone" placeholder="Enter Your Phone Number"
                            aria-describedby="button-addon2">

                        <button type="submit" class="btn btn-outline-secondary" id="button-addon2">Survey</button>
                    </div>





                </form>
                <?php if (isset($err)) echo $err ?>

            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>