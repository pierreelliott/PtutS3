<?php

const DEFAULT_APP = 'Frontend';

// Si l'application n'est pas valide, on va charger l'application par défaut qui se chargera de générer une erreur 404
if (!isset($_GET['app']) || !file_exists(__DIR__.'/../App/'.$_GET['app'])) $_GET['app'] = DEFAULT_APP;

// On commence par inclure la classe nous permettant d'enregistrer nos autoload
require(__DIR__.'/../Lib/LibPtut/SplClassLoader.php');

// On va ensuite enregistrer les autoloads correspondant à chaque vendor (OCFram, App, Model, etc.)
$LibPtutLoader = new SplClassLoader('LibPtut', __DIR__.'/../Lib');
$LibPtutLoader->register();

$appLoader = new SplClassLoader('App', __DIR__.'/..');
$appLoader->register();

$modelLoader = new SplClassLoader('Models', __DIR__.'/../Lib/Vendors');
$modelLoader->register();

$entityLoader = new SplClassLoader('Entities', __DIR__.'/../Lib/Vendors');
$entityLoader->register();

// Il ne nous suffit plus qu'à déduire le nom de la classe et à l'instancier
$appClass = 'App\\'.$_GET['app'].'\\'.$_GET['app'].'Application';

$app = new $appClass;
$app->run();
