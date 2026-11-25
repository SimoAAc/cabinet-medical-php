<?php
$pageTitle = "Gestion des médecins";
require __DIR__ . "/../layout/header.php";
?>

<h1>Liste des médecins</h1>

<a class="btn btn--soft" href="index.php?controller=medecin&action=create">
    Ajouter un médecin
</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Spécialité</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($medecins as $m): ?>
        <tr>
            <td><?= (int) $m["id"] ?></td>
            <td><?= htmlspecialchars($m["nom"]) ?></td>
            <td><?= htmlspecialchars($m["prenom"]) ?></td>
            <td><?= htmlspecialchars($m["specialite"]) ?></td>
            <td><?= htmlspecialchars($m["telephone"] ?? "") ?></td>
            <td>
                <a class="link--edit"
                   href="index.php?controller=medecin&action=edit&id=<?= (int) $m['id'] ?>">
                    Modifier
                </a>
                |
                <a class="link--delete"
                   href="index.php?controller=medecin&action=delete&id=<?= (int) $m['id'] ?>"
                   onclick="return confirm('Supprimer ce médecin ?')">
                    Supprimer
                </a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>
