<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Vizualizare Inregistrari</title>
    <script>
        function navigateToDestination() {
            window.location.href = '../client_panel.php';
        }

        function navigateToDestination2() {
            window.location.href = 'magazin.php';
        }
    </script>

    <style>
        body {
            font-family: Arial, sans-serif;
            flex-wrap: wrap;
            padding: 20px;
            background-color: #E0E7E9;
        }

        .container{
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 20px;
            margin: 10px;
            box-shadow: 0 4px 15px #A3C6C4;
            width: auto;
            height: auto;
        }

        .imagine{
            width: 25%;
        }

        .imagine img{
            width: 90%;
            height: 400px;
            border-radius: 10px;
        }

        .detalii{
            width: 75%;
            font-size: 20px;
        }

        h1 {
            text-align: center;
            color: #354649;
        }

        .butoane{
            display: flex;
        }

        .button-back {
            display: block;
            margin-top: 20px;
            padding: 10px;
            background-color: #6C7A89;
            color: #E0E7E9;
            border: none;
            border-radius: 4px;
            text-decoration: none;
            height: 50px;
            margin-left: 11px;
        }

        .button-back:hover {
            background-color: #354649;
            cursor: pointer;
        }
    </style>
</head>

<body>
<div>
    <h1>Detalii despre evenimentul accesat</h1>
    <?php
    global $mysqli;
    include("../conectare.php");

    if ($result = $mysqli->query("SELECT * FROM evenimente where id='" . $_GET['id'] . "'")) {
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_object()) {
                echo "<div class='container'>";
                    echo "<div class='imagine'>";
                        echo "<img src='../uploadimages/".$row->imagine."'/>";
                    echo "</div>";

                    echo "<div class='detalii'>";
                        echo "<p><strong>Titlu:</strong> " . $row->titlu . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Descriere:</strong> " . $row->descriere . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Data Eveniment:</strong> " . $row->data_eveniment . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Oras:</strong> " . $row->oras . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Judet:</strong> " . $row->judet . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Adresa:</strong> " . $row->adresa . "</p>";
                        echo "<hr>";

                        echo "<p><strong>Speaker: </strong>";
                        $id_speaker = $row->id_speaker;
                        if (!empty($id_speaker)) {
                            $query_speaker = "SELECT nume_prenume FROM speakeri WHERE id = $id_speaker";
                            if ($result_speaker = $mysqli->query($query_speaker)) {
                                if ($result_speaker->num_rows > 0) {
                                    $speaker = $result_speaker->fetch_object();
                                    echo $speaker->nume_prenume;
                                }
                                $result_speaker->close();
                            }
                        }
                        echo"</p>";
                        echo "<hr>";

                        echo "<p><strong>Sponsor: </strong>";
                        $id_sponsor = $row->id_sponsor;
                        if (!empty($id_sponsor)) {
                            $query_sponsor = "SELECT companie FROM sponsori WHERE id = $id_sponsor";
                            if ($result_sponsor = $mysqli->query($query_sponsor)) {
                                if ($result_sponsor->num_rows > 0) {
                                    $sponsor = $result_sponsor->fetch_object();
                                    echo $sponsor->companie;
                                }
                                $result_sponsor->close();
                            }
                        }
                        echo "</p>";
                        echo "<hr>";

                        echo "<p><strong>Partener: </strong>";
                        $id_partener = $row->id_partener;
                        if (!empty($id_partener)) {
                            $query_partener = "SELECT companie FROM parteneri WHERE id = $id_partener";
                            if ($result_partener = $mysqli->query($query_partener)) {
                                if ($result_partener->num_rows > 0) {
                                    $partener = $result_partener->fetch_object();
                                    echo $partener->companie;
                                }
                                $result_partener->close();
                            }
                        }
                        echo "</p>";

                    echo "</div>";
                echo "</div>";
            }
        } else {
            echo "Nu sunt inregistrari in tabela!";
        }
    } else {
        echo "Error: " . $mysqli->error();
    }

    $mysqli->close();
    ?>
</div>

<div class="butoane">
    <input type="button" onclick="navigateToDestination()" value="Intoarcere pagina principala" class="button-back">
    <input type="button" onclick="navigateToDestination2()" value="Cumpara Bilete" class="button-back">
</div>

</body>

</html>
