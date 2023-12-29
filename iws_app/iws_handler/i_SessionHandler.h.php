<?php

    namespace iws_handler;

    class SessionHandler {

        // Konstruktor
        public function __construct() {
            session_start();
        }
    
        // Session setzen
        public function setSession($key, $value) {
            $_SESSION[$key] = $value;
        }
    
        // Einzelne Session löschen
        public function deleteSession($key) {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    
        // Alle Sessions löschen
        public function deleteAllSessions() {
            session_unset();
            session_destroy();
        }
    }

?>