<?php
class Unite{
    private $Id_Unite;
    private $Nom_Unite;
    private $Genre;
    private $Chiffre;
    private $Valeur;

    public function __construct($Id_Unite, $Nom_Unite, $Genre, $Chiffre, $Valeur){

        $this->Nom_Unite = $Nom_Unite;
        $this->Genre = $Genre;
        $this->Chiffre = $Chiffre;
        $this->Valeur = $Valeur;
        $this->Id_Unite = $Id_Unite;
    }

    
    //----------------------------------------------- Creer -----------------------------------------------

    public function createUnite($Id_Admin) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Unite (Nom_Unite, Genre, Chiffre, Valeur) 
                                VALUES (:Nom_Unite, :Genre, :Chiffre, :Valeur)');
        $stmt->bindParam(':Nom_Unite', $this->Nom_Unite, PDO::PARAM_STR);
        $stmt->bindParam(':Genre', $this->Genre, PDO::PARAM_STR);
        $stmt->bindParam(':Chiffre', $this->Chiffre, PDO::PARAM_STR);
        $stmt->bindParam(':Valeur', $this->Valeur, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer l'ID de la catégorie nouvellement créée
        $Id_Unite = $bdd->lastInsertId();
    
        // $Id_Unite est défini dans l'instance actuelle
        $this->Id_Unite = $Id_Unite;
    
        // Insérer dans la table Contacte
        $stmtContacte = $bdd->prepare('INSERT INTO Contacte (Id_Admin, Id_Unite) 
                                        VALUES (:Id_Admin, :Id_Unite)');
        $stmtContacte->bindParam(':Id_Admin', $Id_Admin, PDO::PARAM_INT);
        $stmtContacte->bindParam(':Id_Unite', $Id_Unite, PDO::PARAM_INT);
        $stmtContacte->execute();
    }
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomUniteExists($Nom_Unite, $Id_Entreprise) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT U.*
                                                                FROM Unite U
                                                                JOIN Cree C ON U.Id_Unite = C.Id_Unite
                                                                JOIN Admin A ON C.Id_Admin = A.Id_Admin
                                                                WHERE U.Nom_Unite = :Nom_Unite 
                                                                AND A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Nom_Unite', $Nom_Unite, PDO::PARAM_STR);
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);
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
        $stmt->bindParam(':Id', $Id, PDO::PARAM_STR);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Unite avec les données récupérées
        $Unite = new Unite($data['Id_Unite'], $data['Nom_Unite'], $data['Genre'],  $data['Chiffre'], $data['Valeur']);
        return $Unite;
    }

    //----------------------------------------------- Object -----------------------------------------------//

    public static function getAllUnite($IdEntrepriseSession) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT U.*
                                FROM Unite U
                                JOIN Cree C ON U.Id_Unite = C.Id_Unite
                                JOIN Admin A ON C.Id_Admin = A.Id_Admin
                                WHERE A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Id_Entreprise', $IdEntrepriseSession, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Unites = array();
        foreach ($data as $UniteData) {
            $Unite = new Unite($UniteData['Id_Unite'], $UniteData['Nom_Unite'], $UniteData['Genre'], $UniteData['Chiffre'], $UniteData['Valeur']);
            array_push($Unites, $Unite);
        }
        return $Unites;
    }

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoUnite($Id, $Nom_Unite, $Genre, $Chiffre, $Valeur) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Unite SET Nom_Unite = :Nom_Unite, Genre = :Genre, Chiffre = :Chiffre, Valeur = :Valeur WHERE Id_Unite = :Id");
    
        // Utilisation de bindParam pour lier les valeurs des variables aux paramètres de la requête préparée
        $update->bindParam(':Id', $Id, PDO::PARAM_STR);
        $update->bindParam(':Nom_Unite', $Nom_Unite, PDO::PARAM_STR);
        $update->bindParam(':Genre', $Genre, PDO::PARAM_STR);
        $update->bindParam(':Chiffre', $Chiffre, PDO::PARAM_STR);
        $update->bindParam(':Valeur', $Valeur, PDO::PARAM_STR);
    
        $update->execute();
    }
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

    //---------------------------------- Récupérer toutes les Genres distinctes ---------------------------------//

    public static function getGenresFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Genre FROM Unite"); 
        $stmt->execute();
        $Genres = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $Genres;
    }    
    
    //---------------------------------- Récupérer toutes les Valeurs distinctes ---------------------------------//

    public static function getValeursFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Nom_Unite FROM Unite Where Genre = 'Unité de recette'"); 
        $stmt->execute();
        $Valeurs = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $Valeurs;
    }

    //---------------------------------- Récupérer toutes les Conditionnements distinctes ---------------------------------//

    public static function getConditionnementsFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Nom_Unite, Chiffre, Valeur FROM Unite WHERE Genre = 'Conditionnement achat'"); 
        $stmt->execute();
        $Conditionnements = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Conditionnements;
    }    


        //---------------------------------- Récupérer toutes les Unites distinctes ---------------------------------//

        public static function getUnitesFromDatabase() {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("SELECT DISTINCT Nom_Unite FROM Unite"); 
            $stmt->execute();
            $Unites = $stmt->fetchAll(PDO::FETCH_COLUMN);
            return $Unites;
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
     * Get the value of Genre
     */ 
    public function getGenre()
    {
        return $this->Genre;
    }

    /**
     * Set the value of Genre
     *
     * @return  self
     */ 
    public function setGenre($Genre)
    {
        $this->Genre = $Genre;

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