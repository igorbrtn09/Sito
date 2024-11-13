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

// Recupera i dati dal form di registrazione
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

// Verifica se il nome utente è già in uso
$stmt = $mysqli->prepare("SELECT * FROM utenti WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Nome utente già in uso
    echo json_encode(["success" => false, "error" => "Il nome utente è già in uso."]);
    exit();
}

// Verifica se l'email è già in uso
$stmt = $mysqli->prepare("SELECT * FROM utenti WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // Email già in uso
    echo json_encode(["success" => false, "error" => "L'email è già in uso."]);
    exit();
}

// Se il nome utente e l'email sono liberi, procedi con la registrazione
$hashed_password = password_hash($password, PASSWORD_DEFAULT); // Hash della password

// Inserisci l'utente nel database
$stmt = $mysqli->prepare("INSERT INTO utenti (username, email, password) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $username, $email, $hashed_password);
$success = $stmt->execute();

if ($success) {
    echo json_encode(["success" => true, "message" => "Registrazione avvenuta con successo!"]);
} else {
    echo json_encode(["success" => false, "error" => "Errore durante la registrazione."]);
}

$stmt->close();
$mysqli->close();
?>
