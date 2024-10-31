<?php
global  $mysqli;
include("../Conectare.php");
$error='';
if (isset($_POST['submit']))
{
// preluam datele de pe formular
    $companie = htmlentities($_POST['companie'], ENT_QUOTES);
    $email = htmlentities($_POST['email'], ENT_QUOTES);
    $nr_telefon = htmlentities($_POST['nr_telefon'], ENT_QUOTES);
    $CUI = htmlentities($_POST['CUI'], ENT_QUOTES);
// verificam daca sunt completate
    if ($companie == '' || $email == ''|| $nr_telefon==''|| $CUI=='')
    {
// daca sunt goale se afiseaza un mesaj
        $error = 'ERROR: Campuri goale!';
    } else {
// insert
        if ($stmt = $mysqli->prepare("INSERT into sponsori (companie, email, nr_telefon, CUI) VALUES (?, ?, ?, ?)"))
        {
            $stmt->bind_param("ssss", $companie, $email,$nr_telefon,$CUI);
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
        <strong>Companie: </strong> <input type="text" name="companie" value=""/><br/>
        <strong>Email: </strong> <input type="email" name="email" value=""/><br/>
        <strong>Nr. telefon: </strong> <input type="text" name="nr_telefon" value=""/><br/>
        <strong>CUI: </strong> <input type="text" name="CUI" value=""/><br/>
        <br/>
        <input type="submit" name="submit" value="Submit" />
        <a href="VizualizareSponsori.php">Index</a>
    </div>
</form>
</body>
</html>
