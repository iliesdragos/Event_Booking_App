<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vizualizare Inregistrari</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #E0E7E9;
            margin: 0;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: #354649;
            margin-bottom: 40px;
        }

        .event-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin: auto;
            margin-bottom: 20px;
            padding: 15px;
            background-color: #fff;
            box-shadow: 0 4px 15px #A3C6C4;
            height: 100px;
            width: 50%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }

        .event-card img {
            width: 100px;
            height: auto;
            border-radius: 4px;
        }

        .event-title {
            font-size: 25px;
            margin-bottom: 10px;
            font-weight: bold;
            color: #354649;
        }

        .details-link {
            width: 20%;
            display: block;
            text-align: right;
            margin-top: 10px;
            text-decoration: none;
            color: #354649;
            font-weight: bold;
        }

        .buy-tickets-link {
            display: block;
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
        }

        .buy-tickets-link a{
            color: #354649;
        }

        .logout{
            text-align: end;
        }

        .logout-button{
            margin-top: 20px;
            padding: 15px 30px 15px 30px;
            background-color: #6C7A89;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            margin-left: 11px;
        }
    </style>
</head>
<body>
<div class="logout">
    <a href="logout.php" class="logout-button"><i class="fas fa-sign-out-alt"></i>Logout</a>
</div>
<h1>Evenimente disponibile</h1>

<?php
global $mysqli;
include("conectare.php");

if ($result = $mysqli->query("SELECT * FROM evenimente ORDER BY id ")) {
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_object()) {
            echo "<div class='event-card'>";
            echo "<img src='uploadimages/".$row->imagine."'/>";
            echo "<div class='event-title'>" . $row->titlu . "</div>";
            echo "<a class='details-link' href='Evenimente/detaliiEvenimente.php?id=" . $row->id . "'>Detalii</a>";
            echo "</div>";
        }
    } else {
        echo "Nu sunt inregistrari in tabela!";
    }
} else {
    echo "Error: " . $mysqli->error();
}

echo "<div class='buy-tickets-link'><a href='Evenimente/magazin.php'>Cumpara bilete</a></div>";
$mysqli->close();
?>
</body>
</html>
