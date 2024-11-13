<?php
session_start();
header('Content-Type: application/json');

// Connessione al database
$mysqli = new mysqli("localhost", "root", "", "sito");

// Controllo della connessione
if ($mysqli->connect_error) {
    echo json_encode(["success" => false, "error" => "Errore di connessione al database: " . $mysqli->connect_error]);
    exit();
}

// Recupera i dati dal form di login
$username = $_POST['username'];
$password = $_POST['password'];

// Verifica se l'utente esiste nel database
$stmt = $mysqli->prepare("SELECT * FROM utenti WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Utente trovato
    $user = $result->fetch_assoc();
    
    // Verifica la password
    if (password_verify($password, $user['password'])) {
        // La password è corretta
        $_SESSION['user_id'] = $user['id']; // Salva l'ID dell'utente nella sessione
        $_SESSION['username'] = $user['username']; // Salva il nome utente nella sessione
        echo json_encode(["success" => true, "message" => "Login effettuato con successo"]);
    } else {
        // Password errata
        echo json_encode(["success" => false, "error" => "Password errata"]);
    }
} else {
    // Utente non trovato
    echo json_encode(["success" => false, "error" => "Nome utente non trovato"]);
}

$stmt->close();
$mysqli->close();
?>
