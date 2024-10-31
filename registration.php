<?php
// Schimbați acest lucru cu informațiile despre conexiune.
$DATABASE_HOST = 'localhost:3306';
$DATABASE_USER = 'root';
$DATABASE_PASS = "";
$DATABASE_NAME = 'proiect_web_evenimente';

// Incerc sa ma conectez pe baza info de mai sus.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

if (mysqli_connect_errno()) {
    // Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea.
    exit('Nu se poate conecta la MySQL: ' . mysqli_connect_error());
}

if (!isset($_POST['nume'], $_POST['prenume'], $_POST['username'], $_POST['password'], $_POST['email'], $_POST['nr_telefon'])) {
    // Nu s-au putut obține datele care ar fi trebuit trimise.
    exit('Completare formular registration !');
}

// Asigurați-vă că valorile înregistrării trimise nu sunt goale.
if (empty($_POST['nume']) || empty($_POST['prenume']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['email']) || empty($_POST['nr_telefon'])) {
    // One or more values are empty.
    exit('Completare registration form');
}

if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
    exit('Email nu este valid!');
}

if (preg_match('/[A-Za-z0-9]+/', $_POST['username']) == 0) {
    exit('Username nu este valid!');
}

if (strlen($_POST['password']) > 20 || strlen($_POST['password']) < 4) {
    exit('Password trebuie sa fie intre 5 si 20 charactere!');
}

// Validarea numelui - presupunem că vrem să permitem doar litere și spații
if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['nume'])) {
    exit('Nume nu este valid!');
}

// Validarea prenumelui - similar cu numele
if (!preg_match('/^[a-zA-Z\s]+$/', $_POST['prenume'])) {
    exit('Prenume nu este valid!');
}

// Validarea numărului de telefon - presupunem că vrem doar cifre, fără spații sau alte caractere
if (!preg_match('/^[0-9]+$/', $_POST['nr_telefon'])) {
    exit('Numărul de telefon nu este valid!');
}

// verificam daca contul userului exista.
if ($stmt = $con->prepare('SELECT id, nume, prenume, password, email, nr_telefon, status FROM users WHERE username = ?')) {
    // hash parola folosind funcția PHP password_hash.
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();
    $stmt->store_result();

    // Memoram rezultatul, astfel încât să putem verifica dacă contul există în baza de date.
    if ($stmt->num_rows > 0) {
        // Username exista
        echo 'Username exists, alegeti altul!';
    } else {
        if ($stmt = $con->prepare('INSERT INTO users (nume, prenume, username, password, email, nr_telefon, status) VALUES (?, ?, ?, ?, ?, ?, 202)')) {
            // Nu dorim să expunem parole în baza noastră de date, așa că hash parola și utilizați //password_verify atunci când un utilizator se conectează.
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $stmt->bind_param('ssssss', $_POST['nume'], $_POST['prenume'], $_POST['username'], $password, $_POST['email'], $_POST['nr_telefon']);
            $stmt->execute();
            echo 'Success inregistrat!';
            header('Location: index.html');
        } else {
            // Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor //există cu toate cele 3 câmpuri.
            echo 'Nu se poate face prepare statement!';
        }
    }

    $stmt->close();
} else {
    // Ceva nu este în regulă cu declarația sql, verificați pentru a vă asigura că tabelul conturilor //există cu toate cele 3 câmpuri.
    echo 'Nu se poate face prepare statement!';
}

$con->close();
?>

