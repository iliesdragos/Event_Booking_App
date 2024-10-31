<?php
global  $mysqli;
require "../conectare.php";

$error='';
if(isset($_POST['submit']))
{
    $pret = htmlentities($_POST['pret'], ENT_QUOTES);
    $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
    $id_client = htmlentities($_POST['id_client'], ENT_QUOTES);

    if($pret == '' || $id_eveniment == '' || $id_client == '')
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        $stmt = $mysqli -> prepare("INSERT into bilete (pret, id_eveniment, id_client) VALUES (?, ?, ?)");
        $stmt->bind_param("dii", $pret, $id_eveniment, $id_client);
        $stmt->execute();
        $stmt->close();
    }
}
$mysqli->close();
?>

<head>
    <title> <?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php
if($error != '')
{
    echo "<div style='padding: 4px; border: 1px solid red; color:red'>" . $error. "</div>";
}
?>
<form action="" method="post">
    <div>
        <strong>Pret: </strong> <input type="text" name="pret" value=""/><br />
        <strong>Id-eveniment </strong> <input type="text" name="id_eveniment" value=""/><br />
        <strong>Id-client </strong> <input type="text" name="id_client" value=""/><br />
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareBilete.php">Index</a>
    </div>
</form>
</body>
</html>
