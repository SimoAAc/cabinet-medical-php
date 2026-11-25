<?php
$pageTitle = "Tableau de bord";
require __DIR__ . "/../layout/header.php";
?>

<h1>Cabinet médical - Tableau de bord</h1>

<p>
    Bienvenue,
    <strong><?= htmlspecialchars($_SESSION["secretaire_username"]) ?></strong> !
</p>

<h2>Gestion du cabinet</h2>

<ul>
    <li>
        <a class="btn btn--soft" href="index.php?controller=patient&action=index">
            Gestion des patients
        </a>
    </li>
    <li>
        <a class="btn btn--soft" href="index.php?controller=medecin&action=index">
            Gestion des médecins
        </a>
    </li>
    <li>
        <a class="btn btn--soft" href="index.php?controller=rendezvous&action=index">
            Gestion des rendez-vous
        </a>
    </li>
    <li>
        <a class="btn btn--soft" href="index.php?controller=rendezvous&action=planning">
            Planning des médecins
        </a>
    </li>
</ul>

<form action="index.php?controller=auth&action=logout" method="POST">
    <button type="submit" class="btn btn--ghost">Se déconnecter</button>
</form>

<?php require __DIR__ . "/../layout/footer.php"; ?>
