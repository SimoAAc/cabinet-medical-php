<?php
$pageTitle = "Ajouter un médecin";
require __DIR__ . "/../layout/header.php";
?>

<h1>Ajouter un médecin</h1>

<form method="post"
      action="index.php?controller=medecin&action=store">

    <label>Nom :</label>
    <input type="text" name="nom" required>
    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>
    <br><br>

    <label>Spécialité :</label>
    <input type="text" name="specialite" required>
    <br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone">
    <br><br>

    <button type="submit" class="btn btn--primary">Enregistrer</button>
</form>

<br>

<a class="btn btn--soft" href="index.php?controller=medecin&action=index">Retour</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
