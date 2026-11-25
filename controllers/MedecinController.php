
<?php

require_once __DIR__ . "/../models/Medecin.php";

class MedecinController
{
    private $medecin;

    public function __construct()
    {
        $this->medecin = new Medecin();
    }

    // Afficher la liste
    public function index()
    {
        $medecins = $this->medecin->getAll();

        require __DIR__ . "/../views/medecins/index.php";
    }

    // Afficher le formulaire
    public function create()
    {
        require __DIR__ . "/../views/medecins/create.php";
    }

    // Enregistrer un médecin
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->medecin->ajouter(
                trim($_POST["nom"]),
                trim($_POST["prenom"]),
                trim($_POST["specialite"]),
                trim($_POST["telephone"])
            );

            header("Location: index.php?controller=medecin&action=index");
            exit;
        }
    }

    // Afficher le formulaire de modification
    public function edit()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            die("ID manquant");
        }

        $medecin = $this->medecin->getById($id);

        if (!$medecin) {
            die("Médecin introuvable");
        }

        require __DIR__ . "/../views/medecins/edit.php";
    }

    // Enregistrer la modification
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->medecin->modifier(
                $_POST["id"],
                trim($_POST["nom"]),
                trim($_POST["prenom"]),
                trim($_POST["specialite"]),
                trim($_POST["telephone"])
            );

            header("Location: index.php?controller=medecin&action=index");
            exit;
        }
    }

    // Supprimer un médecin
    public function delete()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            die("ID manquant");
        }

        $this->medecin->supprimer($id);

        header("Location: index.php?controller=medecin&action=index");
        exit;
    }
}
