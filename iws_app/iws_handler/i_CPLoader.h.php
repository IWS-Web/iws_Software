<?php

    namespace iws_handler\CP_Handler;

    class CPLoader{

        protected $cpName;

        public function handleCP($cpName){

            match($cpName){
                "home"  =>  $this->setHome(),
                'user'  => $this->setCP_Perm('user'),
                'admin' => $this->setCP_Perm('admin'),  
            };
            
        }

        private function setHome(){

        }

        private function setCP_Perm($cpPanel){
            
        }
    }

?>