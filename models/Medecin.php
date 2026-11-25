
<?php

require_once __DIR__ . "/../config/Database.php";

class Medecin
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    // Afficher tous les médecins
    public function getAll()
    {
        $stmt = $this->pdo->query(
            "SELECT * FROM medecins ORDER BY id DESC"
        );

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un médecin
    public function ajouter($nom, $prenom, $specialite, $telephone)
    {
        $sql = "INSERT INTO medecins
                (nom, prenom, specialite, telephone)
                VALUES (?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $specialite,
            $telephone
        ]);
    }

    // Trouver un médecin par ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM medecins WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modifier un médecin
    public function modifier($id, $nom, $prenom, $specialite, $telephone)
    {
        $sql = "UPDATE medecins
                SET nom = ?, prenom = ?, specialite = ?, telephone = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $specialite,
            $telephone,
            $id
        ]);
    }

    // Supprimer un médecin
    public function supprimer($id)
    {
        $stmt = $this->pdo->prepare(
            "DELETE FROM medecins WHERE id = ?"
        );

        return $stmt->execute([$id]);
    }
}
