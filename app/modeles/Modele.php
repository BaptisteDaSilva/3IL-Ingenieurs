<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Libs\BaseDeDonnees;

abstract class Modele
{

    /** @var BaseDeDonnees la connexion à la base de données. */
    private static $baseDeDonnees;

    /**
     * Se connecte à la base de données.
     */
    protected static function connexionBD()
    {
        self::$baseDeDonnees = new BaseDeDonnees();
    }

    /**
     * TODO ecrire
     * @return BaseDeDonnees la connexion à la base de données.
     */
    protected static function getBaseDeDonnees()
    {
        return self::$baseDeDonnees;
    }

    /**
     * Retourne l'identifiant de l'objet
     */
    abstract public function getId();
}