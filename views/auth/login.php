<?php
$pageTitle = "Connexion";
require __DIR__ . "/../layout/header.php";
?>

<h1>Cabinet médical</h1>
<h2>Connexion secrétaire</h2>

<?php if (!empty($erreur)): ?>
    <p class="alert alert--error">
        <?= htmlspecialchars($erreur) ?>
    </p>
<?php endif; ?>

<form action="index.php?controller=auth&action=login" method="POST">

    <div class="form-group">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
    </div>

    <div class="form-group">
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
    </div>

    <button type="submit" class="btn btn--primary btn--block">
        Se connecter
    </button>

</form>

<?php require __DIR__ . "/../layout/footer.php"; ?>
