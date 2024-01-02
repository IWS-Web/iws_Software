<?php

    namespace iws_utility\TPL;

    class TplEngine {
        private $data = [];

        public function assign($data) {
            if (is_array($data)) {
                // Wenn ein assoziatives Array übergeben wird
                $this->data = array_merge($this->data, $data);
            } else {
                // Fehler oder unerwarteter Datentyp
                trigger_error('Invalid argument type for assign method. Expecting an array.', E_USER_ERROR);
            }
        }

        public function loop($loopName, $loopData) {
            $this->data[$loopName] = $loopData;
        }

        public function if($conditionName, $conditionValue) {
            $this->data[$conditionName] = $conditionValue;
        }

        public function render($tpl) {
            $output = $tpl;

            // Ersetze Variablen
            foreach ($this->data as $key => $value) {
                $output = str_replace("{{{$key}}}", $value, $output);
            }

            // Verarbeite Schleifen
            $output = $this->processLoops($output);

            // Verarbeite Bedingungen
            $output = $this->processConditions($output);

            echo $output;
        }

        private function processLoops($tpl) {
            // Beispiel: {{loop $items as $item}}
            $pattern = '/{{loop (.*?)}}(.*?){{\/loop (.*?)}}/s';
            preg_match_all($pattern, $tpl, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $loopName = $match[1];
                $loopData = $this->data[$loopName];
                $loopContent = '';

                foreach ($loopData as $item) {
                    $innerContent = $match[2];
                    foreach ($item as $key => $value) {
                        $innerContent = str_replace("{{{$loopName} {$key}}}", $value, $innerContent);
                    }
                    $loopContent .= $innerContent;
                }

                $tpl = str_replace($match[0], $loopContent, $tpl);
            }

            return $tpl;
        }

        private function processConditions($tpl) {
            // Beispiel: {{if userLoggedIn}} ... {{/if userLoggedIn}}
            $pattern = '/{{if (.*?)}}(.*?){{\/if (.*?)}}/s';
            preg_match_all($pattern, $tpl, $matches, PREG_SET_ORDER);

            foreach ($matches as $match) {
                $conditionName = $match[1];
                $conditionValue = $this->data[$conditionName];
                $content = $conditionValue ? $match[2] : '';
                $tpl = str_replace($match[0], $content, $tpl);
            }

            return $tpl;
        }
    }

    ?>
