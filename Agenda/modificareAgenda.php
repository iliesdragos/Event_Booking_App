<?php
global $mysqli;
include("../conectare.php");

$error = '';

if (!empty($_POST['id'])) {
    if (isset($_POST['submit'])) {
        if (is_numeric($_POST['id'])) {
            $id = $_POST['id'];
            $data_ora = htmlentities($_POST['data_ora'], ENT_QUOTES);
            $id_eveniment = htmlentities($_POST['id_eveniment'], ENT_QUOTES);
            $id_speker = htmlentities($_POST['id_speaker'], ENT_QUOTES);

            if ($data_ora == '' || $id_eveniment == '' || $id_speker == '') {
                echo "<div> ERROR: Completati campurile obligatorii!</div>";
            } else {
                if ($stmt = $mysqli->prepare("UPDATE agenda SET data_ora=?, id_eveniment=?, id_speaker=? WHERE id='" . $id . "'")) {
                    $stmt->bind_param("sii", $data_ora, $id_eveniment, $id_speker);
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
            <p>Agenda Id: <?php echo $_GET['id'];
            if ($result = $mysqli->query("SELECT * FROM agenda where id='" . $_GET['id'] . "'")) {
                if ($result->num_rows > 0) {
                    $row = $result->fetch_object(); ?></p>
                    <strong>Data si ora: </strong> <input type="datetime-local" name="data_ora" value="<?php echo $row->data_ora; ?>"/><br/>
                    <strong>Id eveniment: </strong> <input type="text" name="id_eveniment" value="<?php echo $row->id_eveniment; ?>"/><br/>
                    <strong>Id speaker: </strong> <input type="text" name="id_speaker" value="<?php echo $row->id_speaker; ?>"/><br/>
                    <br/>
                    <input type="submit" name="submit" value="Submit" />
                    <a href="vizualizareAgenda.php">Index</a>
                    <?php
                }
            }
        } ?>
    </div>
</form>
</body>
</html>

