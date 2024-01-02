<?php

    namespace iws_model;

    use iws_handler\SessionHandler;

    class CPLoader_Model{

        public function __construct(){
            $this->setCP();
            $this->seeSession();
        }

        private function setCP(){
            $session = new SessionHandler;

            if(!($session->isSessionSet('cp'))){
                $session->setSession('cp', 'home');
            }
        }

        private function seeSession(){
            echo $_SESSION['cp'];
        }

    }