<?php
// Class references
use vdf\perceive\Model;
use vdf\perceive\Controller;
use vdf\perceive\View;
use vdf\percieve\Database;

// Start a session
session_name('Perceive Database');
session_start();

$_SESSION['username'] = 'Doug';
$_SESSION['userlevel'] = 'Viewer';

// Configuration Files
include_once 'config/vdf.database.config.php';

// Define Constants from configuration files
foreach ($c as $name => $value) {
    define($name, $value);
}

// Autoloaders
include_once 'autoloaders/vdf.autoload.class.php';
include_once 'autoloaders/vdf.autoload.interface.php';
include_once 'autoloaders/vdf.autoload.views.php';

// Start the MCV Implimentation
$model      = new Model();
$controller = new Controller($model);
$view       = new View($controller);
$model->setView($view);

// Pass the post data to the controller
$controller->dataIn($_POST);
