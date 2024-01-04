<?php

class Ingredient{
    private $Id_Ingredient;
    private $Nom_Ingredient;
    private $Photo;
    private $Unite_recette;
    private $Conditionnement_achat;
    private $Prix_achat;
    private $Unite_achat;

    public function __construct($Id_Ingredient, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat){

        $this->Id_Ingredient = $Id_Ingredient;
        $this->Nom_Ingredient = $Nom_Ingredient;
        $this->Photo = $Photo;
        $this->Unite_recette = $Unite_recette;
        $this->Conditionnement_achat = $Conditionnement_achat;
        $this->Prix_achat = $Prix_achat;
        $this->Unite_achat = $Unite_achat;
    }

    //----------------------------------------------- Creer -----------------------------------------------

    public function createIngredient($Id_Admin, $AllergeneIds, $Id_Categorie, $FournisseurIds) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Ingredient (Nom_Ingredient, Photo, Unite_recette, Conditionnement_achat, Prix_achat, Unite_achat) 
                                VALUES (:Nom_Ingredient, :Photo, :Unite_recette, :Conditionnement_achat, :Prix_achat, :Unite_achat)');
        $stmt->bindParam(':Nom_Ingredient', $this->Nom_Ingredient, PDO::PARAM_STR);
        $stmt->bindParam(':Photo', $this->Photo, PDO::PARAM_LOB);
        $stmt->bindParam(':Unite_recette', $this->Unite_recette, PDO::PARAM_STR);
        $stmt->bindParam(':Conditionnement_achat', $this->Conditionnement_achat, PDO::PARAM_STR);
        $stmt->bindParam(':Prix_achat', $this->Prix_achat, PDO::PARAM_STR);
        $stmt->bindParam(':Unite_achat', $this->Unite_achat, PDO::PARAM_STR);
        $stmt->execute();

        // Récupérer l'ID de la catégorie nouvellement créée
        $Id_Ingredient = $bdd->lastInsertId();

        // $Id_Ingredient est défini dans l'instance actuelle
        $this->Id_Ingredient = $Id_Ingredient;

        // Insertion dans la table Produit
        $stmtProduit = $bdd->prepare('INSERT INTO Produit (Id_Admin, Id_Ingredient) VALUES (:Id_Admin, :Id_Ingredient)');
        $stmtProduit->bindParam(':Id_Admin', $Id_Admin, PDO::PARAM_INT); 
        $stmtProduit->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
        $stmtProduit->execute();
        
        // Insertion dans la table Contient pour chaque allergène
        $stmtContient = $bdd->prepare('INSERT INTO Contient (Id_Allergene, Id_Ingredient) VALUES (:Id_Allergene, :Id_Ingredient)');
            foreach ($AllergeneIds as $Id_Allergene) {
                $stmtContient->bindParam(':Id_Allergene', $Id_Allergene, PDO::PARAM_INT); 
                $stmtContient->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
                $stmtContient->execute();
            }

        // Insertion dans la table Provient
        $stmtProvient = $bdd->prepare('INSERT INTO Provient (Id_Categorie, Id_Ingredient) VALUES (:Id_Categorie, :Id_Ingredient)');
        $stmtProvient->bindParam(':Id_Categorie', $Id_Categorie, PDO::PARAM_INT); 
        $stmtProvient->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
        $stmtProvient->execute();

        // Insertion dans la table Livre pour chaque fournisseur
        $stmtLivre = $bdd->prepare('INSERT INTO Livre (Id_Fournisseur, Id_Ingredient) VALUES (:Id_Fournisseur, :Id_Ingredient)');
            foreach ($FournisseurIds as $Id_Fournisseur) {
                $stmtLivre->bindParam(':Id_Fournisseur', $Id_Fournisseur, PDO::PARAM_INT); 
                $stmtLivre->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
                $stmtLivre->execute();
            }
    }

     //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomIngredientExists($Nom_Ingredient, $Id_Entreprise) {
        $stmt = bddconnexion::getInstance()->getBdd()->prepare("SELECT I.* 
                                                                FROM Ingredient I 
                                                                JOIN Produit P ON I.Id_Ingredient = P.Id_Ingredient
                                                                JOIN Admin A ON P.Id_Admin = A.Id_Admin
                                                                WHERE I.Nom_Ingredient = :Nom_Ingredient
                                                                AND A.Id_Entreprise = :Id_Entreprise");
        $stmt->bindParam(':Nom_Ingredient', $Nom_Ingredient, PDO::PARAM_STR);
        $stmt->bindParam(':Id_Entreprise', $Id_Entreprise, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetchAll();
        $row = $stmt->rowCount();
        return $data;
    }

    //----------------------------------------------- Selectionner -----------------------------------------------
    
    public static function getInfoIngredient($Id) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Ingredient WHERE Id_Ingredient = :Id");
    
        // Utilisation de bindParam pour lier la valeur de la variable $Id au paramètre :Id
        $stmt->bindParam(':Id', $Id, PDO::PARAM_INT);
        
        $stmt->execute();
        $data = $stmt->fetch();
    
        // Instancier un objet Ingredient avec les données récupérées
        $Ingredient = new Ingredient($data['Id_Ingredient'], $data['Nom_Ingredient'], $data['Photo'], 
                                    $data['Unite_recette'], $data['Conditionnement_achat'], $data['Prix_achat'], $data['Unite_achat']);
        return $Ingredient;
    }
    
    

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoIngredient($Id, $Nom_Ingredient, $Photo, $Unite_recette, $Conditionnement_achat, $Prix_achat, $Unite_achat,
                                    $AllergeneIds, $Id_Categorie, $FournisseurIds) {
        $bdd = bddconnexion::getInstance()->getBdd();
        
        // Mise à jour de l'ingrédient
        $update = $bdd->prepare("UPDATE Ingredient SET Nom_Ingredient = :Nom_Ingredient, Photo = :Photo, Unite_recette = :Unite_recette,
                                Conditionnement_achat = :Conditionnement_achat, Prix_achat = :Prix_achat, Unite_achat = :Unite_achat
                                WHERE Id_Ingredient = :Id");
    
        $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom_Ingredient', $Nom_Ingredient, PDO::PARAM_STR);
        $update->bindParam(':Photo', $Photo, PDO::PARAM_LOB);
        $update->bindParam(':Unite_recette', $Unite_recette, PDO::PARAM_STR);
        $update->bindParam(':Conditionnement_achat', $Conditionnement_achat, PDO::PARAM_STR);
        $update->bindParam(':Prix_achat', $Prix_achat, PDO::PARAM_STR);
        $update->bindParam(':Unite_achat', $Unite_achat, PDO::PARAM_STR);
        
        $update->execute();
    
        // Mise à jour des allergènes
        // Supprimer les anciens allergènes
        $deleteAllergenes = $bdd->prepare("DELETE FROM Contient WHERE Id_Ingredient = :Id");
        $deleteAllergenes->bindParam(':Id', $Id, PDO::PARAM_INT);
        $deleteAllergenes->execute();
    
        // Ajouter les nouveaux allergènes
        $addAllergenes = $bdd->prepare("INSERT INTO Contient (Id_Allergene, Id_Ingredient) VALUES (:Id_Allergene, :Id_Ingredient)");
        foreach ($AllergeneIds as $Id_Allergene) {
            $addAllergenes->bindParam(':Id_Allergene', $Id_Allergene, PDO::PARAM_INT); 
            $addAllergenes->bindParam(':Id_Ingredient', $Id, PDO::PARAM_INT);
            $addAllergenes->execute();
        }
    
        // Mise à jour de la catégorie
        // Supprimer l'ancienne catégorie
        $deleteCategorie = $bdd->prepare("DELETE FROM Provient WHERE Id_Ingredient = :Id");
        $deleteCategorie->bindParam(':Id', $Id, PDO::PARAM_INT);
        $deleteCategorie->execute();
    
        // Ajouter la nouvelle catégorie
        $addCategorie = $bdd->prepare("INSERT INTO Provient (Id_Categorie, Id_Ingredient) VALUES (:Id_Categorie, :Id_Ingredient)");
        $addCategorie->bindParam(':Id_Categorie', $Id_Categorie, PDO::PARAM_INT); 
        $addCategorie->bindParam(':Id_Ingredient', $Id, PDO::PARAM_INT);
        $addCategorie->execute();
    
        // Mise à jour des fournisseurs
        // Supprimer les anciens fournisseurs
        $deleteFournisseurs = $bdd->prepare("DELETE FROM Livre WHERE Id_Ingredient = :Id");
        $deleteFournisseurs->bindParam(':Id', $Id, PDO::PARAM_INT);
        $deleteFournisseurs->execute();
    
        // Ajouter les nouveaux fournisseurs
        $addFournisseurs = $bdd->prepare("INSERT INTO Livre (Id_Fournisseur, Id_Ingredient) VALUES (:Id_Fournisseur, :Id_Ingredient)");
        foreach ($FournisseurIds as $Id_Fournisseur) {
            $addFournisseurs->bindParam(':Id_Fournisseur', $Id_Fournisseur, PDO::PARAM_INT); 
            $addFournisseurs->bindParam(':Id_Ingredient', $Id, PDO::PARAM_INT);
            $addFournisseurs->execute();
        }
    }
    

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllIngredient() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Ingredient");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Ingredients = array();
        foreach ($data as $IngredientData) {
            $Ingredient = new Ingredient($IngredientData['Id_Ingredient'], $IngredientData['Nom_Ingredient'], 
                                        $IngredientData['Photo'], $IngredientData['Unite_recette'], $IngredientData['Conditionnement_achat'], 
                                        $IngredientData['Prix_achat'], $IngredientData['Unite_achat']);
            array_push($Ingredients, $Ingredient);
        }
        return $Ingredients;
    }

    //----------------------------------------------- Supprimer -----------------------------------------------
    public static function deleteIngredient($Id_Ingredient) {
        $bdd = bddconnexion::getInstance()->getBdd();
    
        // Débuter une transaction
        $bdd->beginTransaction();
    
        try {
            // Supprimer les entrées associées dans les tables associatives
            $tables = ['Contient', 'Provient', 'Livre', 'Produit'];
            foreach ($tables as $table) {
                $stmt = $bdd->prepare("DELETE FROM $table WHERE Id_Ingredient = :Id_Ingredient");
                $stmt->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
                $stmt->execute();
            }
    
            // Supprimer l'ingrédient de la table Ingredient
            $stmt = $bdd->prepare("DELETE FROM Ingredient WHERE Id_Ingredient = :Id_Ingredient");
            $stmt->bindParam(':Id_Ingredient', $Id_Ingredient, PDO::PARAM_INT);
            $stmt->execute();
    
            // Valider la transaction
            $bdd->commit();
            return ['success' => true];
        } catch (Exception $e) {
            $bdd->rollBack();
            return ['success' => false, 'message' => 'Erreur lors de la suppression: ' . $e->getMessage()];
        }
    }
    
    

    /**
     * Get the value of Id_Ingredient
     */ 
    public function getId_Ingredient()
    {
        return $this->Id_Ingredient;
    }

    /**
     * Set the value of Id_Ingredient
     *
     * @return  self
     */ 
    public function setId_Ingredient($Id_Ingredient)
    {
        $this->Id_Ingredient = $Id_Ingredient;

        return $this;
    }

    /**
     * Get the value of Nom_Ingredient
     */ 
    public function getNom_Ingredient()
    {
        return $this->Nom_Ingredient;
    }

    /**
     * Set the value of Nom_Ingredient
     *
     * @return  self
     */ 
    public function setNom_Ingredient($Nom_Ingredient)
    {
        $this->Nom_Ingredient = $Nom_Ingredient;

        return $this;
    }

        /**
     * Get the value of Photo
     */ 
    public function getPhoto()
    {
        return $this->Photo;
    }

    /**
     * Set the value of Photo
     *
     * @return  self
     */ 
    public function setPhoto($Photo)
    {
        $this->Photo = $Photo;

        return $this;
    }

    /**
     * Get the value of Unite_recette
     */ 
    public function getUnite_recette()
    {
        return $this->Unite_recette;
    }

    /**
     * Set the value of Unite_recette
     *
     * @return  self
     */ 
    public function setUnite_recette($Unite_recette)
    {
        $this->Unite_recette = $Unite_recette;

        return $this;
    }

    /**
     * Get the value of Conditionnement_achat
     */ 
    public function getConditionnement_achat()
    {
        return $this->Conditionnement_achat;
    }

    /**
     * Set the value of Conditionnement_achat
     *
     * @return  self
     */ 
    public function setConditionnement_achat($Conditionnement_achat)
    {
        $this->Conditionnement_achat = $Conditionnement_achat;

        return $this;
    }

    /**
     * Get the value of Prix_achat
     */ 
    public function getPrix_achat()
    {
        return $this->Prix_achat;
    }

    /**
     * Set the value of Prix_achat
     *
     * @return  self
     */ 
    public function setPrix_achat($Prix_achat)
    {
        $this->Prix_achat = $Prix_achat;

        return $this;
    }

    /**
     * Get the value of Unite_achat
     */ 
    public function getUnite_achat()
    {
        return $this->Unite_achat;
    }

    /**
     * Set the value of Unite_achat
     *
     * @return  self
     */ 
    public function setUnite_achat($Unite_achat)
    {
        $this->Unite_achat = $Unite_achat;

        return $this;
    }
    
}

?>