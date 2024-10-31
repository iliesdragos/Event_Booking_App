<?php
global  $mysqli;
include("../Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $nume = htmlentities($_POST['nume'], ENT_QUOTES);
    $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
    $username = htmlentities($_POST['username'], ENT_QUOTES);
    $parola = htmlentities($_POST['parola'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $nr_telefon = htmlentities($_POST['nr_telefon'], ENT_QUOTES);
    $status = htmlentities($_POST['status'], ENT_QUOTES);
// verificam daca sunt completate
    if ($nume == '' || $prenume == ''|| $username=='' || $parola=='' || $email=='' || $nr_telefon=='' || $status=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into users (nume, prenume, username, parola, email, nr_telefon, status) VALUES (?, ?, ?, ?, ?, ?, ?)"))
        {
            $stmt->bind_param("ssssssi", $nume, $prenume,$username, $parola,$email,$nr_telefon, $status);
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
        <strong>Nume: </strong> <input type="text" name="nume" value=""/><br/>
        <strong>Prenume: </strong> <input type="text" name="prenume" value=""/><br/>
        <strong>Username: </strong> <input type="text" name="username" value=""/><br/>
        <strong>Parola: </strong> <input type="password" name="parola" value=""/><br/>
        <strong>Email: </strong> <input type="email" name="email" value=""/><br/>
        <strong>Nr. telefon: </strong> <input type="text" name="nr_telefon" value=""/><br/>
        <strong>Status: </strong> <input type="text" name="status" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="vizualizareUsers.php">Index</a>
    </div>
</form>
</body>
</html>
