<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

/**
 * Représente une région de France.
 * 
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Region extends Modele
{

    /**
     * Requête SQL permettant de récupérer les détails d'une région.
     */
    const RQT_DETAILS_REGIONS = 'SELECT t_regions.numreg,
                                     t_regions.nom AS nomReg,
                                     t_villes.numinsee,
                                     t_villes.nom AS nomChefLieu, t_villes.des
                                     FROM t_regions
                                     JOIN t_villes ON t_regions.cheflieu =
                                     t_villes.numinsee
                                     WHERE t_regions.numreg = :numReg';

    /**
     * Requête SQL permettant de récupérer la liste des départements de
     * la région.
     */
    const RQT_LISTE_DEPS = 'SELECT t_deps.numdep, t_deps.nom
                                FROM t_deps
                                WHERE t_deps.region = :numReg
                                ORDER BY t_deps.nom';

    /** @var string le numéro de la région. */
    private $numReg;

    /** @var string le nom de la région. */
    private $nomReg;

    /** @var Ville le chef-lieu de la région. */
    private $chefLieu;

    /** @var array la liste des départements de la région. */
    private $deps;

    /** @var string la description de la région. */
    private $desc;

    /**
     * Créé une région.
     * 
     * @param string $numReg
     *            le numéro de la région.
     * @param string $nomReg
     *            le nom de la région.
     * @param Ville $chefLieu
     *            le chef-lieu de la région.
     * @param array $deps
     *            la liste des départements de la région.
     * @param string $desc
     *            la description de la région.
     */
    public function __construct($numReg, $nomReg, Ville $chefLieu = null, array $deps = null, $desc = null)
    {
        $this->numReg = $numReg;
        $this->nomReg = $nomReg;
        $this->chefLieu = $chefLieu;
        $this->deps = $deps;
        $this->desc = $desc;
    }

    /**
     * Récupère dans la base de données les détails d'une région.
     * 
     * @param $numReg string
     *            le numéro de la région.
     * @return Departement|null la région ou null si cette région
     *         n'existe pas dans la base de données.
     */
    public static function getRegion($numReg)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_DETAILS_REGIONS);
        
        // Ajout des variables
        $requete->bindParam(':numReg', $numReg, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde la ligne retournée.
        $reg = $requete->fetch();
        
        // Récupère la liste des départements de la région.
        $deps = self::getListeDeps($numReg);
        
        // Retourne la région ou null si elle n'existe pas.
        return $reg ? new Region($reg->numreg, $reg->nomreg, new Ville($reg->numinsee, $reg->nomcheflieu), $deps, $reg->des) : null;
    }

    /**
     * Récupère dans la base de données la liste des départements
     * de la région.
     * 
     * @param $numReg string
     *            le numéro de la région.
     * @return array la liste des départements de la région.
     */
    private static function getListeDeps($numReg)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_LISTE_DEPS);
        
        // Ajout des variables
        $requete->bindParam(':numReg', $numReg, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde la ligne retournée.
        $depsBD = $requete->fetchAll();
        
        // Créé la liste des départements.
        for ($i = 0; $i < count($depsBD); $i ++) {
            $deps[$i] = new Departement($depsBD[$i]->numdep, $depsBD[$i]->nom);
        }
        
        // Retourne la listes des départements.
        return isset($deps) ? $deps : null;
    }

    /**
     *
     * @return string le numéro de la région.
     */
    public function getNumReg()
    {
        return $this->numReg;
    }

    /**
     *
     * @return string le nom de la région.
     */
    public function getNomReg()
    {
        return $this->nomReg;
    }

    /**
     *
     * @return Ville le chef-lieu de la région.
     */
    public function getChefLieu()
    {
        return $this->chefLieu;
    }

    /**
     *
     * @return array la liste des départements de la région.
     */
    public function getDeps()
    {
        return $this->deps;
    }

    /**
     *
     * @return string la description de la région.
     */
    public function getDesc()
    {
        return $this->desc;
    }
}