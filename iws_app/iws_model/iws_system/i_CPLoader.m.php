<?php

    namespace iws_model\iws_system\CPLoader;

    use iws_handler\Session_Handler\Session;

    class CPLoader{

        public function __construct(){
            $this->setCP();
            $this->seeSession();
        }

        private function setCP(){
            $session = new Session;

            if(!($session->isSessionSet('cp'))){
                $session->setSession('cp', 'home');
            }
        }

        private function seeSession(){
            echo $_SESSION['cp'];
        }

    }