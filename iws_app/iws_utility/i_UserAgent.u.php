<?php

class UserAgentChecker {
    private $userAgents;

    public function __construct($jsonUrl) {
        $this->userAgents = $this->loadUserAgents($jsonUrl);
    }

    private function loadUserAgents($jsonUrl) {
        $json = file_get_contents($jsonUrl);
        return json_decode($json, true);
    }

    private function isBotUserAgent($userAgent, $instances) {
        foreach ($instances as $instance) {
            if (stripos($userAgent, $instance) !== false) {
                return true;
            }
        }
        return false;
    }

    public function checkUserAgent($userAgent, $urlParameter) {
        if (!empty($urlParameter)) {
            // Wenn ein URL-Parameter vorhanden ist, Header mit Fehlercode und Fehlermeldung senden
            header("HTTP/1.1 403 Forbidden");
            echo "Bots sind gesperrt.";
            exit;
        }

        foreach ($this->userAgents as $agent) {
            if ($this->isBotUserAgent($userAgent, $agent['instances'])) {
                // Webcrawler gefunden, Header mit Fehlercode und Fehlermeldung senden
                header("HTTP/1.1 403 Forbidden");
                echo "Webcrawler sind gesperrt.";
                exit;
            }

            // Hier können Sie weitere Überprüfungen für Muster und Instanzen implementieren
        }

        // Hier können Sie den normalen Ablauf fortsetzen, da kein Bot erkannt wurde
        echo "Normales Verhalten.";
    }
}


?>
