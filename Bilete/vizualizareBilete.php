<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title>Vizualizare Inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <style>
        .button-adaugare{
            display: flex;
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
<h1 style="text-align: center">Inregistrarile din tabela Bilete</h1>
<p><b>Toate inregistrarile din Bilete</b</p>
<?php
global  $mysqli;
include("../conectare.php");

if ($result = $mysqli->query("SELECT * FROM bilete ORDER BY id "))
{
    if ($result->num_rows > 0)
    {
        echo "<table border='1' cellpadding='10'>";
        echo "<tr><th>ID</th><th>Pret</th><th>Id Eveniment</th><th>Id Users</th><th></th><th></th></tr>";
        while ($row = $result->fetch_object())
        {
            echo "<tr>";
            echo "<td>" . $row->id . "</td>";
            echo "<td>" . $row->cantitate . "</td>";
            echo "<td>" . $row->id_eveniment . "</td>";
            echo "<td>" . $row->id_users . "</td>";
            echo "<td><a href='modificareBilete.php?id=" . $row->id . "'>Modificare</a></td>";
            echo "<td><a href='stergereBilete.php?id=" .$row->id . "'>Stergere</a></td>";
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
        <a href="inserareBilete.php" class="button">Adaugarea unei noi inregistrari</a>
        <a href="../Users/vizualizareUsers.php" class="button"> Accesare Users</a>
    </div>
    <br/>
    <br/>
    <a href="../home.php" class="button-intoarcere">Intoarcere pagina principala</a>
</div>
</body>
</html>