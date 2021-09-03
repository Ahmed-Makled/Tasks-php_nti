<?php


SESSION_start();
if ($_POST) {
    if (isset($_POST['products'])) {

        $userName = $_POST['userName'];
        $numberProduct = $_POST['numberProducts'];
        $city = $_POST['city'];
        $_SESSION['info'] = [
            "userName" => $userName,
            "numberProduct" => $numberProduct,
            "city" => $city
        ];
    }
    if (isset($_POST['receipt'])) {

        $numberProduct = $_SESSION['info']['numberProduct'];
        $_SESSION['products'] = $_POST;
    }
}

function createReceipt($data)
{
    $table = "<table class='table text-start'>

    <tbody>
        <tr>
            <th scope='row'>Client Name</th>
            <td>";

    $table .= $data['userName'];

    $table .= "</td>

        </tr>
        <tr>
            <th scope='row'>City</th><td>";

    $table .= $data['city'];

    $table .= "</td>
                </tr>
            <tr>
        
            <th scope='row' class='table-info'>Total</th><td>";

    $table .=  PriceProducts($data);

    $table .= " </td>
        </tr>
        <tr>
            <th scope='row' class='table-danger'>Discount</th> <td>";

    $table .=   getDiscount(PriceProducts($data));
    $table .=  "EGP</td></tr><tr>
            <th scope='row'>Total After Discount</th> <td>";

    $table .= PriceProducts($data) -  getDiscount(PriceProducts($data));
    $table .= "
           EGP</td>
        </tr>
        <tr>
            <th scope='row'>Delivery Fees </th>";
    $deliveryFees =    deliveryFees($data['city']);

    $table .= "<td>$deliveryFees</tr>
        <tr>
            <th scope='row' class='table-success'>Total price </th><td>";
    $table .= (PriceProducts($data) -  getDiscount(PriceProducts($data))) + deliveryFees($data['city']);
    $table .= "     
             EGP</td>
        </tr>
    </tbody>
</table>";
    return $table;
}

function getDiscount($total)
{
    if ($total <= 1000) {
        $discount = $total * 0;
    } elseif ($total <= 3000) {
        $discount = $total * .10;
    } elseif ($total <= 4500) {
        $discount = $total * .15;
    } elseif ($total > 4500) {
        $discount = $total * .20;
    }
    return $discount;
}
function deliveryFees($city)
{
    // print_r($city);
    // die;
    switch ($city) {
        case "cairo":
            $deliver = 0;
            break;
        case "giza":
            $deliver = 30;
            break;
        case "alex":

            $deliver = 50;
            break;
        default:
            $deliver = 100;
            break;
    }
    return $deliver;
}
function PriceProducts($data)
{
    $total = 0;

    for ($x = 0; $x < $data['numberProduct']; $x++) {

        $total += ($_SESSION['products']["productPrice_$x"] * $_SESSION['products']["productQuantity_$x"]);
    }
    return $total;
}


function createTable($numberProduct)
{

    $table = "
    
    <form method='POST'>
    <table class='table'>
    <thead>
        <tr>
            <th scope='col'>Product Name</th>
            <th scope='col'>Price</th>
            <th scope='col'>Quantites</th>
        </tr>
    </thead>
    <tbody>

    ";


    for ($i = 0; $i < $numberProduct; $i++) {

        isset($_SESSION['products']["productName_$i"]) ? $productName = $_SESSION['products']["productName_$i"] : $productName = '0';
        isset($_SESSION['products']["productPrice_$i"]) ? $productPrice = $_SESSION['products']["productPrice_$i"] : $productPrice = '0';
        isset($_SESSION['products']["productQuantity_$i"]) ? $productQuantity = $_SESSION['products']["productQuantity_$i"] : $productQuantity = '0';

        $table .= "<tr>
        <td>   <input name='productName_$i' value='$productName'type='text' class='form-control placeholder=''>  </td>
        <td>   <input name='productPrice_$i' value='$productPrice' type='number' class='form-control placeholder=''>  </td>
        <td>   <input name='productQuantity_$i' value='$productQuantity'  type='number' class='form-control placeholder='' > </td>
        </tr>";
    }



    $table .= " 
                    </tbody>
                    </table>
                    <!-------------------Submit Form receipt ------------------->

                    <div class='mb-3   '>
                        <input type='submit' name='receipt' class='btn btn-outline-primary w-100'
                            value='receipt'>
                    </div>

                    </form>
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
    .border-bottom {
        border-bottom: 1px dashed #dee2e6 !important;

    }
    </style>
</head>


<body>


    <div class="container">
        <div class="row mt-5 justify-content-center ">
            <div class="col-6 text-center ">
                <form method="post">
                    <!-------------------Title ------------------->
                    <h4 class=" mb-3 fw-bold font-monospace border-bottom pb-3">SuperMarket </h4>

                    <!-------------------Get userName ------------------->


                    <div class="form-floating mb-3">
                        <input type="text" name="userName" class="form-control" id="floatingInput"
                            placeholder="EnterUserName"
                            value="<?php if (isset(($_SESSION['info']['userName'])) && !empty($_SESSION['info']['userName'])) echo $_SESSION['info']['userName']; ?>">
                        <label for="floatingInput">User Name</label>
                    </div>

                    <!-------------------Get amount ------------------->

                    <div class="mb-3  ">

                        <div class="form-floating">
                            <select name='city' class="form-select" id="floatingSelect"
                                aria-label="Floating label select example">
                                <option <?php
                                        if (
                                            isset(($_SESSION['info']['userName'])) && $_SESSION['info']['city'] == 'cairo'
                                        )
                                            echo 'selected';
                                        ?> value="cairo">Cairo</option>
                                <option <?php
                                        if (
                                            isset(($_SESSION['info']['userName'])) && $_SESSION['info']['city'] == 'giza'
                                        ) {
                                            echo 'selected';
                                        }
                                        ?> value="giza">Giza</option>
                                <option <?php
                                        if (
                                            isset(($_SESSION['info']['userName'])) && $_SESSION['info']['city'] == 'alex'
                                        ) {
                                            echo 'selected';
                                        }
                                        ?> value="alex">Alex</option>
                                <option <?php
                                        if (
                                            isset(($_SESSION['info']['userName'])) && $_SESSION['info']['city'] == 'other'
                                        ) {
                                            echo 'selected';
                                        }
                                        ?> value="other">Other</option>
                            </select>
                            <label for="floatingSelect">Open this select City</label>
                        </div>
                    </div>

                    <!-------------------Get Number Of Products ------------------->


                    <div class="form-floating mb-3">
                        <input type="number" name="numberProducts" class="form-control" id="floatingInput"
                            placeholder="Enter Number Of Products"
                            value="<?php if (isset(($_SESSION['info']['userName'])) && !empty($_SESSION['info']['numberProduct'])) echo $_SESSION['info']['numberProduct']; ?>">
                        <label for="floatingInput">Number Of Products</label>
                    </div>

                    <!-------------------Submit Form Products------------------->

                    <div class="mb-3   ">
                        <input type="submit" name="products" class="btn btn-outline-primary w-100"
                            value="Enter Products">
                    </div>


                </form>
                <?php if (isset($_POST['products'])) echo createTable($numberProduct);
                ?>
                <?php if (isset($_POST['receipt'])) {
                    echo createTable($numberProduct);
                    echo createReceipt($_SESSION['info']);
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