<?php

    include(__DIR__."/iws_app/iws_config/i_Config.php");

    include(__DIR__."/iws_app/iws_vendor/i_Autoloader.php");

    $loader = new Autoloader(__DIR__."/iws_app");
    $loader->load();

    $config = new Config;

    $app    = new App;

?>