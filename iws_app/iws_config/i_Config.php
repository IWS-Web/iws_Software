<?php

    use iws_utility\SecurityGuard;

    class Config{
        
        public function __construct(){
            $this->forceHttps();

            if(new SecurityGuard("localhost") == true){
                $this->setDefines();
            }

            $this->setErrorHandler();
        }

        private function setDefines(){
            define('WebVer',        '1.0.0000');
            define('VerName',       'iws_V');

            define('UserAgent',     'true'); // Aktiviert die Funktion, nur bestimmte Webcrawler auf die Websoftware zugriff zu gewähren
            define('UserAgentJSON', 'iws_app/iws_utility/i_UserAgent.json'); // Pfad zur JSON
        }

        private function forceHttps() {
            // Überprüfen, ob die HTTPS-Variable im $_SERVER-Array existiert und ob sie 'on' ist
            if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'on') {
    
                // Überprüfen, ob es sich um den Localhost handelt
                $isLocalhost = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
    
                // Weiterleitung auf HTTPS, es sei denn, es handelt sich um den Localhost
                if (!$isLocalhost) {
                    $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                    header("Location: $url", true, 301);
                    exit();
                }
            }
        }
    
        private function setErrorHandler() {
            // Überprüfen, ob es sich um den Localhost handelt
            $isLocalhost = in_array($_SERVER['REMOTE_ADDR'], array('127.0.0.1', '::1'));
    
            // Fehlerausgabe nur für den Localhost aktivieren
            if (!$isLocalhost) {
                error_reporting(0); // Alle Fehler ignorieren
                ini_set('display_errors', 'Off');
            } else {
                error_reporting(E_ALL); // Alle Fehler anzeigen
                ini_set('display_errors', 'On');
            }
        }

    }

?>