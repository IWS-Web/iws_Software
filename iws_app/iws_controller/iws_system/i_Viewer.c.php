<?php

    namespace iws_controller\iws_system\Viewer_Controller;

    use iws_handler\Session_Handler\Session;

    class Viewer{

        public function __construct(){
            $this->getCP();
        }

        private function getCP(){
            $sess = new Session;
        }

    }

?>