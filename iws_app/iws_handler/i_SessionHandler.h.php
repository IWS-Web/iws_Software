<?php

    namespace iws_handler\Session_Handler;

    class Session{    
        public function setSession($key, $value) {
            $_SESSION[$key] = $value;
        }
    
        public function deleteSession($key) {
            if (isset($_SESSION[$key])) {
                unset($_SESSION[$key]);
            }
        }
    
        public function deleteAllSessions() {
            session_unset();
            session_destroy();
        }
    
        public function isSessionSet($key) {
            return isset($_SESSION[$key]);
        }
    }

?>