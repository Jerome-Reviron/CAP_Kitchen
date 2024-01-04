<?php
class Categorie{
    private $Id_Categorie;
    private $Nom_Categorie;
    private $Genre;


        public function __construct($Id_Categorie,$Nom_Categorie, $Genre){

            $this->Id_Categorie = $Id_Categorie;
            $this->Nom_Categorie = $Nom_Categorie;
            $this->Genre = $Genre;
        }

    //----------------------------------------------- Creer -----------------------------------------------

    public function createCategorie($Id_Admin) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Categorie (Nom_Categorie, Genre) 
                                VALUES (:Nom_Categorie, :Genre)');
        $stmt->bindParam(':Nom_Categorie', $this->Nom_Categorie, PDO::PARAM_STR);
        $stmt->bindParam(':Genre', $this->Genre, PDO::PARAM_STR);
        $stmt->execute();
    
        // Récupérer l'ID de la catégorie nouvellement créée
        $Id_Categorie = $bdd->lastInsertId();

        // $Id_Fournisseur est défini dans l'instance actuelle
        $this->Id_Categorie = $Id_Categorie;
    
        // Insérer dans la table Propose
        $stmtPropose = $bdd->prepare('INSERT INTO Propose (Id_Admin, Id_Categorie) 
                                        VALUES (:Id_Admin, :Id_Categorie)');
        $stmtPropose->bindParam(':Id_Admin', $Id_Admin, PDO::PARAM_INT);
        $stmtPropose->bindParam(':Id_Categorie', $Id_Categorie, PDO::PARAM_INT);
        $stmtPropose->execute();
    }
    
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomCategorieExists($Nom_Categorie, $Id_Entreprise) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT C.* 
                                                                FROM Categorie C
                                                                JOIN Propose P ON C.Id_Categorie = P.Id_Categorie
                                                                JOIN Admin A ON P.Id_Admin = A.Id_Admin
                                                                WHERE C.Nom_Categorie = :Nom_Categorie 
                                                                AND A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Nom_Categorie', $Nom_Categorie, PDO::PARAM_STR);
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoCategorie($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Categorie 
                                WHERE Id_Categorie = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Categorie avec les données récupérées
        $Categorie = new Categorie($data['Id_Categorie'], $data['Nom_Categorie'], $data['Genre']);
        return $Categorie;
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllCategorie($IdEntrepriseSession) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT C.* 
                                FROM Categorie C
                                JOIN Propose P ON C.Id_Categorie = P.Id_Categorie
                                JOIN Admin A ON P.Id_Admin = A.Id_Admin
                                WHERE A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Id_Entreprise', $IdEntrepriseSession, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Categories = array();
        foreach ($data as $CategorieData) {
            $Categorie = new Categorie($CategorieData['Id_Categorie'], 
                            $CategorieData['Nom_Categorie'], $CategorieData['Genre']);

            array_push($Categories, $Categorie);
        }
        return $Categories;
    }

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoCategorie($Id, $Nom_Categorie, $Genre) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Categorie 
                                SET Nom_Categorie = :Nom_Categorie, Genre = :Genre 
                                WHERE Id_Categorie = :Id");
            $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom_Categorie', $Nom_Categorie, PDO::PARAM_STR);
        $update->bindParam(':Genre', $Genre, PDO::PARAM_STR);
    
        $update->execute();
    }
    
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

    //---------------------------------- Récupérer toutes les Genres distinctes ---------------------------------//

    public static function getGenresFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Genre FROM Categorie"); 
        $stmt->execute();
        $Genres = $stmt->fetchAll(PDO::FETCH_COLUMN);
        return $Genres;
    }   

    //---------------------------------- Récupérer toutes les Unite_recettes distinctes ---------------------------------//

    public static function getCategoriesFromDatabase() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT DISTINCT Id_Categorie, Nom_Categorie FROM Categorie Where Genre = 'Ingrédient'"); 
        $stmt->execute();
        $Categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Categories;
    }

    //----------------------------------Récupérer les Categories d'un ingredients --------------------------------//

    public static function getCategoriesForIngredient($Id) {
        $bdd = bddconnexion::getInstance()->getBdd(); 
        $stmt = $bdd->prepare("SELECT C.*
                            FROM Categorie C 
                            JOIN Provient P ON C.Id_Categorie = P.Id_Categorie 
                            WHERE P.Id_Ingredient = :Id");
    
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
    
        $stmt->execute();
        $CategoriesData = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        $Categories = [];
        foreach ($CategoriesData as $data) {
            $Categories[] = new Categorie($data['Id_Categorie'], $data['Nom_Categorie'], $data['Genre']);
        }
    
        return $Categories;
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

}
?>