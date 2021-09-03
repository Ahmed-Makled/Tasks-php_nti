<?php

$data = [

    "tableHead" => [
        "QUESTIONS",
        "BAD (0)",
        "GOOD (3)",
        "VERRY GOOD (5)",
        "EXCELLENT  (10)"

    ],

    "tableBody" => [
        "questtions" => [
            "q1" => "ARE YOU SATISFIED ABOUT CLEANING",
            "q2" => "ARE YOU SATISFIED ABOUT SERVICES",
            "q3" => "ARE YOU SATISFIED ABOUT NURSING",
            "q4" => "ARE YOU SATISFIED ABOUT DOCTORS'LEVES",
            "q5" => "ARE YOU SATISFIED ABOUT QUIET IN HOSPITAL"
        ],
        "rate" => [
            "bad" => "0",
            "good" => "3",
            "verry good" => "5",
            "excellent" => "10",

        ]

    ]



];
function CreateTable($array)
{
    $table = "
    <table class='table  table-hover bg-body mb-0'>
    <thead>
        <tr>
        ";
    foreach ($array as $key => $value) {
        if ($key == "tableHead") {
            foreach ($value as $index => $val) {
                $table .= "<th  scope='col'>$val</th>";
            };
            $table .= "
            </tr>
           </thead>
           <tbody>
           ";
        }
        if ($key == "tableBody") {
            $table .= '<tr>';
            foreach ($value['questtions'] as $keyquesttion => $questtion) {
                $table .= "<th scope='row' >$questtion</th>";
                foreach ($value['rate'] as $keyRate => $rate) {
                    $table .= "<td><input type='radio'name='$keyquesttion' value='$rate'></td>";
                }
                $table .= '</tr>';
            }
        }
    };

    $table .=  '</tbody> </table>';
    return $table;
};


session_start();

if ($_POST) {


    if (isset($_POST['q1']) && isset($_POST['q2']) && isset($_POST['q3']) && isset($_POST['q4']) && isset($_POST['q5'])) {
        $_SESSION['result'] = $_POST;


        header('location:result.php');
    } else {

        $err = "
    <div class='alert alert-success' role='alert'>
  <span class='fs-6 fw-bold text-danger'>
    You Must Be Survey All Question
     </span>  
  
  </div> ";
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
        background: #134E5E;
        /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #71B280, #134E5E);
        /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #71B280, #134E5E);
        /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }

    h4 {
        font-size: 3.5rem;
        color: aliceblue;
        text-transform: uppercase;

    }

    .border-bottom {
        border-bottom: 1px dashed #dee2e6 !important;

    }

    td {
        text-align: center;
    }

    tr {
        line-height: 3rem;
    }

    .btn-success {
        font-size: 1.3rem;
        letter-spacing: .1rem;
        font-weight: 900;
    }
    </style>
</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center ">
            <div class="col-12  font-monospace">
                <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3 text-center">Survey Application </h4>

                <form method="post">
                    <?php echo CreateTable($data);
                    ?>
                    <div class="mb-3  ">
                        <input type="submit" class="btn btn-success w-100">
                    </div>

                </form>

                <?php
                if (isset($err)) {
                    echo $err;
                };
                ?>

            </div>
        </div>
    </div>






    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>