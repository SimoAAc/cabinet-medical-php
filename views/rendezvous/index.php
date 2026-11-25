<?php
$pageTitle = "Gestion des rendez-vous";
require __DIR__ . "/../layout/header.php";
?>

<h1>Gestion des rendez-vous</h1>

<a class="btn btn--primary" href="index.php?controller=rendezvous&action=create">
    + Prendre un rendez-vous
</a>

<br><br>

<a class="btn btn--soft btn--sm" href="index.php?controller=patient&action=index">
    Gestion des patients
</a>

<a class="btn btn--soft btn--sm" href="index.php?controller=medecin&action=index">
    Gestion des médecins
</a>

<a class="btn btn--soft btn--sm" href="index.php?controller=rendezvous&action=planning">
    Voir le planning d'un médecin
</a>

<hr>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Patient</th>
            <th>Médecin</th>
            <th>Date</th>
            <th>Heure</th>
            <th>Motif</th>
            <th>État</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>

    <?php if (!empty($rendezVous)): ?>

        <?php foreach ($rendezVous as $rdv): ?>

            <tr>
                <td><?= htmlspecialchars($rdv["id"]) ?></td>

                <td>
                    <?= htmlspecialchars($rdv["patient_prenom"]) ?>
                    <?= htmlspecialchars($rdv["patient_nom"]) ?>
                </td>

                <td>
                    <?= htmlspecialchars($rdv["medecin_prenom"]) ?>
                    <?= htmlspecialchars($rdv["medecin_nom"]) ?>
                </td>

                <td><?= htmlspecialchars($rdv["date_rdv"]) ?></td>

                <td><?= htmlspecialchars($rdv["heure"]) ?></td>

                <td><?= htmlspecialchars($rdv["motif"]) ?></td>

                <td><?= htmlspecialchars($rdv["etat"]) ?></td>

                <td>
                    <a class="link--edit"
                       href="index.php?controller=rendezvous&action=edit&id=<?= (int) $rdv['id'] ?>">
                        Modifier
                    </a>

                    <form action="index.php?controller=rendezvous&action=updateEtat"
                          method="POST">

                        <input type="hidden" name="id"
                               value="<?= (int) $rdv['id'] ?>">

                        <select name="etat">
                            <option value="prévu"
                                <?= $rdv["etat"] === "prévu" ? "selected" : "" ?>>
                                Prévu
                            </option>

                            <option value="effectué"
                                <?= $rdv["etat"] === "effectué" ? "selected" : "" ?>>
                                Effectué
                            </option>

                            <option value="annulé"
                                <?= $rdv["etat"] === "annulé" ? "selected" : "" ?>>
                                Annulé
                            </option>
                        </select>

                        <button type="submit" class="btn btn--primary btn--sm">
                            Changer l'état
                        </button>
                    </form>

                    <form action="index.php?controller=rendezvous&action=delete"
                          method="POST"
                          onsubmit="return confirm('Supprimer ce rendez-vous ?');">

                        <input type="hidden" name="id"
                               value="<?= (int) $rdv['id'] ?>">

                        <button type="submit" class="btn btn--danger btn--sm">Supprimer</button>
                    </form>
                </td>
            </tr>

        <?php endforeach; ?>

    <?php else: ?>

        <tr>
            <td colspan="8">Aucun rendez-vous pour le moment.</td>
        </tr>

    <?php endif; ?>

    </tbody>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>
