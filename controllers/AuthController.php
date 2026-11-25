
<?php
require_once __DIR__ . "/../config/Database.php";

class AuthController
{
    private $pdo;

    public function __construct()
    {
        $database = new Database();
        $this->pdo = $database->connect();
    }

    public function showLogin()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION["secretaire_id"])) {
            header("Location: index.php?controller=auth&action=dashboard");
            exit;
        }

        $erreur = "";
        require __DIR__ . "/../views/auth/login.php";
    }

    public function login()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        $username = trim($_POST["username"] ?? "");
        $password = $_POST["password"] ?? "";

        $stmt = $this->pdo->prepare(
            "SELECT id, username, password
             FROM secretaires
             WHERE username = ?"
        );

        $stmt->execute([$username]);
        $secretaire = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($secretaire &&
            password_verify($password, $secretaire["password"])) {

            session_regenerate_id(true);

            $_SESSION["secretaire_id"] = $secretaire["id"];
            $_SESSION["secretaire_username"] = $secretaire["username"];

            header("Location: index.php?controller=auth&action=dashboard");
            exit;
        }

        $erreur = "Nom d'utilisateur ou mot de passe incorrect.";
        require __DIR__ . "/../views/auth/login.php";
    }

    public function dashboard()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION["secretaire_id"])) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        require __DIR__ . "/../views/auth/dashboard.php";
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];
        session_destroy();

        header("Location: index.php?controller=auth&action=login");
        exit;
    }
}
