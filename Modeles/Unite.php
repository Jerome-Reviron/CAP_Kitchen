<?php
class Unite{
    private $Id_Unite;
    private $Nom_Unite;
    private $Chiffre;
    private $Valeur;

    public function __construct($Id_Unite, $Nom_Unite, $Chiffre, $Valeur){

        $this->Nom_Unite = $Nom_Unite;
        $this->Chiffre = $Chiffre;
        $this->Valeur = $Valeur;
        $this->Id_Unite = $Id_Unite;
    }

    
    //----------------------------------------------- Creer -----------------------------------------------

    public function createUnite() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Unite (Nom_Unite, Chiffre, Valeur) VALUES (:Nom_Unite, :Chiffre, :Valeur)');
        $stmt->bindParam(':Nom_Unite', $this->Nom_Unite, PDO::PARAM_STR);
        $stmt->bindParam(':Chiffre', $this->Chiffre, PDO::PARAM_INT);
        $stmt->bindParam(':Valeur', $this->Valeur, PDO::PARAM_STR);
        $stmt->execute();
    }
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomUniteExists($Nom_Unite) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Unite WHERE Nom_Unite = :Nom_Unite");
        $stmt->bindParam(':Nom_Unite', $Nom_Unite, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoUnite($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Unite WHERE Id_Unite = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Unite avec les données récupérées
        $Unite = new Unite($data['Id_Unite'], $data['Nom_Unite'], $data['Chiffre'], $data['Valeur']);
        return $Unite;
    }
    
    

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoUnite($Id, $Nom_Unite, $Chiffre, $Valeur) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Unite SET Nom_Unite = :Nom_Unite, Chiffre = :Chiffre, Valeur = :Valeur WHERE Id_Unite = :Id");
    
        // Utilisation de bindParam pour lier les valeurs des variables aux paramètres de la requête préparée
        $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom_Unite', $Nom_Unite, PDO::PARAM_STR);
        $update->bindParam(':Chiffre', $Chiffre, PDO::PARAM_INT);
        $update->bindParam(':Valeur', $Valeur, PDO::PARAM_STR);
    
        $update->execute();
    }

    //----------------------------------------------- Object -----------------------------------------------//

    public static function getAllUnite() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Unite");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Unites = array();
        foreach ($data as $UniteData) {
            $Unite = new Unite($UniteData['Id_Unite'], $UniteData['Nom_Unite'], $UniteData['Chiffre'], $UniteData['Valeur']);
            array_push($Unites, $Unite);
        }
        return $Unites;
    }
    //$bdd
    //----------------------------------------------- Supprimer -----------------------------------------------//

    public function deleteUniteById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("DELETE FROM Unite WHERE Id_Unite = :Id");
            $stmt->bindParam(':Id', $this->Id_Unite, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression de la Unite : " . $e->getMessage());
            return false;
        }
    }

    //---------------------------------- Récupérer toutes les valeurs distinctes ---------------------------------//

    public static function getValeursFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Nom_Unite FROM Unite"); 
        $stmt->execute();
        $valeurs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $valeurs;
    }

    /**
     * Get the value of Id_Unite
     */ 
    public function getId_Unite()
    {
        return $this->Id_Unite;
    }

    /**
     * Set the value of Id_Unite
     *
     * @return  self
     */ 
    public function setId_Unite($Id_Unite)
    {
        $this->Id_Unite = $Id_Unite;

        return $this;
    }

    /**
     * Get the value of Nom_Unite
     */ 
    public function getNom_Unite()
    {
        return $this->Nom_Unite;
    }

    /**
     * Set the value of Nom_Unite
     *
     * @return  self
     */ 
    public function setNom_Unite($Nom_Unite)
    {
        $this->Nom_Unite = $Nom_Unite;

        return $this;
    }

        /**
     * Get the value of Chiffre
     */ 
    public function getChiffre()
    {
        return $this->Chiffre;
    }

    /**
     * Set the value of Chiffre
     *
     * @return  self
     */ 
    public function setChiffre($Chiffre)
    {
        $this->Chiffre = $Chiffre;

        return $this;
    }

        /**
     * Get the value of Valeur
     */ 
    public function getValeur()
    {
        return $this->Valeur;
    }

    /**
     * Set the value of Valeur
     *
     * @return  self
     */ 
    public function setValeur($Valeur)
    {
        $this->Valeur = $Valeur;

        return $this;
    }

}
?>