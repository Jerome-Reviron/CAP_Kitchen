<?php

    class bddconnexion {
        private static $instance = null;
        private $connexion;
        private $bdd;
        private function __construct() {

            try{
                $this->bdd = new PDO("mysql:host=localhost;dbname=CAP_Kitchen;charset=utf8", "root", "Nakarin63670,");
            }
            catch(PDOException $e){
                die('Erreur : '.$e->getMessage());
            }
        }
    
        public static function getInstance() {
            if (self::$instance === null) {
                self::$instance = new bddconnexion();
            }
            return self::$instance;
        }
    
        public function getconnexion() {
            return $this->connexion;
        }

        /**
        * Get the value of bdd
        */ 
        public function getBdd()
        {
                return $this->bdd;
        }
    }
?> 