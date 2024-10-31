<?php
global  $mysqli;
include("../conectare.php");

$error='';
if (!empty($_POST['id']))
{
    if (isset($_POST['submit']))
    {
        if (is_numeric($_POST['id']))
        {
            $id = $_POST['id'];
            $pret = htmlentities($_POST['pret'], ENT_QUOTES);
            $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
            $id_client = htmlentities($_POST['id_client'], ENT_QUOTES);
            if ($pret == '' || $id_eveniment == '' || $id_client == '')
            {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else
            {
                if ($stmt = $mysqli->prepare("UPDATE bilete SET pret=?,id_eveniment=?,id_client=? WHERE id='" . $id . "'"))
                {
                    $stmt->bind_param("dii", $pret, $id_eveniment, $id_client);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
        else
        {
            echo "ERROR: nu se poate executa update.";
        }
    }
    else
    {
        echo "id incorect!";
    }
}
else
{
    echo "id incorect!";
}
?>
<html>
<head>
    <title> <?php if ($_GET['id'] != '') { echo "Modificare inregistrare"; }?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8">
</head>
<body>
<h1><?php if ($_GET['id'] != '') { echo "Modificare Inregistrare"; }?></h1>
<?php
if ($error != '')
{
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";
}
?>
<form action="" method="post">
    <div>
        <?php if ($_GET['id'] != '') ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'];?>" />
        <p>ID: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM bilete where id='".$_GET['id']."'"))
            {
                if ($result->num_rows > 0)
                {
                    $row = $result->fetch_object();
                }
            }?>
        </p>
        <strong>Pret: </strong> <input type="text" name="pret" value="<?php echo$row->pret; ?>"/><br/>
        <strong>Id_eveniment </strong> <input type="text" name="id_eveniment" value="<?php echo$row->id_eveniment; ?>"/><br/>
        <strong>Id_client </strong> <input type="text" name="id_client" value="<?php echo$row->id_client; ?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareBilete.php">Index</a>
    </div>
</form>
</body>
</html>