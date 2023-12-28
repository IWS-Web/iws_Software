<?php

    include(__DIR__."/iws_app/iws_config/i_Config.php");
    include(__DIR__."/iws_app/iws_handler/i_Autoloader.h.php");

    $loader = new Autoloader(__DIR__."/iws_app");
    $loader->load();

    $config = new Config;

    $app    = new App;




?>