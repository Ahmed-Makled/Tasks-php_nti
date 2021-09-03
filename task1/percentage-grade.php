<?php
if ($_GET) {

    // Calculate percentage 
    $percentage = ($_GET['Physics'] + $_GET['Chemistry'] + $_GET['Biology'] + $_GET['Mathematics'] + $_GET['Computer']) / 5;


    // Check grade 
    if ($percentage >= 90) {
        $result = "Grade A";
    } elseif ($percentage >= 80) {
        $result = "Grade B";
    } elseif ($percentage >= 70) {
        $result = "Grade C";
    } elseif ($percentage >= 60) {
        $result = "Grade D";
    } elseif ($percentage >= 40) {
        $result = "Grade E";
    } else {
        $result = "Grade F";
    }
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
        <div class="row mt-5 justify-content-center">
            <div class="col-5 ">
                <form method="Get" class="">
                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center">Calculate Percentage And
                        Grade
                    </h4>

                    <!-------------------Physics subject ------------------->

                    <div class="mb-3">
                        <label for="Physics" class="form-label">Physics</label>

                        <input type="number" class="form-control" name="Physics" id="Physics"
                            placeholder="Plz Enter Your subjects mark">
                    </div>
                    <!-------------------Chemistry subject ------------------->

                    <div class="mb-3">
                        <label for="Chemistry" class="form-label">Chemistry</label>

                        <input type="number" class="form-control" name="Chemistry" id="Chemistry"
                            placeholder="Plz Enter Your subjects mark">
                    </div>
                    <!-------------------Biology subject ------------------->

                    <div class="mb-3">
                        <label for="Biology" class="form-label">Biology</label>

                        <input type="number" class="form-control" name="Biology" id="Biology"
                            placeholder="Plz Enter Your subjects mark">
                    </div>
                    <!-------------------Mathematics subject ------------------->

                    <div class="mb-3">
                        <label for="Mathematics" class="form-label">Mathematics</label>

                        <input type="number" class="form-control" name="Mathematics" id="Mathematics"
                            placeholder="Plz Enter Your subjects mark">
                    </div>
                    <!-------------------Computer subject ------------------->

                    <div class="mb-3">
                        <label for="Computer" class="form-label">Computer</label>

                        <input type="number" class="form-control" name="Computer" id="Computer"
                            placeholder="Plz Enter Your subjects mark">
                    </div>

                    <!-------------------Submit Form ------------------->

                    <div class="mb-3">
                        <input type="submit" class="btn btn-outline-primary w-100">
                    </div>


                </form>
                <!-------------------Result ------------------->

                <?php
                if (isset($result)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The result is : 
                        <span class='fs-6 fw-bold text-primary'> $percentage&#37 $result</span>  
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