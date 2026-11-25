
<?php

// Start the session if it is not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if the secretary is logged in
if (!isset($_SESSION["secretaire_id"])) {

    // RJ3O L  login
    header("Location: index.php?controller=auth&action=login");
    exit;
}
