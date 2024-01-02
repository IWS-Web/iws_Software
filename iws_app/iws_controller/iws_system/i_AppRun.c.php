<?php

    use iws_controller\Viewer;
    use iws_model\CPLoader_Model;
    use iws_utility\UserAgent;

    class App{

        public function __construct(){
            session_start();
            
            $this->loadInstance();
        }

        private function loadInstance(){
            if(UserAgent == 'true'){
                
                $userAgent  = new UserAgent(UserAgentJSON);
                $uAgent     = $_SERVER['HTTP_USER_AGENT'];
                $uURL       = $_GET['q'] ?? '';

                $userAgent->checkUserAgent($uAgent, $uURL);
            }

            $db         = new Database(dbHost, dbUser, dbPass, dbDB);
            $cpLoader   = new CPLoader_Model;
            $viewer     = new Viewer;



        }

    }