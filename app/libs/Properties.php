<?php
namespace Rodez_3IL_Ingenieurs\Libs;

use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Classe des fonctions de gestion des fichiers
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class Properties
{

    /** @var string Chemin du fichier de properties */
    public static $PROPERTIES_PATH = '../public/properties/';

    /** @var string Nom du fichier de properties */
    public static $PROPERTIES_NAME = 'XX.json';

    /** @var array Contient toutes les variables d'affichage du site */
    private static $site;

    /**
     * Retourne le nom du fichier des propriétés en fonction de l'utilisteur connecté.
     * DEFAUT_ID_LANGUE . EXTENSION_PROPERTIES par défaut
     */
    private static function getFileName()
    {
        $properties = DEFAUT_ID_LANGUE . EXTENSION_PROPERTIES;
        
        if (Controleur::isMemberConnect()) {
            $langue = $_SESSION['util']->getLangue();
            
            if ($langue != null) {
                $properties = $langue->getNomProperties();
            }
        }
        
        return $properties;
    }

    /**
     * Charge le fichier des propriétés en fonction de l'utilisteur connecté.
     * DEFAUT_ID_LANGUE par défaut
     */
    public static function getFile($idLangue = null)
    {
        if ($idLangue != null) {
            $name = $idLangue . EXTENSION_PROPERTIES;
        } else {
            $name = self::getFileName();
        }
        
        self::$site = json_decode(file_get_contents(PROPERTIES . $name));
        
        return isset(self::$site);
    }

    /**
     * Sauvegarde le fichier des propriétés.
     */
    private static function setFile()
    {
        return file_put_contents(self::$PROPERTIES_PATH . self::getFileName(), json_encode(self::$site, JSON_UNESCAPED_UNICODE));
    }

    /**
     * Sauvegarde le fichier des propriétés.
     */
    public static function get($args)
    {
        $valeur = self::$site->{$args[0]};
        
        if (sizeof($args) > 1) {
            for ($i = 1; $i < sizeof($args); $i ++) {
                $valeur = $valeur->{$args[$i]};
            }
        }
        
        return $valeur;
    }

    /**
     * Sauvegarde le fichier des propriétés.
     */
    public static function set($args, $new)
    {
        $valeur = self::$site->{$args[0]};
        
        if (sizeof($args) > 1) {
            for ($i = 1; $i < sizeof($args) - 1; $i ++) {
                $valeur = $valeur->{$args[$i]};
            }
        } else {
            $i = 0;
        }
        
        $valeur->{$args[$i]} = $new;
        
        return self::setFile();
    }
}