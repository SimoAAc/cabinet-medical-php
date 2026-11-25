<?php
$pageTitle = "Modifier un rendez-vous";
require __DIR__ . "/../layout/header.php";
?>

<h1>Modifier un rendez-vous</h1>

<form action="index.php?controller=rendezvous&action=update"
      method="POST">

    <input type="hidden" name="id"
           value="<?= (int) $rdv['id'] ?>">

    <label for="patient_id">Patient :</label>

    <select name="patient_id" id="patient_id" required>
        <?php foreach ($patients as $patient): ?>
            <option value="<?= (int) $patient['id'] ?>"
                <?= $patient['id'] == $rdv['patient_id'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($patient['prenom'] . ' ' . $patient['nom']) ?>

            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="medecin_id">Médecin :</label>

    <select name="medecin_id" id="medecin_id" required>
        <?php foreach ($medecins as $medecin): ?>
            <option value="<?= (int) $medecin['id'] ?>"
                <?= $medecin['id'] == $rdv['medecin_id'] ? 'selected' : '' ?>>

                <?= htmlspecialchars($medecin['prenom'] . ' ' . $medecin['nom']) ?>
                - <?= htmlspecialchars($medecin['specialite']) ?>

            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="date_rdv">Date :</label>
    <input type="date" name="date_rdv" id="date_rdv"
           value="<?= htmlspecialchars($rdv['date_rdv']) ?>" required>

    <br><br>

    <label for="heure">Heure :</label>
    <input type="time" name="heure" id="heure"
           value="<?= htmlspecialchars(substr($rdv['heure'], 0, 5)) ?>" required>

    <br><br>

    <label for="motif">Motif :</label>
    <textarea name="motif" id="motif" required><?= htmlspecialchars($rdv['motif']) ?></textarea>

    <br><br>

    <button type="submit" class="btn btn--primary">Enregistrer</button>

</form>

<br>

<a class="btn btn--soft" href="index.php?controller=rendezvous&action=index">
    Retour à la liste des rendez-vous
</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
