
<?php

require_once __DIR__ . "/../models/Patient.php";

class PatientController
{
    private $patient;

    public function __construct()
    {
        $this->patient = new Patient();
    }

    // Afficher la liste
    public function index()
    {
        $patients = $this->patient->getAll();

        require __DIR__ . "/../views/patients/index.php";
    }

    // Afficher le formulaire d'ajout
    public function create()
    {
        require __DIR__ . "/../views/patients/create.php";
    }

    // Enregistrer un patient
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->patient->ajouter(
                trim($_POST["nom"]),
                trim($_POST["prenom"]),
                trim($_POST["cin"]),
                $_POST["date_naissance"],
                trim($_POST["telephone"])
            );

            header("Location: index.php?controller=patient&action=index");
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

        $patient = $this->patient->getById($id);

        if (!$patient) {
            die("Patient introuvable");
        }

        require __DIR__ . "/../views/patients/edit.php";
    }

    // Enregistrer la modification
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $id = $_POST["id"];

            $this->patient->modifier(
                $id,
                trim($_POST["nom"]),
                trim($_POST["prenom"]),
                trim($_POST["cin"]),
                $_POST["date_naissance"],
                trim($_POST["telephone"])
            );

            header("Location: index.php?controller=patient&action=index");
            exit;
        }
    }
    public function delete()
    {
    $id = $_GET["id"] ?? null;

    if (!$id) {
        die("ID manquant");
    }

    $this->patient->supprimer($id);

    header("Location: index.php?controller=patient&action=index");
    exit;
}

    

}





