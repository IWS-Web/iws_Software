<?php

    namespace iws_handler;

    class SessionHandler {    
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
    
        // Prüfen, ob eine Session vorhanden ist
        public function isSessionSet($key) {
            return isset($_SESSION[$key]);
        }
    }

?>