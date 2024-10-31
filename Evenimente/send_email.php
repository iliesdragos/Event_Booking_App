<?php
global $mysqli;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

include("../conectare.php");
require 'phpmailer/src/Exception.php';
require 'phpmailer/src/PHPMailer.php';
require 'phpmailer/src/SMTP.php';

session_start(); // Asigură-te că sesiunea este inițiată

if(isset($_POST["send"])){
    // Presupunem că ID-ul utilizatorului conectat este stocat în sesiune
    $userId = $_SESSION['id'];

    // Interoghează baza de date pentru a obține adresa de email a utilizatorului
    $query = "SELECT email FROM users WHERE id = ?";
    if($stmt = $mysqli->prepare($query)){
        $stmt->bind_param("i", $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        if($result->num_rows == 1){
            $row = $result->fetch_assoc();
            $userEmail = $row['email']; // Adresa de email a utilizatorului conectat

            // Aici vine logica de trimitere a emailului
            $mail = new PHPMailer(true);
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'ilies.dragos2002@gmail.com';
            $mail->Password = 'wxmiiznzuhhvbrzc';
            $mail->SMTPSecure = 'ssl';
            $mail->Port = 465;
            $mail->setFrom('ilies.dragos2002@gmail.com');
            $mail->addAddress($userEmail); // Folosește adresa de email obținută
            $mail->isHTML(true);
            $mail->Subject = 'Email de confirmare'; // Setează subiectul emailului
            $mail->Body = 'Acesta este un email de confirmare. </br></br>
            Va multumim ca ati ales sa cumparati un bilet pentru evenimentul nostru.
            </br> 
            Suntem incantati sa va avem alaturi si suntem siguri ca veti avea o experienta minunata.
            </br></br>
            Va rugam sa pastrati acest e-mail pentru referinte ulterioare.
            Va asteptam cu drag la eveniment si speram sa aveti o experienta de neuitat!';
            $mail->send();
            echo
            "<script>
alert('Sent succesfully');
document.location.href = '../client_panel.php'; 
</script>";
        }
    }
}
?>