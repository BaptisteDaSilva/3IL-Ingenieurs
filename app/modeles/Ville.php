<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

/**
 * Classe représentant une ville de France.
 * 
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Ville extends Modele
{

    /**
     * Requête SQL permettant de récupérer les détails d'une ville.
     */
    const RQT_DETAILS_VILLE = 'SELECT t_villes.numinsee, t_deps.numdep,
                                   t_deps.nom AS nomDep,
                                   t_villes.nom AS nomVille, t_villes.cp,
                                   t_villes.population, t_villes.densite,
                                   t_villes.superficie, t_villes.altmax,
                                   t_villes.altmin, t_villes.latitude,
                                   t_villes.longitude, t_villes.des
                                   FROM t_villes
                                   JOIN t_deps ON t_villes.dep = t_deps.numdep
                                   WHERE t_villes.numinsee = :numInsee';

    const RQT_VILLES_PROCHES = 'SELECT numinsee, nom
                                    FROM t_villes
                                    WHERE latitude BETWEEN (:lat - 0.1)
                                    AND (:lat + 0.1)
                                    AND longitude BETWEEN (:long - 0.1)
                                    AND (:long + 0.1)
                                    AND t_villes.numinsee != :numInsee
                                    ORDER BY nom
                                    LIMIT 10';

    const RQT_RECH_VILLE = 'SELECT t_villes.numinsee, t_villes.nom
                                FROM t_villes
                                WHERE UPPER(t_villes.nom) LIKE upper
                                (:nomVille)
                                LIMIT 20';

    const RQT_MODIF_VILLE = 'UPDATE t_villes
                                 SET population = :population,
                                 densite = :densite,
                                 superficie = :superficie,
                                 altmin = :altMin,
                                 altmax = :altMax,
                                 latitude = :latitude,
                                 longitude = :longitude,
                                 des = :desc
                                 WHERE numinsee = :numInsee';

    /** @var string le numéro INSEE de la ville. */
    private $numInsee;

    /** @var Departement le département de la ville. */
    private $dep;

    /** @var string le nom de la ville. */
    private $nom;

    /** @var string le code postal de la ville. */
    private $cp;

    /** @var int le nombre d'habitants de la commune. */
    private $population;

    /** @var int la densité de la commune. */
    private $densite;

    /** @var float la superficie de la commune. */
    private $superficie;

    /** @var int l'altitude maximum de la commune. */
    private $altMax;

    /** @var int l'altitude minimum de la comune. */
    private $altMin;

    /** @var int la latitude de la commune. */
    private $latitude;

    /** @var int la longitude de la commune. */
    private $longitude;

    /** @var string la description de la commune. */
    private $desc;

    /** @var array */
    private $photos;

    /**
     * Créé une ville.
     * 
     * @param string $numInsee
     *            le numéro INSEE de la ville.
     * @param Departement $dep
     *            le département de la ville.
     * @param string $nom
     *            le nom de la ville.
     * @param string $cp
     *            le code postal de la ville.
     * @param int $population
     *            le nombre d'habitants de la commune.
     * @param int $densite
     *            la densité de la commune.
     * @param float $superficie
     *            la superficie de la commune.
     * @param int $altMax
     *            l'altitude maximum de la commune.
     * @param int $altMin
     *            l'altitude minimum de la comune.
     * @param int $latitude
     *            la latitude de la commune.
     * @param int $longitude
     *            la longitude de la commune.
     * @param string $desc
     *            la description de la commune.
     */
    public function __construct($numInsee, $nom, Departement $dep = null, $cp = null, $population = null, $densite = null, $superficie = null, $altMax = null, $altMin = null, $latitude = null, $longitude = null, $desc = null, $photos = null)
    {
        $this->numInsee = $numInsee;
        $this->dep = $dep;
        $this->nom = $nom;
        $this->cp = $cp;
        $this->population = $population;
        $this->densite = $densite;
        $this->superficie = $superficie;
        $this->altMax = $altMax;
        $this->altMin = $altMin;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->desc = $desc;
        $this->photos = $photos;
    }

    /**
     * Récupère dans la base de données les détails d'une ville
     * dont le numéro INSEE est passé en argument.
     * 
     * @param $numInsee string
     *            le numéro INSEE de la ville.
     * @return Ville|null la ville ou null si cette ville n'existepas
     *         dans la base de données.
     */
    public static function getVille($numInsee)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_DETAILS_VILLE);
        
        // Ajout des variables
        $requete->bindParam(':numInsee', $numInsee, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde la ligne retournée.
        $ville = $requete->fetch();
        
        // Retourne la ville ou null si elle n'existe pas.
        return $ville ? new Ville($ville->numinsee, $ville->nomville, new Departement($ville->numdep, $ville->nomdep), $ville->cp, $ville->population, $ville->densite, $ville->superficie, $ville->altmax, $ville->altmin, $ville->latitude, $ville->longitude, $ville->des) : null;
    }

    /**
     * Retourne les 10 villes les plus proches de la ville passé en
     * argument.
     * 
     * @param $ville Ville
     *            la ville dont on veut connaître les villes
     *            proches.
     * @return array les villes proches de la ville passée en argument.
     */
    public static function getVillesProches($ville)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_VILLES_PROCHES);
        
        // Ajout des variables
        $requete->bindParam(':lat', $ville->latitude, \PDO::PARAM_STR);
        $requete->bindParam(':long', $ville->longitude, \PDO::PARAM_STR);
        $requete->bindParam(':numInsee', $ville->numInsee, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $villesBD = $requete->fetchAll();
        
        for ($i = 0; $i < count($villesBD); $i ++) {
            $villes[$i] = new Ville($villesBD[$i]->numinsee, $villesBD[$i]->nom);
        }
        
        return isset($villes) ? $villes : null;
    }

    public static function rechercherVille($ville)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_RECH_VILLE);
        
        $ville = '%' . $ville . '%';
        
        // Ajout des variables
        $requete->bindParam(':nomVille', $ville, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $villesBD = $requete->fetchAll();
        
        for ($i = 0; $i < count($villesBD); $i ++) {
            $villes[$i] = new Ville($villesBD[$i]->numinsee, $villesBD[$i]->nom);
        }
        
        return isset($villes) ? $villes : null;
    }

    public static function modifierVille($numInsee, $population, $densite, $superficie, $altMin, $altMax, $longitude, $latitude, $desc)
    {
        
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_MODIF_VILLE);
        
        return $requete->execute(array(
            ':numInsee' => $numInsee,
            ':population' => $population,
            ':densite' => $densite,
            ':superficie' => $superficie,
            ':altMin' => $altMin,
            ':altMax' => $altMax,
            ':longitude' => $longitude,
            ':latitude' => $latitude,
            ':desc' => $desc
        ));
    }

    /**
     *
     * @return string le numéro INSEE de la ville.
     */
    public function getNumInsee()
    {
        return $this->numInsee;
    }

    /**
     *
     * @return Departement le département de la ville.
     */
    public function getDep()
    {
        return $this->dep;
    }

    /**
     *
     * @return string le nom de la ville.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return string le code postal de la ville.
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     *
     * @return int le nombre d'habitants de la commune.
     */
    public function getPopulation()
    {
        return $this->population;
    }

    /**
     *
     * @return int la densité de la commune.
     */
    public function getDensite()
    {
        return $this->densite;
    }

    /**
     *
     * @return float la superficie de la commune.
     */
    public function getSuperficie()
    {
        return $this->superficie;
    }

    /**
     *
     * @return int l'altitude maximum de la commune.
     */
    public function getAltMax()
    {
        return $this->altMax;
    }

    /**
     *
     * @return int l'altitude minimum de la commune.
     */
    public function getAltMin()
    {
        return $this->altMin;
    }

    /**
     *
     * @return int la latitude de la commune.
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     *
     * @return int la longitude de la commune.
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     *
     * @return string la description de la commune.
     */
    public function getDesc()
    {
        return $this->desc;
    }
}