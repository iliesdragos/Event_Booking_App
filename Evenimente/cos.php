<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "ShoppingCart.php";

session_start();

// Redirect to the login page if the user is not logged in.
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.html');
    exit;
}

// Get the member ID for registered members
$id_users = $_SESSION['loggedin'];

$shoppingCart = new ShoppingCart();

// Check for "add" action
if (!empty($_GET["action"]) && $_GET["action"] == "add") {
    // Check if the product code is set in the POST data
    if (!empty($_POST["code"])) {
        $productResult = $shoppingCart->getProductByCode($_POST["code"]);
        $cartResult = $shoppingCart->getCartItemByProduct($productResult[0]["id"], $id_users);

        if (!empty($cartResult)) {
            // Update quantity in the cart
            $newQuantity = $cartResult[0]["cantitate"] + $_POST["cantitate"];
            $shoppingCart->updateCartQuantity($newQuantity, $cartResult[0]["id"]);
        } else {
            // Add to the cart table
            $shoppingCart->addToCart($productResult[0]["id"], $_POST["cantitate"], $id_users);
        }
    }
} elseif (!empty($_GET["action"])) {
    switch ($_GET["action"]) {
        case "remove":
            // Delete a single record
            $shoppingCart->deleteCartItem($_GET["id"]);
            break;
        case "empty":
            // Empty the cart
            $shoppingCart->emptyCart($id_users);
            break;
        case "abandon":
            // Abandon the cart for the current user
            $shoppingCart->emptyCart($id_users);
            header('Location: ../logout.php'); // Redirect to logout after abandoning the cart
            break;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Creare cos permament in PHP</title>
    <script>
        document.getElementById('sendEmailBtn').addEventListener('click', function() {
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'send_email.php', true);
            xhr.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    alert('Email trimis cu succes!');
                }
            };
            xhr.send();
        });
    </script>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #E0E7E9;
            margin: 0;
            padding: 0;
        }

        #shopping-cart {
            max-width: 600px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 15px #A3C6C4;
        }

        .txt-heading {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            color: #6C7A89;
        }

        .txt-heading-label {
            font-size: 24px;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .button{
            display: block;
            background-color: #6C7A89;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 20px;
        }

        .button:hover{
            background-color: #354649;
        }

        a {
            display: inline-block;
            margin-top: 10px;
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
        }

        a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>
<div id="shopping-cart">
    <div class="txt-heading">
        <div class="txt-heading-label">Cos Cumparaturi</div>
        <a id="btnEmpty" href="cos.php?action=empty"><input type=button  value="Goleste Cosul" class="button"/></a>
    </div>

    <?php
    $cartItem = $shoppingCart->getMemberCartItem($id_users);
    if (!empty($cartItem)) {
        $item_total = 0;
        ?>
        <table cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align: left;"><strong>Eveniment</strong></th>
                <th style="text-align: right;"><strong>Numar de bilete</strong></th>
                <th style="text-align: right;"><strong>Pret</strong></th>
            </tr>
            <?php
            foreach ($cartItem as $item) {
                ?>
                <tr>
                    <td style="text-align: left; border-bottom: #F0F0F0 1px solid;"><strong><?php echo $item["titlu"]; ?></strong></td>
                    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["cantitate"]; ?></td>
                    <td style="text-align: right; border-bottom: #F0F0F0 1px solid;"><?php echo $item["pret_bilet"]. " Lei"; ?></td>
                </tr>
                <?php
                $item_total += ($item["pret_bilet"] * $item["cantitate"]);
            }
            ?>
            <tr>
                <td colspan="2" align=right><strong>Total:</strong></td>
                <td style="text-align: right; font-weight: bold"><?php echo $item_total . " Lei"; ?></td>
            </tr>
            </tbody>
        </table>
        <form class="" action="send_email.php" method="post">
            <button type="submit" name="send" class="button">Plaseaza comanda</button>
        </form>
    <?php } ?>
</div>
<div style="text-align: center">
    <a href="magazin.php" style="color: #354649">Alegeti alt produs</a>
</div>
<div style="text-align: center">
    <a href="cos.php?action=abandon" style="color: #354649">Abandonati sesiunea de cumparare</a>
</div>
</body>
</html>
