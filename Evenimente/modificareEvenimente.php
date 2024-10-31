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
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            }
            else
            {
                if ($stmt = $mysqli->prepare("UPDATE evenimente SET titlu=?,descriere=?,imagine=?,data_eveniment=?,oras=?,judet=?,adresa=?,id_sponsor=?,id_partener=?,id_speaker=?,id_administrator=? WHERE id='" . $id . "'"))
                {
                    $stmt->bind_param("sssssssiiii", $titlu, $descriere, $imagine, $data_eveniment, $oras, $judet, $adresa, $id_sponsor, $id_partener, $id_speaker, $id_administrator);
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
            if ($result = $mysqli->query("SELECT * FROM evenimente where id='".$_GET['id']."'"))
            {
                if ($result->num_rows > 0)
                {
                    $row = $result->fetch_object();
                }
            }?>
        </p>
        <strong>Titlu </strong> <input type="text" name="titlu" value="<?php echo$row->titlu; ?>"/><br/>
        <strong>Descriere </strong> <input type="text" name="descriere" value="<?php echo$row->descriere; ?>"/><br/>
        <strong>Imagine </strong> <input type="text" name="imagine" value="<?php echo$row->imagine; ?>"/><br/>
        <strong>Data eveniment </strong> <input type="data" name="data_eveniment" value="<?php echo$row->data_eveniment; ?>"/><br/>
        <strong>Oras </strong> <input type="text" name="oras" value="<?php echo$row->oras; ?>"/><br/>
        <strong>Judet </strong> <input type="text" name="judet" value="<?php echo$row->judet; ?>"/><br/>
        <strong>Adresa </strong> <input type="text" name="adresa" value="<?php echo$row->adresa; ?>"/><br/>
        <strong>Id Sponsor </strong> <input type="text" name="id_sponsor" value="<?php echo$row->id_sponsor; ?>"/><br/>
        <strong>Id Partener </strong> <input type="text" name="id_partener" value="<?php echo$row->id_partener; ?>"/><br/>
        <strong>Id Speaker </strong> <input type="text" name="id_speaker" value="<?php echo$row->id_speaker; ?>"/><br/>
        <strong>Id Administrator </strong> <input type="text" name="id_administrator" value="<?php echo$row->id_administrator; ?>"/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareEvenimente.php">Index</a>
    </div>
</form>
</body>
</html>