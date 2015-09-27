<?php
// Autoloader for Views

spl_autoload_register(function ($class){

    // Strip the namespace from the class name
    if (preg_match('@\\\\([\w]+)$@', $class, $matches)) {
    $class = $matches[1];
    }

    // Generate the filename to include
    $filename = 'classes/view.vdf.' . strtolower($class) . '.php';

    // Ensure that the file is only included once
    if (file_exists($filename)) {
        include_once $filename;
    }
});
