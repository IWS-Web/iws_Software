<?php

    use iws_controller\iws_system\Viewer_Controller\Viewer;
    use iws_model\iws_system\CPLoader\CPLoader;
    use iws_utility\UserAgent\UserAgent;

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
            $cpLoader   = new CPLoader;
            $viewer     = new Viewer;



        }

    }