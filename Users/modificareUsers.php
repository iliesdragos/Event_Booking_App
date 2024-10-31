<?php
global $mysqli;
include("../conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $nume = htmlentities($_POST['nume'], ENT_QUOTES);
            $prenume = htmlentities($_POST['prenume'], ENT_QUOTES);
            $username = htmlentities($_POST['username'], ENT_QUOTES);
            $parola = htmlentities($_POST['parola'], ENT_QUOTES);
            $email = htmlentities($_POST['email'], ENT_QUOTES);
            $nr_telefon = htmlentities($_POST['nr_telefon'], ENT_QUOTES);
            $status = htmlentities($_POST['status'], ENT_QUOTES);

            if ($nume == '' || $prenume == '' || $username == '' || $parola == '' || $email == '' || $nr_telefon == '' || $status='') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE users SET nume=?, prenume=?, username=?, parola=?, email=?, nr_telefon=? status=? WHERE id='" . $id . "'")) {
                    $stmt->bind_param("ssssssi", $nume, $prenume,$username,$parola,$email, $nr_telefon, $status);
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
            <p>User Id: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM users where id='" . $_GET['id'] . "'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object(); ?></p>
                    <strong>Nume: </strong> <input type="text" name="nume" value="<?php echo $row->nume; ?>"/><br/>
                    <strong>Prenume: </strong> <input type="text" name="prenume" value="<?php echo $row->prenume; ?>"/><br/>
                    <strong>Username: </strong> <input type="text" name="username" value="<?php echo $row->username; ?>"/><br/>
                    <strong>Parola: </strong> <input type="password" name="parola" value="<?php echo $row->parola; ?>"/><br/>
                    <strong>Email: </strong> <input type="email" name="email" value="<?php echo $row->email; ?>"/><br/>
                    <strong>Nr. telefon: </strong> <input type="text" name="nr_telefon" value="<?php echo $row->nr_telefon; ?>"/><br/>
                    <strong>Status: </strong> <input type="text" name="status" value="<?php echo $row->status; ?>"/><br/>
                    <br/>
                    <input type="submit" name="submit" value="Submit" />
                    <a href="vizualizareUsers.php">Index</a>
                    <?php
                }
            }
        } ?>
    </div>
</form>
</body>
</html>