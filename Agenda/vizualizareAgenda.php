<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
</head>
<body>
<h1>Inregistrarile din tabela Agenda</h1>
<br>
<p><b>Toate inregistrarile din Agenda</b></p>
<br>
<?php
global  $mysqli;
include("../conectare.php");

if ($result = $mysqli->query("SELECT * FROM agenda ORDER BY id "))
{
    if ($result->num_rows > 0)
    {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Data si ora</th><th>Id Eveniment</th><th>Id Speaker</th><th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->data_ora . "</td>";
            echo "<td>" . $row->id_eveniment . "</td>";
            echo "<td>" . $row->id_speaker . "</td>";
            echo "<td><a href='modificareAgenda.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='stergereAgenda.php?id=" .$row->id . "'>Stergere</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    else
    {
        echo "Nu sunt inregistrari in tabela!";
    }
}
else
{
    echo "Error: " . $mysqli->error();
}

$mysqli->close();
?>
<div>
    <a href="inserareAgenda.php">Adaugarea unei noi inregistrari</a>
    <br/>
    <a href="../Speakeri/vizualizareSpeakeri.php">Accesare pagina speakeri</a>
    <br/>
    <a href="../Evenimente/vizualizareEvenimente.php">Accesare pagina evenimente</a>
</div>
</body>
</html>