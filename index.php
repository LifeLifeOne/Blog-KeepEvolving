<?php 
use App\core\{Autoloader, Routeur};
session_start();

require_once 'core/Autoloader.php';
Autoloader::register();
Routeur::routeur();

