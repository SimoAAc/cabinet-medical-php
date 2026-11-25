<?php
$pageTitle = "Gestion des patients";
require __DIR__ . "/../layout/header.php";
?>

<h1>Liste des patients</h1>

<a class="btn btn--soft" href="index.php?controller=patient&action=create">
    Ajouter un patient
</a>

<br><br>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>CIN</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>Actions</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($patients as $p): ?>
            <tr>
                <td><?= (int) $p["id"] ?></td>
                <td><?= htmlspecialchars($p["nom"]) ?></td>
                <td><?= htmlspecialchars($p["prenom"]) ?></td>
                <td><?= htmlspecialchars($p["cin"]) ?></td>
                <td><?= htmlspecialchars($p["date_naissance"]) ?></td>
                <td><?= htmlspecialchars($p["telephone"] ?? "") ?></td>
                <td>
                    <a class="link--edit"
                       href="index.php?controller=patient&action=edit&id=<?= (int) $p['id'] ?>">
                        Modifier
                    </a>

                    |

                    <a class="link--delete"
                       href="index.php?controller=patient&action=delete&id=<?= (int) $p['id'] ?>"
                       onclick="return confirm('Supprimer ce patient ?')">
                        Supprimer
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php require __DIR__ . "/../layout/footer.php"; ?>
