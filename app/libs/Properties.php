<?php

namespace Rodez_3IL_Ingenieurs\Libs;

/**
 * Classe des fonctions de gestion des fichiers
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class Properties {
    /** @var string Chemin du fichier de properties */
    private static $PROPERTIES_PATH = '../public/properties/';
    
    /** @var string Nom du fichier de properties */
    private static $PROPERTIES_NAME = 'XX.json';
    
    /** @var array Contient toutes les variables d'affichage du site */
     public static $site;
	
	/**
	 * Charge le fichier des propriétés en fonction de l'utilisteur connecté.
	 * DEFAUT_ID_LANGUE par défaut
	 */
	public static function setFile() {
	    $properties = DEFAUT_ID_LANGUE . EXTENSION_PROPERTIES;
	    
	    if ($_SESSION != null && $_SESSION ['util'] != null) {
	        $langue = $_SESSION ['util']->getLangue ();
	        
	        if ($langue != null) {
	            $properties = $langue->getNomProperties ();
	        }
	    }
	    
	    self::$site = json_decode ( file_get_contents ( PROPERTIES . $properties ) );
	}
	
	/**
	 * Sauvegarde le fichier des propriétés.
	 */
	private static function savePropertiesFile() {
	    file_put_contents(PROPERTIES . $properties, json_encode(self::$site));
	}
	
	/**
	 * Sauvegarde le fichier des propriétés.
	 */
	public static function get() {
	    $args = func_get_args();
	    
	    $valeur = self::$site->{$args[0]};
	    
	    if (sizeof($args) > 1) {
    	    for ($i = 1; $i < sizeof($args); $i++)
    	    {
    	        $valeur = $valeur->{$args[$i]};
    	    }
	    }
	    
	    return $valeur;
	}
}