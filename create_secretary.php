
<?php
require_once "config/Database.php";

$database = new Database();
$pdo = $database->connect();

$username = "secretaire";
$password = password_hash("Secret2026!", PASSWORD_DEFAULT);

// chof wach kayna    
$stmt = $pdo->prepare(
    "SELECT id FROM secretaires WHERE username = ?"
);
$stmt->execute([$username]);

if ($stmt->fetch()) {
    echo "Le compte secretaire existe déjà.";
} else {
    $stmt = $pdo->prepare(
        "INSERT INTO secretaires (username, password) VALUES (?, ?)"
    );
    $stmt->execute([$username, $password]);

    echo "Compte créé avec succès !";
}
