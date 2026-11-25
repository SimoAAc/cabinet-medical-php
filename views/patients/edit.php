<?php
$pageTitle = "Modifier un patient";
require __DIR__ . "/../layout/header.php";
?>

<h1>Modifier un patient</h1>

<form method="post"
      action="index.php?controller=patient&action=update">

    <input type="hidden" name="id"
           value="<?= (int) $patient['id'] ?>">

    <label>Nom :</label>
    <input type="text" name="nom"
           value="<?= htmlspecialchars($patient['nom']) ?>" required>
    <br><br>

    <label>Prénom :</label>
    <input type="text" name="prenom"
           value="<?= htmlspecialchars($patient['prenom']) ?>" required>
    <br><br>

    <label>CIN :</label>
    <input type="text" name="cin"
           value="<?= htmlspecialchars($patient['cin']) ?>" required>
    <br><br>

    <label>Date de naissance :</label>
    <input type="date" name="date_naissance"
           value="<?= htmlspecialchars($patient['date_naissance']) ?>" required>
    <br><br>

    <label>Téléphone :</label>
    <input type="text" name="telephone"
           value="<?= htmlspecialchars($patient['telephone'] ?? '') ?>">
    <br><br>

    <button type="submit" class="btn btn--primary">Enregistrer</button>
</form>

<br>

<a class="btn btn--soft" href="index.php?controller=patient&action=index">
    Retour
</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
