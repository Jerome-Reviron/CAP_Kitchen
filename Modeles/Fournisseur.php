<?php
class Fournisseur{
    private $Id_Fournisseur;
    private $Forme_Juridique;
    private $Nom_Fournisseur;
    private $Adresse;
    private $Telephone;
    private $Email;
    private $Numero_SIRET;

    public function __construct($Forme_Juridique, $Nom_Fournisseur, $Adresse, $Telephone, $Email, $Numero_SIRET, $Id_Fournisseur = null){

        $this->Forme_Juridique = $Forme_Juridique;
        $this->Nom_Fournisseur = $Nom_Fournisseur;
        $this->Adresse = $Adresse;
        $this->Telephone = $Telephone;
        $this->Email = $Email;
        $this->Numero_SIRET = $Numero_SIRET;
        $this->Id_Fournisseur = $Id_Fournisseur;
    }

    //----------------------------------------------------------------------Inscription--------------------------------------------------------------------------//

    public static function Nom_FournisseurExists($Nom_Fournisseur) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT Forme_Juridique, Nom_Fournisseur, Adresse, Telephone, Email, Numero_SIRET FROM Fournisseur WHERE Nom_Fournisseur = :Nom_Fournisseur");
        $stmt->bindParam(':Nom_Fournisseur', $Nom_Fournisseur, pdo::PARAM_STR);
        $stmt->execute();
        $existing_Fournisseur = $stmt->fetch();
        return $existing_Fournisseur === false;
    }

    public function postInscription() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("INSERT INTO Fournisseur(Forme_Juridique, Nom_Fournisseur, Adresse, Telephone, Email, Numero_SIRET) VALUES(:Forme_Juridique, :Nom_Fournisseur, :Adresse, :Telephone, :Email, :Numero_SIRET)");
        $stmt->bindParam(':Forme_Juridique', $this->Forme_Juridique, PDO::PARAM_STR);
        $stmt->bindParam(':Nom_Fournisseur', $this->Nom_Fournisseur, PDO::PARAM_STR);
        $stmt->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
        $stmt->bindParam(':Telephone', $this->Telephone, PDO::PARAM_STR);
        $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
        $stmt->bindParam(':Numero_SIRET', $this->Numero_SIRET, PDO::PARAM_STR);
        $stmt->execute();
    return $stmt->rowCount() > 0;
    }

    //------------------------------------------------------------------------Selection-------------------------------------------------------------------------//
    
    public static function getInfoFournisseur($Id_Fournisseur) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Fournisseur
                                WHERE Id_Fournisseur = :Id_Fournisseur");

        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id_Fournisseur', $Id_Fournisseur, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetch();

        // Vérifier si le tableau est vide
        if ($data === false) {
            return null; 
        }

        // Instancier un objet avec les données récupérées
        $Fournisseur = new Fournisseur($data['Forme_Juridique'], $data['Nom_Fournisseur'],
                                $data['Adresse'], $data['Telephone'], $data['Email'],
                                $data['Numero_SIRET'], $data['Id_Fournisseur']);
        return $Fournisseur;
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllFournisseur() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Fournisseur");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Fournisseurs = array();
        foreach ($data as $Fournisseurdata) {
            $Fournisseur = new Fournisseur($Fournisseurdata['Forme_Juridique'], $Fournisseurdata['Nom_Fournisseur'], 
                                $Fournisseurdata['Adresse'], $Fournisseurdata['Telephone'], $Fournisseurdata['Email'],
                                $Fournisseurdata['Numero_SIRET'], $Fournisseurdata['Id_Fournisseur']);
            
            array_push($Fournisseurs, $Fournisseur);
        }
        return $Fournisseurs;
    }

    //----------------------------------------------- Supprimer -----------------------------------------------
    
    public function deleteFournisseurById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();

            // Suppression du object dans la table Fournisseur
            $stmt = $bdd->prepare("DELETE FROM Fournisseur WHERE Id_Fournisseur = :Id");
            $stmt->bindParam(':Id', $this->Id_Fournisseur, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression du Fournisseur : " . $e->getMessage());
            return false;
        }
    }

    //------------------------------------------------------------ Modifier ------------------------------------------------------------

    public function postInfoFournisseur($Forme_Juridique, $Nom_Fournisseur, $Adresse, $Telephone, $Email, $Numero_SIRET, $Id) {
        $bdd = bddconnexion::getInstance()->getBdd();

        // Mise à jour de la table Fournisseur
        $updateFournisseur = $bdd->prepare("UPDATE Fournisseur SET Forme_Juridique = :Forme_Juridique, Nom_Fournisseur = :Nom_Fournisseur, 
                                            Adresse = :Adresse, Telephone = :Telephone, Email = :Email, Numero_SIRET = :Numero_SIRET
                                            WHERE Id_Fournisseur = :Id");
        $updateFournisseur->bindParam(':Id', $Id, PDO::PARAM_INT);
        $updateFournisseur->bindParam(':Forme_Juridique', $Forme_Juridique, PDO::PARAM_STR);
        $updateFournisseur->bindParam(':Nom_Fournisseur', $Nom_Fournisseur, PDO::PARAM_STR);
        $updateFournisseur->bindParam(':Adresse', $Adresse, PDO::PARAM_STR);
        $updateFournisseur->bindParam(':Telephone', $Telephone, PDO::PARAM_STR);
        $updateFournisseur->bindParam(':Email', $Email, PDO::PARAM_STR);
        $updateFournisseur->bindParam(':Numero_SIRET', $Numero_SIRET, PDO::PARAM_STR);

        $updateFournisseurResult = $updateFournisseur->execute();

        return true;
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