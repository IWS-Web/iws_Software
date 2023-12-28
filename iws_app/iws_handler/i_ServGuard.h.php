<?php

    namespace iws_handler;

    class SecurityGuard {
        private $allowedDomain;
    
        public function __construct($allowedDomain) {
            $this->allowedDomain = $allowedDomain;
        }
    
        public function enforceSecurity() {
            $this->checkDomain();
        }
    
        private function checkDomain() {
            $currentHost = $_SERVER['HTTP_HOST'];
            
            if ($currentHost !== $this->allowedDomain) {
                header("HTTP/1.1 403 Forbidden");
                echo "Access forbidden.";
                exit;
            }

            return true;
        }
    }

    // $securityGuard = new SecurityGuard('deinedomain.com');