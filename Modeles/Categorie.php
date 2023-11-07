<?php
class Categorie{
    private $Id_Categorie;
    private $Nom_Categorie;

        public function __construct($Id_Categorie,$Nom_Categorie){
            $this->Id_Categorie=$Id_Categorie;
            $this->Nom_Categorie=$Nom_Categorie;
        }

    //----------------------------------------------- Creer -----------------------------------------------

    public function createCategorie() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Categorie (Nom_Categorie) VALUES (:Nom_Categorie)');
        $stmt->bindParam(':Nom_Categorie', $this->Nom_Categorie, PDO::PARAM_STR);
        $stmt->execute();
    }
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomCategorieExists($Nom_Categorie) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Categorie WHERE Nom_Categorie = :Nom_Categorie");
        $stmt->bindParam(':Nom_Categorie', $Nom_Categorie, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoCategorie($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Categorie WHERE Id_Categorie = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Categorie avec les données récupérées
        $Categorie = new Categorie($data['Id_Categorie'], $data['Nom_Categorie']);
        return $Categorie;
    }
    
    

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoCategorie($Id, $Nom_Categorie) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Categorie SET Nom_Categorie = :Nom_Categorie WHERE Id_Categorie = :Id");
    
        // Utilisation de bindParam pour lier les valeurs des variables aux paramètres de la requête préparée
        $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom_Categorie', $Nom_Categorie, PDO::PARAM_STR);
    
        $update->execute();
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllCategorie() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Categorie");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Categories = array();
        foreach ($data as $CategorieData) {
            $Categorie = new Categorie($CategorieData['Id_Categorie'], $CategorieData['Nom_Categorie']);
            array_push($Categories, $Categorie);
        }
        return $Categories;
    }
    //$bdd
    //----------------------------------------------- Supprimer -----------------------------------------------
    public function deleteCategorieById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("DELETE FROM Categorie WHERE Id_Categorie = :Id");
            $stmt->bindParam(':Id', $this->Id_Categorie, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression de la Categorie : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the value of Id_Categorie
     */ 
    public function getId_Categorie()
    {
        return $this->Id_Categorie;
    }

    /**
     * Set the value of Id_Categorie
     *
     * @return  self
     */ 
    public function setId_Categorie($Id_Categorie)
    {
        $this->Id_Categorie = $Id_Categorie;

        return $this;
    }

    /**
     * Get the value of Nom_Categorie
     */ 
    public function getNom_Categorie()
    {
        return $this->Nom_Categorie;
    }

    /**
     * Set the value of Nom_Categorie
     *
     * @return  self
     */ 
    public function setNom_Categorie($Nom_Categorie)
    {
        $this->Nom_Categorie = $Nom_Categorie;

        return $this;
    }

}
?>