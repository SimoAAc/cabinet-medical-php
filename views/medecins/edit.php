<?php
$pageTitle = "Modifier un médecin";
require __DIR__ . "/../layout/header.php";
?>

<h1>Modifier un médecin</h1>

<form method="post"
      action="index.php?controller=medecin&action=update">

    <input type="hidden" name="id"
           value="<?= (int) $medecin['id'] ?>">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($medecin['nom']) ?>" required>
    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($medecin['prenom']) ?>" required>
    <br><br>

    <label>Spécialité :</label>
    <input type="text" name="specialite"
           value="<?= htmlspecialchars($medecin['specialite']) ?>" required>
    <br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone"
           value="<?= htmlspecialchars($medecin['telephone'] ?? '') ?>">
    <br><br>

    <button type="submit" class="btn btn--primary">Enregistrer</button>
</form>

<br>

<a class="btn btn--soft" href="index.php?controller=medecin&action=index">Retour</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
