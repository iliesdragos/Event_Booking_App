<?php
global $mysqli;
include("../conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume_prenume = htmlentities($_POST['nume_prenume'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $nr_telefon = htmlentities($_POST['nr_telefon'], ENT_QUOTES);

            if ($nume_prenume == '' || $email == '' || $nr_telefon == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE speakeri SET nume_prenume=?, email=?, nr_telefon=? WHERE id='" . $id . "'")) {
                    $stmt->bind_param("sss", $nume_prenume, $email, $nr_telefon);
                    $stmt->execute();
                    $stmt->close();
                } else {
                    echo "ERROR: nu se poate executa update.";
                }
            }
        } else {
            echo "id incorect!";
        }
    }
}
?>

<html>
<head>
    <title><?php if (isset($_GET['id']) && $_GET['id'] != '') { echo "Modificare inregistrare"; } ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
</head>
<body>
<h1><?php if (isset($_GET['id']) && $_GET['id'] != '') { echo "Modificare Inregistrare"; } ?></h1>
<?php if ($error != '') {
    echo "<div style='padding:4px; border:1px solid red; color:red'>" . $error . "</div>";
} ?>
<form action="" method="post">
    <div>
        <?php if (isset($_GET['id']) && $_GET['id'] != '') { ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>" />
            <p>Speaker Id: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM speakeri where id='" . $_GET['id'] . "'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object(); ?></p>
                    <strong>Nume si Prenume: </strong> <input type="text" name="nume_prenume" value="<?php echo $row->nume_prenume; ?>"/><br/>
                    <strong>Email: </strong> <input type="email" name="email" value="<?php echo $row->email; ?>"/><br/>
                    <strong>Nr. telefon: </strong> <input type="text" name="nr_telefon" value="<?php echo $row->nr_telefon; ?>"/><br/>
                    <br/>
                    <input type="submit" name="submit" value="Submit" />
                    <a href="VizualizareSpeakeri.php">Index</a>
                    <?php
                }
            }
        } ?>
    </div>
</form>
</body>
</html>

