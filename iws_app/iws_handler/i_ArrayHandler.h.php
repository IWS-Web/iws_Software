<?php

    namespace iws_handler\Array_Handler;

    class Arrays {
        
        public static function shuffleArray($array) {
            shuffle($array);
            return $array;
        }
        
        public static function sortArray($array, $ascending = true) {
            if ($ascending) {
                sort($array);
            } else {
                rsort($array);
            }
            return $array;
        }
        
        public static function toJson($array) {
            return json_encode($array);
        }
        
        public static function fromJson($json) {
            return json_decode($json, true);
        }
        
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