<?php
use Rodez_3IL_Ingenieurs\Core\Application;

//error_reporting(0);
error_reporting(E_ALL);

// Les fichiers à charger pour toutes les pages
require_once '../app/core/Application.php';
require_once '../app/core/Controleur.php';
require_once '../app/libs/BaseDeDonnees.php';
require_once '../app/libs/Photo.php';
require_once '../app/libs/GestionFichier.php';
require_once '../app/libs/Properties.php';
require_once '../app/libs/PHPMailer/src/PHPMailer.php';
require_once '../app/libs/PHPMailer/src/SMTP.php';
require_once '../app/modeles/Modele.php';
require_once '../app/modeles/Utilisateur.php';
require_once '../app/modeles/Avatar.php';
require_once '../app/modeles/Langue.php';

// Définitions des constantes pour l'ensemble des pages.
define('URL_PUBLIC_FOLDER', 'public');
define('URL_PROTOCOL', 'http://');
define('URL_DOMAIN', $_SERVER['HTTP_HOST']);
define('URL_SUB_FOLDER', str_replace(URL_PUBLIC_FOLDER, '', dirname($_SERVER['SCRIPT_NAME'])));
define('URL', URL_PROTOCOL . URL_DOMAIN . URL_SUB_FOLDER);

// Les différents modules du site.
define('CONTROLEURS', '../app/controleurs/');
define('VUES', '../app/vues/');
define('TEMPLATES', '../app/vues/_templates/');
define('MODELES', '../app/modeles/');

define('XML_SLIDER', VUES . 'Accueil/slider.xml');

// Le fichier de configuration.
define('CONFIG', '../app/configs/config.ini');

define('IMAGES', URL . 'img/');
define('PHOTOS', IMAGES . 'photos/');
define('AVATAR', IMAGES . 'avatar/');
define('DRAPEAU', IMAGES . 'drapeau/');

// Les ressources.
define('CSS', URL . 'css/');
define('JS', URL . 'js/');
define('PROPERTIES', URL . 'properties/');

define('DEFAUT_IMAGE', IMAGES . 'XX.png');
define('DEFAUT_AVATAR', AVATAR . 'defaut.png');

define('EXTENSION_DRAPEAU', '.png');
define('EXTENSION_PROPERTIES', '.json');

define('DEFAUT_ID_LANGUE', 'FR');

// Lance le routage
$app = new Application();
