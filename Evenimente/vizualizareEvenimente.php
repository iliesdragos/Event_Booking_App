<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .button-adaugare{
            display: flex;
            justify-content: center;
        }

        .button{
            margin-top: 20px;
            padding: 15px 30px 15px 30px;
            background-color: #6C7A89;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 11px;
        }

        .button:hover{
            background-color: #354649;
        }

        .actions-buttons{
            display: flex;
            justify-content: center;
        }

        .button-intoarcere{
            margin-top: 20px;
            padding: 15px 30px 15px 30px;
            background-color: #354649;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 11px;
        }
    </style>
</head>
<body>
<h1 style="text-align: center">Inregistrarile din tabela Evenimente</h1>
<p style="text-align: center"><b>Toate inregistrarile din Evenimente</b></p>
<?php
global  $mysqli;
include("../conectare.php");

if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY id "))
{
    if ($result->num_rows > 0)
    {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Titlu</th><th>Descriere</th><th>Imagine</th><th>Data Eveniment</th><th>Oras</th><th>Judet</th><th>Adresa</th><th>Id Sponsor</th><th>Id Partener</th><th>Id Speaker</th><th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->titlu . "</td>";
            echo "<td>" . $row->descriere . "</td>";
            echo "<td>" . $row->imagine . "</td>";
            echo "<td>" . $row->data_eveniment . "</td>";
            echo "<td>" . $row->oras . "</td>";
            echo "<td>" . $row->judet . "</td>";
            echo "<td>" . $row->adresa . "</td>";
            echo "<td>" . $row->id_sponsor . "</td>";
            echo "<td>" . $row->id_partener . "</td>";
            echo "<td>" . $row->id_speaker . "</td>";
            echo "<td><a href='modificareEvenimente.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='stergereEvenimente.php?id=" .$row->id . "'>Stergere</a></td>";
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
    <div class="button-adaugare">
        <a href="inserareEvenimente.php" class="button">Adaugarea unei noi inregistrari</a>
    </div>
    <br/>
    <div class="actions-buttons">
        <a href="../Speakeri/vizualizareSpeakeri.php" class="button">Accesare speakeri</a>
        <br/>
        <a href="../Sponsori/vizualizareSponsori.php" class="button">Accesare sponsori</a>
        <br/>
        <a href="../Parteneri/vizualizareParteneri.php" class="button">Accesare parteneri</a>
        <br/>
    </div>
    <a href="../home.php" class="button-intoarcere">Intoarcere pagina principala</a>
</div>
</body>
</html>