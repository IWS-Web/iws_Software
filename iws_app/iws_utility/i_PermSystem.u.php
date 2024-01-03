<?php
    class PermissionSystem {
        private $permissions = [];

        public function __construct($jsonFilePath) {
            $jsonContent = file_get_contents($jsonFilePath);
            $this->permissions = json_decode($jsonContent, true);
        }

        public function hasPermission($group, $permission) {
            if (isset($this->permissions['permissions'][$permission][$group])) {
                return $this->permissions['permissions'][$permission][$group] == 1;
            }
            return false;
        }
    }