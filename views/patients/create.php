<?php
$pageTitle = "Ajouter un patient";
require __DIR__ . "/../layout/header.php";
?>

<h1>Ajouter un patient</h1>

<form method="post"
      action="index.php?controller=patient&action=store">

    <label>Nom :</label>
    <input type="text" name="nom" required>
    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom" required>
    <br><br>

    <label>CIN :</label>
    <input type="text" name="cin" required>
    <br><br>

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance" required>
    <br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone">
    <br><br>

    <button type="submit" class="btn btn--primary">Enregistrer</button>

</form>

<br>

<a class="btn btn--soft" href="index.php?controller=patient&action=index">
    Retour
</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
