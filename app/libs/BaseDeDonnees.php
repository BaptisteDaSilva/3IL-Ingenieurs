<?php
namespace Rodez_3IL_Ingenieurs\Libs;

/**
 * Classe représentant la connexion à la base de données.
 *
 * @package Rodez_3IL_Ingenieurs\Libs
 */
class BaseDeDonnees
{

    /**
     * Les options pour toutes les requêtes à la base de donnée.
     */
    public static $OPTIONS_DB = array(
        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_OBJ,
        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_WARNING,
        \PDO::ATTR_PERSISTENT => true
    );

    /** @var \PDO la connexion à la base de données. */
    private $cnxBD;

    public function __construct()
    {
        // Importe la configuration de la connexion à la base
        $config = parse_ini_file(CONFIG);
        
        // Connexion à la base
        try {
            $this->cnxBD = new \PDO($config['type'] . ':host=' . $config['host'] . ';port=' . $config['port'] . ';dbname=' . $config['nom_bd'] . ';charset=utf8', $config['login'], $config['mdp'], self::$OPTIONS_DB);
        } catch (\PDOException $e) {
            echo $e->getMessage();
        }
    }

    /**
     *
     * @return \PDO la connexion à la base de données.
     */
    public function getCnxBD()
    {
        return $this->cnxBD;
    }
}