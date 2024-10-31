<?php
global  $mysqli;
require "../conectare.php";

$error='';
if(isset($_POST['submit']))
{
    $data_ora = htmlentities($_POST['data_ora'], ENT_QUOTES);
    $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
    $id_speaker = htmlentities($_POST['id_speaker'], ENT_QUOTES);

    if($data_ora == '' || $id_eveniment == '' || $id_speaker == '')
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        $stmt = $mysqli -> prepare("INSERT into agenda (data_ora, id_eveniment, id_speaker) VALUES (?, ?, ?)");
        $stmt->bind_param("sii", $data_ora, $id_eveniment, $id_speaker);
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
        <strong>Data si ora: </strong> <input type="datetime-local" name="data_ora" value=""/><br />
        <strong>Id-eveniment </strong> <input type="text" name="id_eveniment" value=""/><br />
        <strong>Id-speaker </strong> <input type="text" name="id_speaker" value=""/><br />
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareAgenda.php">Index</a>
    </div>
</form>
</body>
</html>
