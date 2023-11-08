<?php
class Fournisseur{
    private $Id_Fournisseur;
    private $Forme_Juridique;
    private $Nom_Fournisseur;
    private $Adresse;
    private $Telephone;
    private $Email;
    private $Numero_SIRET;


        public function __construct($Id_Fournisseur, $Forme_Juridique, $Nom_Fournisseur, $Adresse, $Telephone, $Email, $Numero_SIRET){
            $this->Id_Fournisseur=$Id_Fournisseur;
            $this->Forme_Juridique=$Forme_Juridique;
            $this->Nom_Fournisseur=$Nom_Fournisseur;
            $this->Adresse = $Adresse;
            $this->Telephone = $Telephone;
            $this->Email = $Email;
            $this->Numero_SIRET = $Numero_SIRET;
    
        }

    //----------------------------------------------- Creer -----------------------------------------------

    public function createFournisseur() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Fournisseur (Forme_Juridique, Nom_Fournisseur, Adresse, Telephone, Email, Numero_SIRET) 
                                VALUES (:Forme_Juridique, :Nom_Fournisseur, :Adresse, :Telephone, :Email, :Numero_SIRET)');
        $stmt->bindParam(':Forme_Juridique', $this->Forme_Juridique, PDO::PARAM_STR);
        $stmt->bindParam(':Nom_Fournisseur', $this->Nom_Fournisseur, PDO::PARAM_STR);
        $stmt->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
        $stmt->bindParam(':Telephone', $this->Telephone, PDO::PARAM_STR);
        $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
        $stmt->bindParam(':Numero_SIRET', $this->Numero_SIRET, PDO::PARAM_STR);

        $stmt->execute();
    }
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomFournisseurExists($Nom_Fournisseur) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Fournisseur WHERE Nom_Fournisseur = :Nom_Fournisseur");
        $stmt->bindParam(':Nom_Fournisseur', $Nom_Fournisseur, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoFournisseur($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Fournisseur WHERE Id_Fournisseur = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Fournisseur avec les données récupérées
        $Fournisseur = new Fournisseur($data['Id_Fournisseur'], $data['Forme_Juridique'], 
                                        $data['Nom_Fournisseur'], $data['Adresse'], $data['Telephone'], 
                                        $data['Email'], $data['Numero_SIRET']);
        return $Fournisseur;
    }
    
    

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoFournisseur($Id, $Forme_Juridique, $Nom_Fournisseur, $Adresse, $Telephone, $Email) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Fournisseur 
                                SET Forme_Juridique = :Forme_Juridique, Nom_Fournisseur = :Nom_Fournisseur,
                                Adresse = :Adresse, Telephone = :Telephone, Email = :Email, Numero_SIRET = :Numero_SIRET
                                WHERE Id_Fournisseur = :Id");
    
        // Utilisation de bindParam pour lier les valeurs des variables aux paramètres de la requête préparée
        $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Forme_Juridique', $Forme_Juridique, PDO::PARAM_STR);
        $update->bindParam(':Nom_Fournisseur', $Nom_Fournisseur, PDO::PARAM_STR);
        $update->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
        $update->bindParam(':Telephone', $this->Telephone, PDO::PARAM_STR);
        $update->bindParam(':Email', $this->Email, PDO::PARAM_STR);
        $update->bindParam(':Numero_SIRET', $this->Numero_SIRET, PDO::PARAM_STR);
    
        $update->execute();
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllFournisseur() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Fournisseur");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Fournisseurs = array();
        foreach ($data as $FournisseurData) {
            $Fournisseur = new Fournisseur($FournisseurData['Id_Fournisseur'],$FournisseurData['Forme_Juridique'], 
                                            $FournisseurData['Nom_Fournisseur'], $FournisseurData['Adresse'], 
                                            $FournisseurData['Telephone'], $FournisseurData['Email'], $FournisseurData['Numero_SIRET']);
            array_push($Fournisseurs, $Fournisseur);
        }
        return $Fournisseurs;
    }
    //$bdd
    //----------------------------------------------- Supprimer -----------------------------------------------
    public function deleteFournisseurById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("DELETE FROM Fournisseur WHERE Id_Fournisseur = :Id");
            $stmt->bindParam(':Id', $this->Id_Fournisseur, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression de la Fournisseur : " . $e->getMessage());
            return false;
        }
    }

    /**
     * Get the value of Id_Fournisseur
     */ 
    public function getId_Fournisseur()
    {
        return $this->Id_Fournisseur;
    }

    /**
     * Set the value of Id_Fournisseur
     *
     * @return  self
     */ 
    public function setId_Fournisseur($Id_Fournisseur)
    {
        $this->Id_Fournisseur = $Id_Fournisseur;

        return $this;
    }

        /**
     * Get the value of Forme_Juridique
     */ 
    public function getForme_Juridique()
    {
        return $this->Forme_Juridique;
    }

    /**
     * Set the value of Forme_Juridique
     *
     * @return  self
     */ 
    public function setForme_Juridique($Forme_Juridique)
    {
        $this->Forme_Juridique = $Forme_Juridique;

        return $this;
    }

    /**
     * Get the value of Nom_Fournisseur
     */ 
    public function getNom_Fournisseur()
    {
        return $this->Nom_Fournisseur;
    }

    /**
     * Set the value of Nom_Fournisseur
     *
     * @return  self
     */ 
    public function setNom_Fournisseur($Nom_Fournisseur)
    {
        $this->Nom_Fournisseur = $Nom_Fournisseur;

        return $this;
    }

        /**
     * Get the value of Adresse
     */ 
    public function getAdresse()
    {
        return $this->Adresse;
    }

    /**
     * Set the value of Adresse
     *
     * @return  self
     */ 
    public function setAdresse($Adresse)
    {
        $this->Adresse = $Adresse;

        return $this;
    }

        /**
     * Get the value of Telephone
     */ 
    public function getTelephone()
    {
        return $this->Telephone;
    }

    /**
     * Set the value of Telephone
     *
     * @return  self
     */ 
    public function setTelephone($Telephone)
    {
        $this->Telephone = $Telephone;

        return $this;
    }

        /**
     * Get the value of Email
     */ 
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * Set the value of Email
     *
     * @return  self
     */ 
    public function setEmail($Email)
    {
        $this->Email = $Email;

        return $this;
    }

            /**
     * Get the value of Numero_SIRET
     */ 
    public function getNumero_SIRET()
    {
        return $this->Numero_SIRET;
    }

    /**
     * Set the value of Numero_SIRET
     *
     * @return  self
     */ 
    public function setNumero_SIRET($Numero_SIRET)
    {
        $this->Numero_SIRET = $Numero_SIRET;

        return $this;
    }

}
?>