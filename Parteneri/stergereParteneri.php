<?php
global  $mysqli;
//conectare la baza de data
include ("../conectare.php");

//se verifica daca id a fost primit
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    //preluam variabila 'id' din URL
    $id = $_GET['id'];

    //stergem inregistrarea cu ib=$id
    if($stmt = $mysqli->prepare("DELETE FROM parteneri WHERE id = ? LIMIT 1")){
        $stmt->bind_param("i",$id);
        $stmt->execute();
        $stmt->close();
    }
    else{
        echo "EROOR: Nu se poate executa delete.";
    }
    $mysqli->close();
    echo "<div>Inregistrarea a fost stearsa!!!!</div>";
}
echo "<p><a href=\"VizualizareParteneri.php\">Index</a></p>";
?>