
<?php

class RendezVous
{
    private $pdo;

    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    //  get all appointments with patient and doctor names
    public function getAll()
    {
        $sql = "SELECT
                    r.*,
                    p.nom AS patient_nom,
                    p.prenom AS patient_prenom,
                    m.nom AS medecin_nom,
                    m.prenom AS medecin_prenom
                FROM rendez_vous r
                JOIN patients p ON r.patient_id = p.id
                JOIN medecins m ON r.medecin_id = m.id
                ORDER BY r.date_rdv, r.heure";

        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    //  get one appointment by ID
    public function getById($id)
    {
        $sql = "SELECT * FROM rendez_vous WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    //  add an appointment
    public function create($patient_id, $medecin_id, $date, $heure, $motif)
    {
        $sql = "INSERT INTO rendez_vous
                (patient_id, medecin_id, date_rdv, heure, motif)
                VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $patient_id,
            $medecin_id,
            $date,
            $heure,
            $motif
        ]);
    }

    //  modify an appointment
    public function update($id, $patient_id, $medecin_id,
                           $date, $heure, $motif)
    {
        $sql = "UPDATE rendez_vous
                SET patient_id = ?,
                    medecin_id = ?,
                    date_rdv = ?,
                    heure = ?,
                    motif = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);

        return $stmt->execute([
            $patient_id,
            $medecin_id,
            $date,
            $heure,
            $motif,
            $id
        ]);
    }

    //  change appointment status
    public function updateEtat($id, $etat)
    {
        $sql = "UPDATE rendez_vous
                SET etat = ?
                WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$etat, $id]);
    }

    //  remove an appointment
    public function delete($id)
    {
        $sql = "DELETE FROM rendez_vous WHERE id = ?";

        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([$id]);
    }

    //  get a doctor's schedule for a selected date(jbad ga3 pation f dik date mea medecin)
    public function getPlanning($medecin_id, $date)
    {
        $sql = "SELECT
                    r.*,
                    p.nom AS patient_nom,
                    p.prenom AS patient_prenom
                FROM rendez_vous r
                JOIN patients p ON r.patient_id = p.id
                WHERE r.medecin_id = ?
                  AND r.date_rdv = ?
                ORDER BY r.heure";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$medecin_id, $date]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
