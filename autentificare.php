<?php
session_start();

// Informații conectare.
$DATABASE_HOST = 'localhost:3306';
$DATABASE_USER = 'root';
$DATABASE_PASS = '';
$DATABASE_NAME = 'proiect_web_evenimente';

// Încercați să vă conectați folosind informațiile de mai sus.
$con = mysqli_connect($DATABASE_HOST, $DATABASE_USER, $DATABASE_PASS, $DATABASE_NAME);

// Dacă există o eroare la conexiune, opriți scriptul și afișați eroarea.
if (mysqli_connect_errno()) {
    exit('Failed to connect to MySQL: ' . mysqli_connect_error());
}

// Acum verificăm dacă datele din formularul de autentificare au fost trimise.
// isset() va verifica dacă datele există.
if (!isset($_POST['username'], $_POST['password'])) {
    // Nu s-au putut obține datele care ar fi trebuit trimise.
    exit('Completați username și password!');
}

// Pregătiți SQL-ul nostru, pregătirea instrucțiunii SQL va împiedica injecția SQL.
if ($stmt = $con->prepare('SELECT id, nume, prenume, password, email, nr_telefon, status FROM users WHERE username = ?')) {
    // Parametrii de legare (s = șir, i = int, b = blob etc.), în cazul nostru numele de utilizator este un șir,
    // așa că vom folosi „s”
    $stmt->bind_param('s', $_POST['username']);
    $stmt->execute();

    // Stocați rezultatul astfel încât să putem verifica dacă contul există în baza de date.
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $nume, $prenume, $password_hash, $email, $nr_telefon, $status);
        $stmt->fetch();
        // Contul există, acum verificăm parola.
        if (password_verify($_POST['password'], $password_hash)) {
            // Verification success! User has logged in!
            session_regenerate_id();
            $_SESSION['loggedin'] = TRUE;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $_POST['username'];
            $_SESSION['nume'] = $nume;
            $_SESSION['prenume'] = $prenume;
            $_SESSION['email'] = $email;
            $_SESSION['nr_telefon'] = $nr_telefon;
            $_SESSION['status'] = $status;

            if ($status == "202") {
                echo 'Welcome ' . $_SESSION['username'] . '!';
                header('Location: client_panel.php');
            }
            else if($status == '101') {
                echo 'Welcome ' . $_SESSION['username'] . '!';
                header('Location: home.php');
            }
        } else {
            // Parolă incorectă
            echo 'Incorrect username sau password!';
        }
    } else {
        // Username incorect
        echo 'Incorrect username sau password!';
    }

    $stmt->close();
}
?>
