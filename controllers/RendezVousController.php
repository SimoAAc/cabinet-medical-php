
<?php

require_once __DIR__ . "/../config/Database.php";
require_once __DIR__ . "/../models/RendezVous.php";


class RendezVousController
{
    private $rendezVous;

    public function __construct()
    {
        $database = new Database();
        $pdo = $database->connect();

        $this->rendezVous = new RendezVous($pdo);
    }

    // Display all appointments
    public function index()
    {
        $rendezVous = $this->rendezVous->getAll();

        require "views/rendezvous/index.php";
    }

    // Display the booking form
    public function create()
    {
        require "models/Patient.php";
        require "models/Medecin.php";

        $patientModel = new Patient();
        $medecinModel = new Medecin();

        $patients = $patientModel->getAll();
        $medecins = $medecinModel->getAll();

        require "views/rendezvous/create.php";
    }

    // Save a new appointment
    public function store()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            try {
                $this->rendezVous->create(
                    $_POST["patient_id"],
                    $_POST["medecin_id"],
                    $_POST["date_rdv"],
                    $_POST["heure"],
                    trim($_POST["motif"])
                );

                header("Location: index.php?controller=rendezvous&action=index");
                exit;
            } catch (PDOException $e) {
                if ($e->getCode() === "23000") {
                    die("Erreur : ce médecin a déjà un rendez-vous à cette heure.");
                }

                throw $e;
            }
        }
    }

    // Display the edit form
    public function edit()
    {
        $id = $_GET["id"] ?? null;

        if (!$id) {
            header("Location: index.php?controller=rendezvous&action=index");
            exit;
        }

        $rdv = $this->rendezVous->getById($id);

        if (!$rdv) {
            die("Rendez-vous introuvable.");
        }

        require "models/Patient.php";
        require "models/Medecin.php";

        $patientModel = new Patient();
        $medecinModel = new Medecin();

        $patients = $patientModel->getAll();
        $medecins = $medecinModel->getAll();

        require "views/rendezvous/edit.php";
    }

    // Save appointment changes
    public function update()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->rendezVous->update(
                $_POST["id"],
                $_POST["patient_id"],
                $_POST["medecin_id"],
                $_POST["date_rdv"],
                $_POST["heure"],
                trim($_POST["motif"])
            );

            header("Location: index.php?controller=rendezvous&action=index");
            exit;
        }
    }

    // Change status: prévu, effectué or annulé
    public function updateEtat()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $etats = ["prévu", "effectué", "annulé"];
            $etat = $_POST["etat"] ?? "";

            if (!in_array($etat, $etats, true)) {
                die("État invalide.");
            }

            $this->rendezVous->updateEtat(
                $_POST["id"],
                $etat
            );

            header("Location: index.php?controller=rendezvous&action=index");
            exit;
        }
    }

    // Delete an appointment
    public function delete()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $this->rendezVous->delete($_POST["id"]);
        }

        header("Location: index.php?controller=rendezvous&action=index");
        exit;
    }

    // Display a doctor's schedule for a selected date
    public function planning()
    {
        require "models/Medecin.php";

        $medecinModel = new Medecin();
        $medecins = $medecinModel->getAll();

        $rendezVous = [];

        if (!empty($_GET["medecin_id"]) && !empty($_GET["date"])) {
            $rendezVous = $this->rendezVous->getPlanning(
                $_GET["medecin_id"],
                $_GET["date"]
            );
        }

        require "views/rendezvous/planning.php";
    }
}

?>
