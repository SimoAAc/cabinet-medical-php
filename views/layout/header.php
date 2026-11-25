<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$pageTitle = $pageTitle ?? "Accueil";
$currentController = $_GET["controller"] ?? "auth";
$currentAction = $_GET["action"] ?? "login";
$isLoggedIn = isset($_SESSION["secretaire_id"]);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($pageTitle) ?> - Cabinet médical</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

<header class="site-header">
    <div class="site-header__inner">

        <a class="brand" href="index.php?controller=auth&action=dashboard">
            <span class="brand__logo" aria-hidden="true">+</span>
            <span class="brand__text">
                <strong>Cabinet médical</strong>
                <small>Espace secrétaire</small>
            </span>
        </a>

        <?php if ($isLoggedIn): ?>

            <nav class="main-nav" aria-label="Navigation principale">
                <a class="nav-link <?= $currentController === "auth" ? "is-active" : "" ?>"
                   href="index.php?controller=auth&action=dashboard">Tableau de bord</a>

                <a class="nav-link <?= $currentController === "patient" ? "is-active" : "" ?>"
                   href="index.php?controller=patient&action=index">Patients</a>

                <a class="nav-link <?= $currentController === "medecin" ? "is-active" : "" ?>"
                   href="index.php?controller=medecin&action=index">Médecins</a>

                <a class="nav-link <?= ($currentController === "rendezvous" && $currentAction !== "planning") ? "is-active" : "" ?>"
                   href="index.php?controller=rendezvous&action=index">Rendez-vous</a>

                <a class="nav-link <?= $currentAction === "planning" ? "is-active" : "" ?>"
                   href="index.php?controller=rendezvous&action=planning">Planning</a>
            </nav>

            <div class="site-header__user">
                <span class="user-chip">
                    <span class="user-chip__dot"></span>
                    <?= htmlspecialchars($_SESSION["secretaire_username"] ?? "") ?>
                </span>

                <form action="index.php?controller=auth&action=logout" method="POST">
                    <button type="submit" class="btn btn--ghost btn--sm">Déconnexion</button>
                </form>
            </div>

        <?php endif; ?>

    </div>
</header>

<main class="page<?= $isLoggedIn ? "" : " page--auth" ?>">
