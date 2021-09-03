<?php
if ($_POST) {

    $fristNumber = $_POST['frist-number'];
    $secondNumber = $_POST['second-number'];
    $operator = $_POST['operator'];
    switch ($operator) {
        case "+":
            $result = $fristNumber + $secondNumber;
            break;
        case "-":
            $result = $fristNumber - $secondNumber;
            break;
        case "*":
            $result = $fristNumber * $secondNumber;
            break;
        case "/":
            $result = $fristNumber / $secondNumber;
        case "%":
            $result = $fristNumber % $secondNumber;
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
        <div class="row mt-5 justify-content-center ">
            <div class="col-4  ">
                <form method="Post">
                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center"> Calculator</h4>
                    <!-------------------Get frist Number  ------------------->

                    <div class="mb-3 ">
                        <label for="frist-number" class="form-label">Frist Number </label>

                        <input type="number" class="form-control" name="frist-number" id="frist-number"
                            placeholder="Plz Enter Your Frist Number">
                    </div>
                    <!-------------------Get frist Number  ------------------->

                    <div class="mb-3 ">
                        <label for="second-number" class="form-label">Second Number </label>

                        <input type="number" class="form-control" name="second-number" id="second-number"
                            placeholder="Plz Enter Your Second Number">
                    </div>

                    <!-------------------Submit Form ------------------->

                    <div class="mb-3 ">

                        <input type="submit" name="operator" value="+" class="btn btn-outline-primary mx-1 px-4">


                        <input type="submit" name="operator" value="-" class="btn btn-outline-primary mx-1 px-4">


                        <input type="submit" name="operator" value="*" class="btn btn-outline-primary mx-1 px-4">


                        <input type="submit" name="operator" value="/" class="btn btn-outline-primary mx-1 px-4">


                        <input type="submit" name="operator" value="%" class="btn btn-outline-primary mx-1 px-4">


                    </div>


                </form>
                <!-------------------result ------------------->

                <?php
                if (isset($result)) {


                    echo "
                        <div class='alert alert-success' role='alert'>
                        The Result of
                        <span class='fs-6 fw-bold text-dark'>    
                        &nbsp $fristNumber $operator $secondNumber = 
                         </span>  
 
                        <span class='fs-6 fw-bold text-danger'> $result</span>  
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