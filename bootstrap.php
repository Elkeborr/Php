<?php

//session starten voor overal te gebruiken
   session_start();
    spl_autoload_register(function ($class) {
        require_once __DIR__.DIRECTORY_SEPARATOR.
        'classes'.DIRECTORY_SEPARATOR.$class.'.php';
    });
