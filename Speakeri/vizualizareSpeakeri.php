<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
    <title> Vizualizare inregistrari</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>
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
<h1 style="text-align: center">
    Inregistrarile din tabela speakeri
</h1>
<br>
<p>
    <b>
        Toate inregistrarile din tabela speakeri
    </b>
</p>
<?php
global  $mysqli;
//conectare baza de date
include("../conectare.php");
//se preiau inregistrarile din baza de date
if($result = $mysqli->query("SELECT * FROM speakeri ORDER BY id")){
    //Afisare intregistrari pe ecran
    if($result->num_rows > 0){
        //Afisare inregistrari intr-o tabela
        echo "<table border='1' cellpadding='10'>";

        //antetul tabelului
        echo "<tr><th>Speaker Id</th><th>Nume si Prenume</th><th>Email</th><th>Nr. telefon</th></tr>";

        while ($row = $result->fetch_object()){
            //definirea unei linii pt fiecare inregistrare
            echo "<tr>";
            echo "<td>".$row->id."</td>";
            echo "<td>".$row->nume_prenume."</td>";
            echo "<td>".$row->email."</td>";
            echo "<td>".$row->nr_telefon."</td>";
            echo "<td><a href='modificareSpeakeri.php?id=".$row->id."'>Modificare</a></td>";
            echo "<td><a href='stergereSpeakeri.php?id=".$row->id."'>Stergere</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    }
    //daca nu sunt inregistrari se afiseaza un rezultat de eroare
    else{
        "<br>";
        echo "Nu sunt inregistrari in tabela!";
    }
}
//eroare in caz de insucces in interogare
else{
    echo "Error: ".$mysqli->error();
}
//se inchide
$mysqli->close();
?>
<div>
    <div class="button-adaugare">
        <a href = "inserareSpeakeri.php" class="button">Adaugare  unei noi inregistrari</a>
    </div>
    <br/>
    <br/>
    <a href="../home.php" class="button-intoarcere">Intoarcere pagina principala</a>

</div>
</body>
</html>

