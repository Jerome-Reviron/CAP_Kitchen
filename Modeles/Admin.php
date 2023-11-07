<?php
class Admin{
    private $Id_Admin;
    private $Nom;
    private $Prenom;
    private $Pseudo;
    private $Password;
    private $Adresse;
    private $Telephone;
    private $Email;
    private $Role;
    private $Id_Entreprise;

    public function __construct($Nom, $Prenom, $Pseudo, $Password, $Adresse, $Telephone, $Email, $Role, $Id_Entreprise, $Id_Admin = null){

        $this->Nom = $Nom;
        $this->Prenom = $Prenom;
        $this->Pseudo = $Pseudo;
        $this->Password = $Password;
        $this->Adresse = $Adresse;
        $this->Telephone = $Telephone;
        $this->Email = $Email;
        $this->Role = $Role;
        $this->Id_Entreprise = $Id_Entreprise;
        $this->Id_Admin = $Id_Admin;
    }

    //----------------------------------------------------------------------Inscription--------------------------------------------------------------------------//

    public static function EmailExists($Email) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT Nom, Prenom, Pseudo, Password, Adresse, Telephone, Email, Role, Id_Entreprise FROM Admin WHERE Email = :Email");
        $stmt->bindParam(':Email', $Email, pdo::PARAM_STR);
        $stmt->execute();
        $existing_Admin = $stmt->fetch();
        return $existing_Admin === false;
    }

    public function postInscription() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("INSERT INTO Admin(Nom, Prenom, Pseudo, Password, Adresse, Telephone, Email, Role, Id_Entreprise) VALUES(:Nom, :Prenom, :Pseudo, :Password, :Adresse, :Telephone, :Email, :Role, :Id_Entreprise)");
        $stmt->bindParam(':Nom', $this->Nom, PDO::PARAM_STR);
        $stmt->bindParam(':Prenom', $this->Prenom, PDO::PARAM_STR);
        $stmt->bindParam(':Pseudo', $this->Pseudo, PDO::PARAM_STR);
        $stmt->bindParam(':Password', $this->Password, PDO::PARAM_STR);
        $stmt->bindParam(':Adresse', $this->Adresse, PDO::PARAM_STR);
        $stmt->bindParam(':Telephone', $this->Telephone, PDO::PARAM_STR);
        $stmt->bindParam(':Email', $this->Email, PDO::PARAM_STR);
        $stmt->bindParam(':Role', $this->Role, PDO::PARAM_INT);
        $stmt->bindParam(':Id_Entreprise',$this->Id_Entreprise, PDO::PARAM_INT);
        $stmt->execute();
    return $stmt->rowCount() > 0;
    }

    //------------------------------------------------------------------------Selection-------------------------------------------------------------------------//
    
    public static function getInfoAdmin($Id_Admin) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Admin
                                WHERE Id_Admin = :Id_Admin");

        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id_Admin', $Id_Admin, PDO::PARAM_INT);

        $stmt->execute();
        $data = $stmt->fetch();

        // Vérifier si le tableau est vide
        if ($data === false) {
            return null; 
        }

        // Instancier un objet avec les données récupérées
        $Admin = new Admin($data['Nom'], $data['Prenom'], $data['Pseudo'], $data['Password'], 
                                $data['Adresse'], $data['Telephone'], $data['Email'],
                                $data['Role'], $data['Id_Entreprise'], $data['Id_Admin']);
        return $Admin;
    }

    //--------------------------------------------------------------------------Connexion-----------------------------------------------------------------------//
    
    // Vérification de l'inscription d'un utilisateur en comparant son pseudo et son mot de passe
    public static function getCoAdmin($Pseudo, $Password) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * 
                                FROM Admin 
                                WHERE Pseudo = :Pseudo");
        $stmt->bindParam(':Pseudo', $Pseudo, PDO::PARAM_STR);
        $stmt->execute();
        $data = $stmt->fetch();

        if ($data && password_verify($Password, $data['Password'])) {
            $user = new self($data['Nom'], $data['Prenom'], $data['Pseudo'], $data['Password'], 
                                $data['Adresse'], $data['Telephone'], $data['Email'],
                                $data['Role'], $data['Id_Entreprise'], $data['Id_Admin']);
        } else {
            $user = false;
        }

        return $user;
    }


    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllAdmin() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Admin");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Admins = array();
        foreach ($data as $Admindata) {
            $Admin = new Admin($Admindata['Nom'], $Admindata['Prenom'], $Admindata['Pseudo'], $Admindata['Password'], 
                                $Admindata['Adresse'], $Admindata['Telephone'], $Admindata['Email'],
                                $Admindata['Role'], $Admindata['Id_Entreprise'], $Admindata['Id_Admin']);
            
            array_push($Admins, $Admin);
        }
        return $Admins;
    }

    //----------------------------------------------- Supprimer -----------------------------------------------
    
    public function deleteAdminById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();

            // Suppression du produit dans la table Admin
            $stmt = $bdd->prepare("DELETE FROM Admin WHERE Id_Admin = :Id");
            $stmt->bindParam(':Id', $this->Id_Admin, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression du Admin : " . $e->getMessage());
            return false;
        }
    }

    //------------------------------------------------------------ Modifier ------------------------------------------------------------

    public function postInfoAdmin($Nom, $Prenom, $Pseudo, $Password, $Adresse, $Telephone, $Email, $Role, $Id_Entreprise, $Id) {
        $bdd = bddconnexion::getInstance()->getBdd();

        // Mise à jour de la table Admin
        $updateAdmin = $bdd->prepare("UPDATE Admin SET Nom = :Nom, Prenom = :Prenom, Pseudo = :Pseudo, 
                                            Password = :Password, Adresse = :Adresse, Telephone = :Telephone, Email = :Email, Role = :Role, Id_Entreprise = :Id_Entreprise
                                            WHERE Id_Admin = :Id");
        $updateAdmin->bindParam(':Id', $Id, PDO::PARAM_INT);
        $updateAdmin->bindParam(':Nom', $Nom, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Prenom', $Prenom, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Pseudo', $Pseudo, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Password', $Password, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Adresse', $Adresse, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Telephone', $Telephone, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Email', $Email, PDO::PARAM_STR);
        $updateAdmin->bindParam(':Role', $Role, PDO::PARAM_INT);
        $updateAdmin->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);

        $updateAdminResult = $updateAdmin->execute();

        // Si tout s'est bien passé, retourner true
        return true;
    }


    /**
     * Get the value of Id_Admin
     */ 
    public function getId_Admin()
    {
        return $this->Id_Admin;
    }

    /**
     * Set the value of Id_Admin
     *
     * @return  self
     */ 
    public function setId_Admin($Id_Admin)
    {
        $this->Id_Admin = $Id_Admin;

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
     * Get the value of Prenom
     */ 
    public function getPrenom()
    {
        return $this->Prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @return  self
     */ 
    public function setPrenom($Prenom)
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * Get the value of Pseudo
     */ 
    public function getPseudo()
    {
        return $this->Pseudo;
    }

    /**
     * Set the value of Pseudo
     *
     * @return  self
     */ 
    public function setPseudo($Pseudo)
    {
        $this->Pseudo = $Pseudo;

        return $this;
    }

    /**
     * Get the value of Password
     */ 
    public function getPassword()
    {
        return $this->Password;
    }

    /**
     * Set the value of Password
     *
     * @return  self
     */ 
    public function setPassword($Password)
    {
        $this->Password = $Password;

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
     * Get the value of Role
     */ 
    public function getRole()
    {
        return $this->Role;
    }

    /**
     * Set the value of Role
     *
     * @return  self
     */ 
    public function setRole($Role)
    {
        $this->Role = $Role;

        return $this;
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
    
}

?>