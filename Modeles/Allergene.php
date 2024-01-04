<?php
class Allergene{
    private $Id_Allergene;
    private $Nom_Allergene;


        public function __construct($Id_Allergene,$Nom_Allergene){

            $this->Id_Allergene = $Id_Allergene;
            $this->Nom_Allergene = $Nom_Allergene;
        }

    //----------------------------------------------- Creer -----------------------------------------------

    public function createAllergene($Id_Admin) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Allergene (Nom_Allergene) 
                                VALUES (:Nom_Allergene)');
        $stmt->bindParam(':Nom_Allergene', $this->Nom_Allergene, PDO::PARAM_STR);
        $stmt->execute();
    
        // Récupérer l'ID de la catégorie nouvellement créée
        $Id_Allergene = $bdd->lastInsertId();

        // $Id_Fournisseur est défini dans l'instance actuelle
        $this->Id_Allergene = $Id_Allergene;
    
        // Insérer dans la table Consulte
        $stmtConsulte = $bdd->prepare('INSERT INTO Consulte (Id_Admin, Id_Allergene) 
                                        VALUES (:Id_Admin, :Id_Allergene)');
        $stmtConsulte->bindParam(':Id_Admin', $Id_Admin, PDO::PARAM_INT);
        $stmtConsulte->bindParam(':Id_Allergene', $Id_Allergene, PDO::PARAM_INT);
        $stmtConsulte->execute();
    }
    
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomAllergeneExists($Nom_Allergene, $Id_Entreprise) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT A.* 
                                                                FROM Allergene AL
                                                                JOIN Consulte C ON AL.Id_Allergene = C.Id_Allergene
                                                                JOIN Admin A ON C.Id_Admin = A.Id_Admin
                                                                WHERE AL.Nom_Allergene = :Nom_Allergene 
                                                                AND A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Nom_Allergene', $Nom_Allergene, PDO::PARAM_STR);
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoAllergene($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Allergene 
                                WHERE Id_Allergene = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Allergene avec les données récupérées
        $Allergene = new Allergene($data['Id_Allergene'], $data['Nom_Allergene']);
        return $Allergene;
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllAllergene($IdEntrepriseSession) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT A.* 
                                FROM Allergene AL
                                JOIN Consulte C ON AL.Id_Allergene = C.Id_Allergene
                                JOIN Admin A ON C.Id_Admin = A.Id_Admin
                                WHERE AL.Nom_Allergene = :Nom_Allergene 
                                AND A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Id_Entreprise', $IdEntrepriseSession, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Allergenes = array();
        foreach ($data as $AllergeneData) {
            $Allergene = new Allergene($AllergeneData['Id_Allergene'], 
                            $AllergeneData['Nom_Allergene']);

            array_push($Allergenes, $Allergene);
        }
        return $Allergenes;
    }

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoAllergene($Id, $Nom_Allergene, $Genre) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Allergene 
                                SET Nom_Allergene = :Nom_Allergene
                                WHERE Id_Allergene = :Id");
            $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom_Allergene', $Nom_Allergene, PDO::PARAM_STR);
    
        $update->execute();
    }
    
    //----------------------------------------------- Supprimer -----------------------------------------------
    public function deleteAllergeneById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("DELETE FROM Allergene WHERE Id_Allergene = :Id");
            $stmt->bindParam(':Id', $this->Id_Allergene, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression de la Allergene : " . $e->getMessage());
            return false;
        }
    }

    //---------------------------------- Récupérer toutes les Genres distinctes ---------------------------------//

    public static function getAllergenesFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Id_Allergene, Nom_Allergene FROM Allergene"); 
        $stmt->execute();
        $Allergenes = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Allergenes;
    }

    //----------------------------------Récupérer les Allergènes d'un ingredients --------------------------------//

    public static function getAllergenesForIngredient($Id) {
        $bdd = bddconnexion::getInstance()->getBdd(); 
        $stmt = $bdd->prepare("SELECT A.*
                            FROM Allergene A 
                            JOIN Contient C ON A.Id_Allergene = C.Id_Allergene 
                            WHERE C.Id_Ingredient = :Id");
    
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
        $stmt->execute();
        $AllergenesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $Allergenes = [];
        foreach ($AllergenesData as $data) {
            $Allergenes[] = new Allergene($data['Id_Allergene'], $data['Nom_Allergene']);
        }
    
        return $Allergenes;
    }
    
    /**
     * Get the value of Id_Allergene
     */ 
    public function getId_Allergene()
    {
        return $this->Id_Allergene;
    }

    /**
     * Set the value of Id_Allergene
     *
     * @return  self
     */ 
    public function setId_Allergene($Id_Allergene)
    {
        $this->Id_Allergene = $Id_Allergene;

        return $this;
    }

    /**
     * Get the value of Nom_Allergene
     */ 
    public function getNom_Allergene()
    {
        return $this->Nom_Allergene;
    }

    /**
     * Set the value of Nom_Allergene
     *
     * @return  self
     */ 
    public function setNom_Allergene($Nom_Allergene)
    {
        $this->Nom_Allergene = $Nom_Allergene;

        return $this;
    }
}
?>