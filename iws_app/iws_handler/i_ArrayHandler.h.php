<?php

    namespace iws_handler;

    class CustomArrayHandler {
        
        // Funktion zum Mischen eines Arrays
        public static function shuffleArray($array) {
            shuffle($array);
            return $array;
        }
        
        // Funktion zum Sortieren eines Arrays
        public static function sortArray($array, $ascending = true) {
            if ($ascending) {
                sort($array);
            } else {
                rsort($array);
            }
            return $array;
        }
        
        // Funktion zum Konvertieren eines Arrays in JSON
        public static function toJson($array) {
            return json_encode($array);
        }
        
        // Funktion zum Konvertieren von JSON in ein Array
        public static function fromJson($json) {
            return json_decode($json, true);
        }
        
        // Funktion zum Auseinanderlegen eines gemischten Arrays
        public static function splitMixedArray($mixedArray) {
            $evenIndex = array();
            $oddIndex = array();
            
            foreach ($mixedArray as $index => $value) {
                if ($index % 2 == 0) {
                    $evenIndex[] = $value;
                } else {
                    $oddIndex[] = $value;
                }
            }
            
            return array('even' => $evenIndex, 'odd' => $oddIndex);
        }
    }