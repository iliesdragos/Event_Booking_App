<?php
global  $mysqli;
require "../conectare.php";

$error='';
if(isset($_POST['submit']))
{
    $titlu = htmlentities($_POST['titlu'], ENT_QUOTES);
    $descriere = htmlentities($_POST['descriere'], ENT_QUOTES);
    $imagine = htmlentities($_POST['imagine'], ENT_QUOTES);
    $data_eveniment = htmlentities($_POST['data_eveniment'], ENT_QUOTES);
    $oras = htmlentities($_POST['oras'], ENT_QUOTES);
    $judet = htmlentities($_POST['judet'], ENT_QUOTES);
    $adresa = htmlentities($_POST['adresa'], ENT_QUOTES);
    $id_sponsor = htmlentities($_POST['id_sponsor'], ENT_QUOTES);
    $id_partener = htmlentities($_POST['id_partener'], ENT_QUOTES);
    $id_speaker = htmlentities($_POST['id_speaker'], ENT_QUOTES);
    $id_administrator = htmlentities($_POST['id_administrator'], ENT_QUOTES);

    if ($titlu == '' || $descriere == '' || $imagine == '' || $data_eveniment == '' || $oras == '' || $judet == '' || $adresa == '' || $id_sponsor == '' || $id_partener == '' || $id_speaker == '' || $id_administrator == '')
    {
        $error = 'ERROR: Campuri goale!';
    }
    else
    {
        $stmt = $mysqli -> prepare("INSERT into evenimente (titlu, descriere, imagine, data_eveniment, oras, judet, adresa, id_sponsor, id_partener, id_speaker, id_administrator) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssiiii", $titlu, $descriere, $imagine, $data_eveniment, $oras, $judet, $adresa, $id_sponsor, $id_partener, $id_speaker, $id_administrator);
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
        <strong>Titlu </strong> <input type="text" name="titlu" value=""/><br />
        <strong>Descriere </strong> <input type="text" name="descriere" value=""/><br />
        <strong>Imagine </strong> <input type="text" name="imagine" value=""/><br />
        <strong>Data eveniment </strong> <input type="date" name="data_eveniment" value=""/><br />
        <strong>Oras </strong> <input type="text" name="oras" value=""/><br />
        <strong>Judet </strong> <input type="text" name="judet" value=""/><br />
        <strong>Adresa </strong> <input type="text" name="adresa" value=""/><br />
        <strong>Id Sponsor </strong> <input type="text" name="id_sponsor" value=""/><br />
        <strong>Id Partener </strong> <input type="text" name="id_partener" value=""/><br />
        <strong>Id Speaker </strong> <input type="text" name="id_speaker" value=""/><br />
        <strong>Id Administrator </strong> <input type="text" name="id_administrator" value=""/><br />
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareEvenimente.php">Index</a>
    </div>
</form>
</body>
</html>
