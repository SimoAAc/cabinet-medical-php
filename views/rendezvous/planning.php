<?php
$pageTitle = "Planning du médecin";
require __DIR__ . "/../layout/header.php";
?>

<h1>Planning des rendez-vous</h1>

<form action="index.php" method="GET">
    <input type="hidden" name="controller" value="rendezvous">
    <input type="hidden" name="action" value="planning">

    <label for="medecin_id">Choisir un médecin :</label>
    <select name="medecin_id" id="medecin_id" required>
        <option value="">-- Choisir un médecin --</option>

        <?php foreach ($medecins as $medecin): ?>
            <option
                value="<?= (int) $medecin['id'] ?>"
                <?= (isset($_GET['medecin_id']) &&
                     $_GET['medecin_id'] == $medecin['id'])
                     ? 'selected' : '' ?>
            >
                <?= htmlspecialchars(
                    $medecin['prenom'] . ' ' . $medecin['nom']
                ) ?>
            </option>
        <?php endforeach; ?>
    </select>

    <br><br>

    <label for="date">Choisir une date :</label>
    <input
        type="date"
        name="date"
        id="date"
        value="<?= htmlspecialchars($_GET['date'] ?? '') ?>"
        required
    >

    <br><br>

    <button type="submit" class="btn btn--primary">Afficher le planning</button>
</form>

<hr>

<?php if (!empty($_GET['medecin_id']) && !empty($_GET['date'])): ?>

    <h2>Rendez-vous du <?= htmlspecialchars($_GET['date']) ?></h2>

    <?php if (!empty($rendezVous)): ?>

        <table>
            <thead>
                <tr>
                    <th>Heure</th>
                    <th>Patient</th>
                    <th>Motif</th>
                    <th>État</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($rendezVous as $rdv): ?>
                    <tr>
                        <td>
                            <?= htmlspecialchars(substr($rdv['heure'], 0, 5)) ?>
                        </td>
                        <td>
                            <?= htmlspecialchars(
                                $rdv['patient_prenom'] . ' ' .
                                $rdv['patient_nom']
                            ) ?>
                        </td>
                        <td><?= htmlspecialchars($rdv['motif']) ?></td>
                        <td><?= htmlspecialchars($rdv['etat']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php else: ?>

        <p>Aucun rendez-vous pour ce médecin à cette date.</p>

    <?php endif; ?>

<?php endif; ?>

<br>
<a class="btn btn--soft" href="index.php?controller=rendezvous&action=index">
    Retour aux rendez-vous
</a>

<?php require __DIR__ . "/../layout/footer.php"; ?>
