<?php

    namespace iws_controller;

    use iws_handler\SessionHandler;

    class Viewer{

        public function __construct(){
            $this->getCP();
        }

        private function getCP(){
            $sess = new SessionHandler;
        }

    }

?>