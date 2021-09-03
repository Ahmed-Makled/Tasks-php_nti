<?php

session_start();

$data = $_SESSION['result'];
$phone = $_SESSION['phone'];





function resultSurvey($resultData, $phoneNumber)
{
    $result = $resultData['q1'] + $resultData['q2'] + $resultData['q3'] + $resultData['q4'] + $resultData['q5'];

    $result >= 25 ? $mssg = "<div class='alert alert-primary'>Thankyou For you Response!</div>" :  $mssg = "<div class='alert alert-danger'> we get back to you on  $phoneNumber  </div>";

    return $mssg;
};
function totalReview($resultData)
{
    $result = $resultData['q1'] + $resultData['q2'] + $resultData['q3'] + $resultData['q4'] + $resultData['q5'];
    $result >= 25 ? $totoal = "Good" :  $totoal  = "Bad";


    return  $totoal;
};

function creatReview($resultData)
{
    switch ($resultData) {
        case "0":
            return      $Review = "bad";
            break;
        case "3":
            return       $Review = "good";
            break;
        case "5":
            return    $Review = "verry good";
            break;
        case "10":
            return $Review = "excellent";
            break;
        default:
    }
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


        background-image: url(bg.png);
        background-repeat: no-repeat;






    }

    /* .container {
        background-color: #fff;
    } */

    .border-bottom {
        border-bottom: 1px dashed #dee2e6 !important;

    }

    tr {
        line-height: 40px;
    }
    </style>
</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center ">
            <div class="col-12  font-monospace">
                <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center">Result Survey </h4>

                <form method="post">
                    <!-------------------Title ------------------->
                    <table class="table  table-hover shadow-sm   bg-body rounded">
                        <thead class="bg-dark bg-gradient text-light">
                            <tr>
                                <th scope='col'>QUESTIONS</th>

                                <th scope='col '>Review</th>

                            </tr>
                        </thead>
                        <tbody class="text-muted">
                            <tr>
                                <th scope='row'>ARE YOU SATISFIED ABOUT CLEANING</th>


                                <td><?php echo creatReview($data["q1"]) ?></td>

                            </tr>
                            <tr>
                                <th scope='row'>ARE YOU SATISFIED ABOUT SERVICES</th>
                                <td><?php echo  creatReview($data["q2"]) ?></td>


                            </tr>
                            <tr>
                                <th scope='row'>ARE YOU SATISFIED ABOUT NURSING</th>
                                <td><?php echo  creatReview($data["q3"]) ?></td>


                            </tr>
                            <tr>
                                <th scope='row'>ARE YOU SATISFIED ABOUT DOCTORS'LEVES</th>
                                <td><?php echo  creatReview($data["q4"]) ?></td>


                            </tr>
                            <tr>
                                <th scope='row'>ARE YOU SATISFIED ABOUT QUIET IN HOSPITAL</th>
                                <td><?php echo  creatReview($data["q5"]) ?></td>


                            </tr>
                            <tr class="bg-dark bg-gradient text-light">
                                <th scope='row'>Total Review</th>
                                <td class="fw-bold "><?php echo  totalReview($data) ?></td>


                            </tr>
                        </tbody>
                    </table>


                </form>
                <?php echo resultSurvey($data, $phone); ?>
            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>