<?php
require_once "ShoppingCart.php";

error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Creare cos cumparaturi</title>
    <link href="style.css" type="text/css" rel="stylesheet">
    <script>
        function navigateToDestination() {
            window.location.href = '../client_panel.php';
        }
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E0E7E9;
            margin: 0;
            padding: 20px;
        }
        .product-grid{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 15px #A3C6C4;
            width: auto;
            height: auto;
        }

        h1 {
            text-align: center;
            color: #354649;
            margin-bottom: 40px;
        }

        .product-item{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: auto;
            margin-bottom: 10px;
            box-shadow: 0 4px 15px #A3C6C4;
            width: 30%;
            height: auto;
        }

        .product-image img{
            width: 35%;
            height: auto;
            border-radius: 4px;
        }

        .product-content{
            width: 65%;
            font-size: 20px;
        }

        .product-title{
            font-size: 40px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #354649;
        }

        .product-price{
            color: #354649;
        }

        .plasare-comanda a{
            color: #354649;
        }

        .cantitate{
            width: 30px;
            padding: 10px;
            font-size: 15px;

            border-radius: 4px;
            border-color: #6C7A89;

        }

        .btnAddAction{
            margin-top: 20px;
            padding: 15px;
            background-color: #6C7A89;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 11px;
        }

        .btnAddAction:hover{
            background-color: #354649 ;
            cursor: pointer;
        }

        .button-back {
            display: block;
            margin: auto;
            margin-top: 5%;
            padding: 10px;
            background-color: #6C7A89;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            height: 50px;

        }

        .button-back:hover {
            background-color: #354649;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="txt-heading">
        <h1>Cumpara Bilete la Eveniment</h1>
    </div>

    <?php
    $shoppingCart = new ShoppingCart();
    $query = "SELECT * FROM evenimente";
    $product_array = $shoppingCart->getAllProduct($query);

    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ?>
    <div id="product-grid">
            <div>
                <form method="post" action="cos.php?action=add" class="product-item">
                    <input type="hidden" name="code" value="<?php echo urlencode($product_array[$key]["code"]); ?>">

                    <div class="product-content">
                        <div class="product-title">
                            <strong><?php echo $product_array[$key]["titlu"]; ?></strong>
                        </div>
                        <div class="product-price"><a>Pret Bilet:</a> <strong><?php echo $product_array[$key]["pret_bilet"] ?></strong> Lei</div>
                        <div class="plasare-comanda">
                            <a>Cantitate: </a>
                            <input type="text" name="cantitate" value="1" size="2" class="cantitate"/>
                            <input type="submit" value="Adauga in cos" class="btnAddAction" />
                        </div>
                    </div>
                </form>
            </div>

            <?php
        }
    }
    ?>
    </div>

    <div>
        <input type="button" onclick="navigateToDestination()" value="Intoarce-te la pagina principala" class="button-back">
    </div>
</body>
</html>
