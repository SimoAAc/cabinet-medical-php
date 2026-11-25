
<?php

require_once __DIR__ . "/../config/Database.php";

class Patient
{
    private $pdo;

    public function __construct()
    {
        $db = new Database();
        $this->pdo = $db->connect();
    }

    // Afficher tous les patients
    public function getAll()
    {
        $sql = "SELECT * FROM patients ORDER BY id DESC";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Ajouter un patient
    public function ajouter($nom, $prenom, $cin, $date_naissance, $telephone)
    {
        $sql = "INSERT INTO patients
                (nom, prenom, cin, date_naissance, telephone)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $cin,
            $date_naissance,
            $telephone
        ]);
    }

    // Trouver un patient par ID
    public function getById($id)
    {
        $stmt = $this->pdo->prepare(
            "SELECT * FROM patients WHERE id = ?"
        );

        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Modifier un patient
    public function modifier($id, $nom, $prenom, $cin, $date_naissance, $telephone)
     {
        $sql = "UPDATE patients
                SET nom = ?, prenom = ?, cin = ?,
                    date_naissance = ?, telephone = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $nom,
            $prenom,
            $cin,
            $date_naissance,
            $telephone,
            $id
        ]);
     }

    // Supprimer un patient
    public function supprimer($id)
     {
        $stmt = $this->pdo->prepare(
            "DELETE FROM patients WHERE id = ?"
        );

        return $stmt->execute([$id]);
 
 
 
        }

        
}
