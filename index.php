
<?php


$controller = $_GET["controller"] ?? "auth";
$action = $_GET["action"] ?? "login";

// GA3 LES PAGES ILA  authentication
if ($controller !== "auth") {
    require_once "config/auth_guard.php";
}

// AUTHENTIFICATION
if ($controller === "auth") {

    require_once "controllers/AuthController.php";
    $c = new AuthController();

    if ($action === "login") {

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $c->login();
        } else {
            $c->showLogin();
        }

    } elseif ($action === "dashboard") {
        $c->dashboard();

    } elseif ($action === "logout") {
        $c->logout();

    } else {
        http_response_code(404);
        echo "Action introuvable";
    }

// PATIENTS
} elseif ($controller === "patient") {

    require_once "controllers/PatientController.php";
    $c = new PatientController();

    if ($action === "index") {
        $c->index();
    } elseif ($action === "create") {
        $c->create();
    } elseif ($action === "store") {
        $c->store();
    } elseif ($action === "edit") {
        $c->edit();
    } elseif ($action === "update") {
        $c->update();
    } elseif ($action === "delete") {
        $c->delete();
    } else {
        http_response_code(404);
        echo "Action introuvable";
    }

// MÉDECINS
} elseif ($controller === "medecin") {

    require_once "controllers/MedecinController.php";
    $c = new MedecinController();

    if ($action === "index") {
        $c->index();
    } elseif ($action === "create") {
        $c->create();
    } elseif ($action === "store") {
        $c->store();
    } elseif ($action === "edit") {
        $c->edit();
    } elseif ($action === "update") {
        $c->update();
    } elseif ($action === "delete") {
        $c->delete();
    } else {
        http_response_code(404);
        echo "Action introuvable";
    }

// RENDEZ-VOUS
} elseif ($controller === "rendezvous") {

    require_once "controllers/RendezVousController.php";
    $c = new RendezVousController();

    if ($action === "index") {
        $c->index();
    } elseif ($action === "create") {
        $c->create();
    } elseif ($action === "store") {
        $c->store();
    } elseif ($action === "edit") {
        $c->edit();
    } elseif ($action === "update") {
        $c->update();
    } elseif ($action === "updateEtat") {
        $c->updateEtat();
    } elseif ($action === "delete") {
        $c->delete();
    } elseif ($action === "planning") {
        $c->planning();
    } else {
        http_response_code(404);
        echo "Action introuvable";
    }

} else {
    http_response_code(404);
    echo "Controller introuvable";
}
