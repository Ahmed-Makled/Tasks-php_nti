<?php
if ($_GET) {
    $number = $_GET['number'];
    $root = $_GET['root'];

    $calc =  $number **  (1 / $root);
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
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center"> Calculate Specific Root
                        Number </h4>
                    <!-------------------Get Number ------------------->

                    <div class="mb-3 ">
                        <input type="number" class="form-control" name="number" id="number"
                            placeholder="Plz Enter Your Number">
                    </div>
                    <!-------------------Get Root ------------------->

                    <div class="mb-3 ">
                        <input type="number" class="form-control" name="root" id="root"
                            placeholder="Plz Enter Root Number">
                    </div>

                    <!-------------------Submit Form ------------------->


                    <div class="mb-3 ">
                        <input type="submit" class="btn btn-outline-primary  w-100">
                    </div>


                </form>
                <!-------------------result ------------------->

                <?php
                if (isset($calc)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The root of <span class='fs-6 fw-bold text-danger'>$number</span>  is : 
                        <span class='fs-6 fw-bold text-primary'> $calc</span>  
                      </div> ";
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