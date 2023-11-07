<?php
class Ingredient{
    private $Id_Ingredient;
    private $Nom;
    private $Quantite;
    private $Prix_unite_ht;
    private $Prix_total_ht;

    public function __construct($Nom, $Quantite, $Prix_unite_ht, $Prix_total_ht, $Id_Ingredient = null){

        $this->Nom = $Nom;
        $this->Quantite = $Quantite;
        $this->Prix_unite_ht = $Prix_unite_ht;
        $this->Prix_total_ht = $Prix_total_ht;
        $this->Id_Ingredient = $Id_Ingredient;
    }

    
    //----------------------------------------------- Creer -----------------------------------------------

    public function createIngredient() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare('INSERT INTO Ingredient (Nom, Quantite, Prix_unite_ht, Prix_total_ht) VALUES (:Nom, :Quantite, :Prix_unite_ht, :Prix_total_ht)');
        $stmt->bindParam(':Nom', $this->Nom, PDO::PARAM_STR);
        $stmt->bindParam(':Quantite', $this->Quantite, PDO::PARAM_INT);
        $stmt->bindParam(':Prix_unite_ht', $this->Prix_unite_ht, PDO::PARAM_INT);
        $stmt->bindParam(':Prix_total_ht', $this->Prix_total_ht, PDO::PARAM_INT);
        $stmt->execute();
    }
    //----------------------------------------------- Vérifier -----------------------------------------------

    public static function checkNomIngredientExists($Nom) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Ingredient WHERE Nom = :Nom");
        $stmt->bindParam(':Nom', $Nom, PDO::PARAM_STR);
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
        $Ingredient = new Ingredient($data['Id_Ingredient'], $data['Nom'], $data['Quantite'], $data['Prix_unite_ht'], $data['Prix_total_ht']);
        return $Ingredient;
    }
    
    

    //----------------------------------------------- Modifier -----------------------------------------------
    
    public function postInfoIngredient($Id, $Nom, $Quantite, $Prix_unite_ht,$Prix_total_ht) {
        $bdd = bddconnexion::getInstance()->getBdd();
        $update = $bdd->prepare("UPDATE Ingredient SET Nom = :Nom, Quantite = :Quantite, Prix_unite_ht = :Prix_unite_ht, Prix_total_ht = :Prix_total_ht  WHERE Id_Ingredient = :Id");
    
        // Utilisation de bindParam pour lier les valeurs des variables aux paramètres de la requête préparée
        $update->bindParam(':Id', $Id, PDO::PARAM_INT);
        $update->bindParam(':Nom', $Nom, PDO::PARAM_STR);
        $update->bindParam(':Quantite', $Quantite, PDO::PARAM_INT);
        $update->bindParam(':Prix_unite_ht', $Prix_unite_ht, PDO::PARAM_INT);
        $update->bindParam(':Prix_total_ht', $Prix_total_ht, PDO::PARAM_INT);

        $update->execute();
    }

    //----------------------------------------------- Object -----------------------------------------------

    public static function getAllIngredient() {
        $bdd = bddconnexion::getInstance()->getBdd();
        $stmt = $bdd->prepare("SELECT * FROM Ingredient");
        $stmt->execute();
        $data = $stmt->fetchAll();
        $Ingredient = array();
        foreach ($data as $IngredientData) {
            $Ingredient = new Ingredient($IngredientData['Id_Ingredient'], $IngredientData['Nom'], $IngredientData['Quantite'], $IngredientData['Prix_unite_ht'], $IngredientData['Prix_total_ht']);
            array_push($Ingredients, $Ingredient);
        }
        return $Ingredients;
    }
    //$bdd
    //----------------------------------------------- Supprimer -----------------------------------------------
    public function deleteIngredientById() {
        try {
            $bdd = bddconnexion::getInstance()->getBdd();
            $stmt = $bdd->prepare("DELETE FROM Ingredient WHERE Id_Ingredient = :Id");
            $stmt->bindParam(':Id', $this->Id_Ingredient, PDO::PARAM_INT);
    
            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
            // Vous pouvez écrire l'erreur dans un fichier journal ou afficher un message d'erreur.
            error_log("Erreur lors de la suppression de l'Ingredient : " . $e->getMessage());
            return false;
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
     * Get the value of Quantite
     */ 
    public function getQuantite()
    {
        return $this->Quantite;
    }

    /**
     * Set the value of Quantite
     *
     * @return  self
     */ 
    public function setQuantite($Quantite)
    {
        $this->Quantite = $Quantite;

        return $this;
    }

        /**
     * Get the value of Prix_unite_ht
     */ 
    public function getPrix_unite_ht()
    {
        return $this->Prix_unite_ht;
    }

    /**
     * Set the value of Prix_unite_ht
     *
     * @return  self
     */ 
    public function setPrix_unite_ht($Prix_unite_ht)
    {
        $this->Prix_unite_ht = $Prix_unite_ht;

        return $this;
    }

            /**
     * Get the value of Prix_total_ht
     */ 
    public function getPrix_total_ht()
    {
        return $this->Prix_total_ht;
    }

    /**
     * Set the value of Prix_total_ht
     *
     * @return  self
     */ 
    public function setPrix_total_ht($Prix_total_ht)
    {
        $this->Prix_total_ht = $Prix_total_ht;

        return $this;
    }

}
?>

