
-- ============================================

CREATE DATABASE IF NOT EXISTS cabinet_medical
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE cabinet_medical;

-- ============================================
-- 1. TABLE PATIENTS
-- ============================================

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    cin VARCHAR(20) NOT NULL UNIQUE,
    date_naissance DATE,
    telephone VARCHAR(20)
) ENGINE=InnoDB;

-- ============================================
-- 2. TABLE MEDECINS
-- ============================================

CREATE TABLE IF NOT EXISTS medecins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100) NOT NULL,
    telephone VARCHAR(20)
) ENGINE=InnoDB;

-- ============================================
-- 3. TABLE RENDEZ_VOUS
-- ============================================

CREATE TABLE IF NOT EXISTS rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT NOT NULL,
    medecin_id INT NOT NULL,
    date_rdv DATE NOT NULL,
    heure TIME NOT NULL,
    motif VARCHAR(255) NOT NULL,
    etat ENUM('prévu', 'effectué', 'annulé')
        NOT NULL DEFAULT 'prévu',

    CONSTRAINT fk_rdv_patient
        FOREIGN KEY (patient_id)
        REFERENCES patients(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT fk_rdv_medecin
        FOREIGN KEY (medecin_id)
        REFERENCES medecins(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE,

    CONSTRAINT unique_medecin_creneau
        UNIQUE (medecin_id, date_rdv, heure)
) ENGINE=InnoDB;

-- ============================================
-- 4. TABLE SECRETaires
-- ============================================

CREATE TABLE IF NOT EXISTS secretaires (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
) ENGINE=InnoDB;

-- ============================================
-- 5. DONNEES DE TEST
-- ============================================

INSERT IGNORE INTO patients
(nom, prenom, cin, date_naissance, telephone)
VALUES
('Amrani', 'Sara', 'AB123456', '1998-05-12', '0612345678'),
('Alaoui', 'Youssef', 'CD789012', '1995-09-20', '0623456789'),
('Idrissi', 'Salma', 'EF345678', '2000-02-15', '0634567890');

INSERT IGNORE INTO medecins
(nom, prenom, specialite, telephone)
VALUES
('Bennani', 'Ahmed', 'Cardiologie', '0645678901'),
('Tazi', 'Fatima', 'Dermatologie', '0656789012'),
('El Fassi', 'Omar', 'Médecine générale', '0667890123');

-- Add sample appointments only if their referenced IDs exist.
INSERT IGNORE INTO rendez_vous
(patient_id, medecin_id, date_rdv, heure, motif, etat)
SELECT p.id, m.id, '2027-01-15', '09:00:00',
       'Consultation générale', 'prévu'
FROM patients p
CROSS JOIN medecins m
WHERE p.cin = 'AB123456'
  AND m.specialite = 'Cardiologie';

-- ============================================
-- FIN DU SCRIPT
-- ============================================
```