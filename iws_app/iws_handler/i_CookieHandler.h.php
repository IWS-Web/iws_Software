<?php

    namespace iws_handler;

    class CookieHandler {
        private $encryptionKey;
    
        public function __construct($encryptionKey) {
            $this->encryptionKey = $encryptionKey;
        }
    
        public function setCookie($name, $value, $days = 365) {
            $expiration = time() + ($days * 24 * 60 * 60);
            $encryptedValue = $this->encrypt($value);
            setcookie($name, $encryptedValue, $expiration, '/');
        }
    
        public function setCustomExpirationCookie($name, $value, $days) {
            $expiration = time() + ($days * 24 * 60 * 60);
            $encryptedValue = $this->encrypt($value);
            setcookie($name, $encryptedValue, $expiration, '/');
        }
    
        public function encrypt($value) {
            // Hier wird password_hash für die Verschlüsselung verwendet.
            return password_hash($value, PASSWORD_DEFAULT, ['cost' => 12]);
        }
    
        public function verifyEncryptedCookie($name, $expectedValue) {
            $encryptedValue = $_COOKIE[$name] ?? null;
            if ($encryptedValue === null) {
                return false;
            }
    
            // Hier wird password_verify für die Überprüfung verwendet.
            return password_verify($expectedValue, $encryptedValue);
        }
    
        public function getAllCookies() {
            $cookies = [];
            foreach ($_COOKIE as $name => $value) {
                $cookies[$name] = [
                    'value' => $value,
                    'expiration' => date('Y-m-d H:i:s', $_COOKIE[$name]),
                ];
            }
            return $cookies;
        }
    
        public function deleteCookie($name) {
            if (isset($_COOKIE[$name])) {
                setcookie($name, '', time() - 3600, '/');
                unset($_COOKIE[$name]);
            }
        }
    
        public function deleteAllCookies() {
            foreach ($_COOKIE as $name => $value) {
                setcookie($name, '', time() - 3600, '/');
                unset($_COOKIE[$name]);
            }
        }
    }