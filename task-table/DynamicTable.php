<?php




$users = [
    (object)[
        'id' => 1,
        'name' => 'ahmed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'football', 'swimming', 'running'
        ],
        'activities' => [
            "school" => 'drawing',
            'home' => 'painting'
        ],
        'email' => "a@live.com"
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'email' => "a@live.com"
    ],
    (object)[
        'id' => 2,
        'name' => 'mohamed',
        "gender" => (object)[
            'gender' => 'm'
        ],
        'hobbies' => [
            'swimming', 'running',
        ],
        'activities' => [
            "school" => 'painting',
            'home' => 'drawing'
        ],
        'email' => "a@live.com"
    ]

];

function CreateDynamicTable($data)
{

    //Create table Element with start table head
    $table = "
    <table class='table table-hover font-monospace fs-6 shadow-sm rounded' >
    <thead class='table-dark'>
    <tr>
    ";

    /*
    *Create cell of table head
    * Loop Data of index 0 and 
    * return $property
    */
    foreach ($data[0] as $property => $value) {

        $table .= "<th  scope='col'>$property</th>";
    }
    //clos tag tr , table head and start table body
    $table .= "
      </tr>
     </thead>
     <tbody>
     ";
    /*
    *Create table body content
    * Loop All Data
    */
    foreach ($data as $index => $objects) {
        //start table row
        $table .= '<tr>';
        /*
        *Create content of table row
        * Loop oF Data data value
        * return
        */
        foreach ($objects as $property => $value) {
            //start table tada
            $table .= "<td>";
            if (gettype($value) != 'array' && gettype($value) != 'object') {
                $table .= $value;
            } else {
                foreach ($value as $key => $val) {
                    if ($property == 'gender') {
                        $val =    $val == "m" ? "Male" : "Female";
                        // print_r($val);
                        // die;
                    }

                    $table .= $val . ' ';
                }
            }
            //close table tada
            $table .= '</td>';
        }
        //close table row
        $table .= '</tr>';
    } // die;
    //close table body and table element
    $table .=  '</tbody> </table>';
    return $table;
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


    <div class="container mt-5">
        <div class="row">
            <div class="col-12">

                <?php
                echo CreateDynamicTable($users);

                ?>

            </div>
        </div>
    </div>





    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>