<?php

class Securiter {

    public function generateCsrfToken() {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['csrf_token'];
    }

    public function verifyCsrfToken($token) {
        if (!hash_equals($_SESSION['csrf_token'], $token)) {
            die(include "./Controleurs/notfound_Controleurs.php");
        }
    }

}