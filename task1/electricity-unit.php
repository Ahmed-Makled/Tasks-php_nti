<?php
if ($_GET) {

    $unit = $_GET['unit'];


    if ($unit <= 50) {
        $result = $unit * .50;
    } else if ($unit <= 150) {
        $result = $unit * .75;
    } else if ($unit <= 250) {
        $result = $unit * 1.20;
    } else {
        $result = $unit * 1.50;
    }
    $amount = $result + ($result * .2);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <style>
    .border-bottom {
        border-bottom: 1px dashed #dee2e6 !important;

    }
    </style>
</head>

<body>


    <div class="container">
        <div class="row mt-5 justify-content-center ">
            <div class="col-4 text-center ">
                <form method="Get">

                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3">Calculate Electricity Unit </h4>
                    <!-------------------Get unit ------------------->

                    <div class="mb-3 d-inline-block w-75">

                        <input type="number" class="form-control" name="unit" placeholder="Plz Enter Your unit">

                    </div>

                    <!-------------------Submit Form ------------------->

                    <div class="mb-3 d-inline-block ">
                        <input type="submit" class="btn btn-outline-primary">

                    </div>


                </form>
                <!-------------------Result ------------------->

                <?php
                if (isset($result)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The total amount is : 
                        <span class='fs-6 fw-bold text-primary'> $amount</span>  
                        </div>
                       ";
                }
                ?>


            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>