<?php
if ($_GET) {
    if ($_GET['operation'] == 'min') {
        $opperation = $_GET['operation'];
        $result = minNumber($_GET['frist-number'], $_GET['second-number'], $_GET['third-number']);
    } else {
        $opperation = $_GET['operation'];
        $result = maxNumber($_GET['frist-number'], $_GET['second-number'], $_GET['third-number']);
    }
}


function maxNumber($x, $y, $z)
{

    if ($x > $y && $x > $z) {

        $maxNum = $x;
    } elseif ($y > $x && $y > $z) {
        $maxNum = $y;
    } else {
        $maxNum = $z;
    }


    return $maxNum;
}
function minNumber($x, $y, $z)
{

    if ($x < $y && $x < $z) {

        $minNum = $x;
    } elseif ($y < $x && $y < $z) {
        $minNum = $y;
    } else {
        $minNum = $z;
    }

    return $minNum;
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
            <div class="col-5  ">
                <form method="Get">
                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center">calculate max or min Number
                    </h4>

                    <!-------------------Frist Number ------------------->

                    <div class="mb-3">
                        <label for="frist-number" class="form-label">Frist Number</label>
                        <input type="number" class="form-control" name="frist-number" id="frist-number"
                            placeholder="Plz Enter Frist Number">
                    </div>
                    <!-------------------Second Number ------------------->

                    <div class="mb-3">
                        <label for="second-number" class="form-label">Second Number</label>
                        <input type="number" class="form-control" name="second-number" id="second-number"
                            placeholder="Plz Enter Second Number">
                    </div>
                    <!-------------------Third Number ------------------->

                    <div class="mb-3">
                        <label for="third-number" class="form-label">Third Number</label>
                        <input type="number" class="form-control" name="third-number" id="third-number"
                            placeholder="Plz Enter Third Number">
                    </div>
                    <!-------------------Choose Operation ------------------->

                    <div class="mb-3">
                        <select class="form-select" name="operation">
                            <option selected disabled>Choose Operation</option>
                            <option value="max">Get Max-Number</option>
                            <option value="min">Get Min-Number</option>
                        </select>
                    </div>
                    <!-------------------Submit Form ------------------->

                    <div class="mb-3 ">
                        <input type="submit" class="btn btn-outline-primary w-100">
                    </div>


                </form>
                <!-------------------Result ------------------->

                <?php
                if (isset($result)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The $opperation number is : $result
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