<?php
class Entreprise{
    private $Id_Entreprise;
    private $Nom;
    private $Adresse;
    private $Telephone;
    private $Email;

    public function __construct($Nom, $Adresse, $Telephone, $Email, $Id_Entreprise = null){

        $this->Nom = $Nom;
        $this->Adresse = $Adresse;
        $this->Telephone = $Telephone;
        $this->Email = $Email;
        $this->Id_Entreprise = $Id_Entreprise;
    }

    //------------------------------------------------------------------------Selection-------------------------------------------------------------------------//
    
    public static function getInfoEntreprise($Id_Entreprise) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Entreprise
                                WHERE Id_Entreprise = :Id_Entreprise");

        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetch();

        // Vérifier si le tableau est vide
        if ($data === false) {
            return null; 
        }

        // Instancier un objet avec les données récupérées
        $Entreprise = new Entreprise($data['Nom'], $data['Adresse'], $data['Telephone'], $data['Email'], $data['Id_Entreprise']);
        return $Entreprise;
    }

        /**
     * Get the value of Id_Entreprise
     */ 
    public function getId_Entreprise()
    {
        return $this->Id_Entreprise;
    }

    /**
     * Set the value of Id_Entreprise
     *
     * @return  self
     */ 
    public function setId_Entreprise($Id_Entreprise)
    {
        $this->Id_Entreprise = $Id_Entreprise;

        return $this;
    }

    /**
     * Get the value of Nom
     */ 
    public function getNom()
    {
        return $this->Nom;
    }

    /**
     * Set the value of Nom
     *
     * @return  self
     */ 
    public function setNom($Nom)
    {
        $this->Nom = $Nom;

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
    
}

?>
