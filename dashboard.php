<?php
session_start();

// Verifica se l'utente è autenticato
if (!isset($_SESSION['user_id'])) {
    header("Location: accesso.html"); // Redirige alla pagina di login se non autenticato
    exit();
}

echo "Benvenuto nella tua area riservata!";
?>
