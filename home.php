<?php
// We need to use sessions, so you should always start sessions using the below code.
session_start();

// If the user is not logged in redirect to the login page...
if (!isset($_SESSION['loggedin'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Pagina proiect parolata</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
    <style>
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
            justify-content: space-around;
        }
    </style>
</head>
<body class="loggedin">
<nav class="navtop">
    <div>
        <h1 style="text-align: center; font-size: 35px">Panoul de Control - Admin</h1>
        <a href="logout.php" class="button"><i class="fas fa-sign-out-alt"></i>Logout</a>
    </div>
</nav>
<div class="content">
    <p style="text-align: center; font-weight: bold; font-size: 20px">Bine ati revenit, <?= $_SESSION['nume'] ?>!</p>
</div>
<div class="actions-buttons">
    <a href="Evenimente/vizualizareEvenimente.php" class="button">Accesare evenimente</a>
    <br/>
    <a href="Users/vizualizareUsers.php" class="button">Accesare users</a>
    <br/>
    <a href="Parteneri/vizualizareParteneri.php" class="button">Accesare parteneri</a>
    <br/>
    <a href="Speakeri/vizualizareSpeakeri.php" class="button">Accesare speakeri</a>
    <br/>
    <a href="Sponsori/vizualizareSponsori.php" class="button">Accesare sponsori</a>
    <br/>
    <a href="Bilete/vizualizareBilete.php" class="button">Accesare bilete</a>
</div>
</body>
</html>
