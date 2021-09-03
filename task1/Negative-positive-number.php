<?php
//check if form submit method get
if ($_GET) {
    // check number getter than 0 or not if getter than result positive else result negative
    if ($_GET['number'] > 0) {

        $result = "Positive number";
    } else {
        $result = "Negative  number";
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
        <div class="row mt-5  justify-content-center">
            <div class="col-5 ">
                <form method="Get" class="">
                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3">Negative or Postive Number </h4>

                    <!-------------------Get Number ------------------->

                    <div class="mb-3 d-inline-block w-75">

                        <input type="number" class="form-control" name="number" id="number"
                            placeholder="Plz Enter Your Number">
                    </div>


                    <!-------------------Print Result ------------------->

                    <div class="d-inline-block">
                        <input type="submit" class="btn btn-outline-primary">
                    </div>


                </form>

                <!-------------------Print Result ------------------->
                <?php
                if (isset($result)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The result is : $result
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