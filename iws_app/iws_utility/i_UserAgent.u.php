<?php

    namespace iws_utility\UserAgent;

    class UserAgent {
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
                header("HTTP/1.1 403 Forbidden");
                echo "Forbidden";
                exit;
            }

            foreach ($this->userAgents as $agent) {
                if ($this->isBotUserAgent($userAgent, $agent['instances'])) {
                    header("HTTP/1.1 403 Forbidden");
                    echo "Forbidden";
                    exit;
                }
            }
        }
    }


?>
