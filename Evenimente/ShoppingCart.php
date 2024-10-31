<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);


require_once "DBController.php";

class ShoppingCart extends DBController
{
    function getAllProduct()
    {
        $query = "SELECT * FROM evenimente";
        $productResult = $this->getDBResult($query);
        return $productResult;
    }

    function getMemberCartItem($id_users)
    {
        $query = "SELECT evenimente.*, bilete.id, bilete.cantitate 
              FROM evenimente 
              INNER JOIN bilete ON evenimente.id = bilete.id_eveniment 
              WHERE bilete.id_users = ?";

        $params = array(array("param_type" => "i", "param_value" => $id_users));
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function getProductByCode($code)
    {
        $decoded_code = urldecode($code);
        $query = "SELECT * FROM evenimente WHERE code=?";
        $params = array(array("param_type" => "s", "param_value" => $decoded_code));
        $productResult = $this->getDBResult($query, $params);
        return $productResult;
    }

    function getCartItemByProduct($id_eveniment, $id_users)
    {
        $query = "SELECT * FROM bilete WHERE id_eveniment = ? AND id_users = ?";
        $params = array(
            array("param_type" => "i", "param_value" => $id_eveniment),
            array("param_type" => "i", "param_value" => $id_users)
        );
        $cartResult = $this->getDBResult($query, $params);
        return $cartResult;
    }

    function addToCart($id_eveniment, $cantitate, $id_users)
    {
        $query = "INSERT INTO bilete (id_eveniment, cantitate, id_users) VALUES (?, ?, ?)";
        $params = array(
            array("param_type" => "i", "param_value" => $id_eveniment),
            array("param_type" => "i", "param_value" => $cantitate),
            array("param_type" => "i", "param_value" => $id_users)
        );

        // Insert the new item into the cart
        $this->updateDB($query, $params);
    }


    function updateCartQuantity($cantitate, $cart_id)
    {
        $query = "UPDATE bilete SET cantitate = ? WHERE id = ?";
        $params = array(
            array("param_type" => "i", "param_value" => $cantitate),
            array("param_type" => "i", "param_value" => $cart_id)
        );
        $this->updateDB($query, $params);
    }

    function deleteCartItem($cart_id)
    {
        $query = "DELETE FROM bilete WHERE id = ?";
        $params = array(array("param_type" => "i", "param_value" => $cart_id));
        $this->updateDB($query, $params);
    }

    function emptyCart($id_users)
    {
        $query = "DELETE FROM bilete WHERE id_users = ?";
        $params = array(array("param_type" => "i", "param_value" => $id_users));
        $this->updateDB($query, $params);
    }
}
?>
