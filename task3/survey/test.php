<?php
SESSION_start();
if ($_POST) {

    $_SESSION['comment'] = $_POST['comment'];
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

</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center  ">
            <div class=" col-6 text-center ">
                <form method="post">

                    <!-------------------Get Number ------------------->

                    <div class="mb-3">
                        <textarea class="form-control" name='comment' rows="3">
                        <?php if (isset($_SESSION['comment'])) echo $_SESSION['comment']; ?>
                        </textarea>
                    </div>
                    <button type="submit" class="btn btn-outline-secondary">comment</button>
                </form>


            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>