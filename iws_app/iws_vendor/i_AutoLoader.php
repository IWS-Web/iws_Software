<?php
    class Autoloader{
        protected $basePath;

        public function __construct($basePath){
            $this->basePath = $basePath;
        }

        public function load(){
            spl_autoload_register([$this, 'loadClass']);
            $this->loadControllers();
            $this->loadModels();
            $this->loadHandlers();
            $this->loadUtility();
        }

        protected function loadClass($classFile){
            if(file_exists($classFile)) {
                require_once $classFile;
            }else{
                header("HTTP/1.1 404 Not Found");
                echo "File not Found";
                exit;
            }
        }

        protected function loadControllers(){
            $controllerPath = $this->basePath . DIRECTORY_SEPARATOR . 'iws_controller/';
            $this->loadClassesFromPath($controllerPath, '.c.php');
        }

        protected function loadModels(){
            $modelPath = $this->basePath . DIRECTORY_SEPARATOR . 'iws_model/';
            $this->loadClassesFromPath($modelPath, '.m.php');
        }

        protected function loadHandlers(){
            $handlerPath = $this->basePath . DIRECTORY_SEPARATOR . 'iws_handler/';
            $this->loadClassesFromPath($handlerPath, '.h.php');
        }

        protected function loadUtility(){
            $handlerPath = $this->basePath . DIRECTORY_SEPARATOR . 'iws_utility/';
            $this->loadClassesFromPath($handlerPath, '.u.php');
        }

        protected function loadClassesFromPath($path, $fileExtension){
            if (is_dir($path)) {
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($path),
                    RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($files as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        $className = str_replace(
                            [$path . DIRECTORY_SEPARATOR, $fileExtension, DIRECTORY_SEPARATOR],
                            ['', '', '\\'],
                            $file->getPathname()
                        );

                        $this->loadClass($className.$fileExtension);
                    }
                }
            }
        }

        protected function convertClassNameToFileName($className){
            $classNameParts = explode('\\', $className);
            $fileName = end($classNameParts);
            return $fileName . '.php';
        }
    }