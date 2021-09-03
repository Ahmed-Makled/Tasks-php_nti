<?php



SESSION_start();
if ($_POST) {
    $userName = $_POST['userName'];
    $amount = $_POST['amount'];
    $years = $_POST['years'];


    $calcLoan = calcLoan($amount, $years);
    $tableResult = createTable($calcLoan);
}
function calcLoan($amount, $years)
{

    // 10% * years ,  15%
    $years < 3 ? $interestRate = ($amount * .1) * $years : $interestRate = ($amount * .15) * $years;
    $amountAfterInterest = $amount + $interestRate;
    $monthly = $amountAfterInterest / ($years * 12);
    return ["interestRate" => $interestRate, "amountAfterInterest" => $amountAfterInterest, "monthly" => $monthly];
}

function createTable($calcLoan)
{
    $table = "<table class='table bg-light shadow  rounded '>
    <thead class='table-secondary '>
        <tr>
            <th scope='col'>interest Rate</th>
            <th scope='col'>amount After Interest</th>
            <th scope='col'>monthly</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class='fw-bold'> ";

    if (isset($calcLoan['interestRate']))    $table .= $calcLoan['interestRate'];

    $table .= "</td> <td class='fw-bold'>";
    if (isset($calcLoan['amountAfterInterest']))  $table .= $calcLoan['amountAfterInterest'];
    $table .= "</td> <td class='fw-bold'>";
    if (isset($calcLoan['monthly'])) $table .= $calcLoan['monthly'];

    $table .= " </tr>
                    </tbody>
                    </table>
                    ";
    return $table;
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
        background-image: url(bank-bg.jpg);

        background-position: top left;
        background-repeat: no-repeat;
    }

    h4 {
        color: #cddc39;
        font-size: 3.75em;
        letter-spacing: -0.8px;
    }


    tr {
        line-height: 2rem;
    }
    </style>
</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center ">
            <div class="col-6  ">
                <form method="post">
                    <!-------------------Title ------------------->

                    <div class="mb-3   text-center">
                        <h4 class="  fw-bold font-monospace ">LOAN APPLICATION
                        </h4>
                        <img src="http://webdesign-finder.com/winance/wp-content/uploads/2018/03/pattern-120x20.png"
                            alt="http://webdesign-finder.com/winance/wp-content/uploads/2018/03/pattern-120x20.png"
                            width="120" height="20">
                    </div>
                    <!-------------------Get UserName ------------------->



                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="userName" name="userName"
                            placeholder="EnterUserName">

                        <label for="userName">User Name</label>
                    </div>
                    <!-------------------Get amount ------------------->



                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="amount" name="amount" placeholder="amount">

                        <label for="amount">Amount</label>
                    </div>
                    <!-------------------Get Years ------------------->


                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="years" name="years" placeholder="years">

                        <label for="years">Years</label>
                    </div>
                    <div class="mb-3   ">
                        <input type="submit" name="result" class="btn btn-warning w-100" value="Calcluate">
                    </div>


                </form>
                <div class="row">
                    <div class="col">
                        <?php if (isset($_POST['result'])) echo $tableResult ?>

                    </div>
                </div>

            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>