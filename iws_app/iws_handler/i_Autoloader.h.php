<?php

    class Autoloader
    {
        protected $basePath;

        public function __construct($basePath)
        {
            $this->basePath = $basePath;
        }

        public function load()
        {
            spl_autoload_register([$this, 'loadClass']);
            $this->loadControllers();
            $this->loadModels();
        }

        protected function loadClass($className)
        {
            $classFile = $this->basePath . DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
            if (file_exists($classFile)) {
                require_once $classFile;
            }
        }

        protected function loadControllers()
        {
            $controllerPath = $this->basePath . DIRECTORY_SEPARATOR . 'Controller';
            $this->loadClassesFromPath($controllerPath);
        }

        protected function loadModels()
        {
            $modelPath = $this->basePath . DIRECTORY_SEPARATOR . 'Model';
            $this->loadClassesFromPath($modelPath);
        }

        protected function loadClassesFromPath($path)
        {
            if (is_dir($path)) {
                $files = new RecursiveIteratorIterator(
                    new RecursiveDirectoryIterator($path),
                    RecursiveIteratorIterator::SELF_FIRST
                );

                foreach ($files as $file) {
                    if ($file->isFile() && $file->getExtension() === 'php') {
                        $className = str_replace(
                            [$path . DIRECTORY_SEPARATOR, '.php', DIRECTORY_SEPARATOR],
                            ['', '', '\\'],
                            $file->getPathname()
                        );

                        $this->loadClass($className);
                    }
                }
            }
        }
    }

