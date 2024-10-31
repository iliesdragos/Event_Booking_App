<?php
global  $mysqli;
include("../conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $nume_prenume = htmlentities($_POST['nume_prenume'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $nr_telefon = htmlentities($_POST['nr_telefon'], ENT_QUOTES);
// verificam daca sunt completate
    if ($nume_prenume == '' || $email == ''|| $nr_telefon=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into speakeri (nume_prenume, email, nr_telefon) VALUES (?, ?, ?)"))
        {
            $stmt->bind_param("sss", $nume_prenume, $email,$nr_telefon);
            $stmt->execute();
            $stmt->close();
        }
// eroare le inserare
        else
        {
            echo "ERROR: Nu se poate executa insert.";
        }
    }
}
// se inchide conexiune mysqli
$mysqli->close();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head> <title><?php echo "Inserare inregistrare"; ?> </title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head> <body>
<h1><?php echo "Inserare inregistrare"; ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error."</div>";} ?>
<form action="" method="post">
    <div>
        <strong>Nume si Prenume: </strong> <input type="text" name="nume_prenume" value=""/><br/>
        <strong>Email: </strong> <input type="email" name="email" value=""/><br/>
        <strong>Nr. telefon: </strong> <input type="text" name="nr_telefon" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="VizualizareSpeakeri.php">Index</a>
    </div>
</form>
</body>
</html>