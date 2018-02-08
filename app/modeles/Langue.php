<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

/**
 * Représente un utilisateur du site connecté.
 *
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Langue extends Modele
{

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_LANGUES = 'SELECT idLangue, nom, nomDrapeau, nomProperties
                            FROM t_langues';

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_LANGUE = 'SELECT idLangue, nom, nomDrapeau, nomProperties
                            FROM t_langues
                            WHERE idLangue = :idLangue';

    const RQT_ID_LANGUE = 'SELECT idLangue
                            FROM t_langues
                            WHERE nom = :nom';

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_NOM_LANGUE = 'SELECT nom
                            FROM t_langues
                            WHERE idLangue = :idLangue';

    const RQT_AJOUTER_LANGUE = 'INSERT INTO t_langues (nom, nomDrapeau, nomProperties)
                                  VALUES (:nom, :nomDrapeau, :nomProperties)';

    const RQT_SUPPRIMER_LANGUE = 'DELETE FROM t_langues WHERE idLangue = :idLangue';

    /** @var string le login de l'utilisateur. */
    private $idLangue;

    /** @var string le mot de passe de l'utilisateur. */
    private $nom;

    /** @var string l'eamil de l'utilisateur. */
    private $nomDrapeau;

    /** @var string l'eamil de l'utilisateur. */
    private $nomProperties;

    public static $DEFAUT_DRAPEAU = "XX.png";

    /**
     * Créé un nouvel utilisateur.
     *
     * @param string $login
     *            le login de l'utilisateur.
     * @param string $mdp
     *            le mot de passe de l'utilisateur.
     * @param string $email
     *            l'email de l'utilisateur.
     */
    public function __construct($idLangue, $nom, $nomDrapeau, $nomProperties)
    {
        $this->idLangue = $idLangue;
        $this->nom = $nom;
        $this->nomDrapeau = $nomDrapeau;
        $this->nomProperties = $nomProperties;
    }

    public static function getLangues()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_LANGUES);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $langueBD = $requete->fetchAll();
        
        // Créé la liste des départements.
        for ($i = 0; $i < count($langueBD); $i ++) {
            $langues[$i] = new Langue($langueBD[$i]->idLangue, $langueBD[$i]->nom, $langueBD[$i]->nomDrapeau, $langueBD[$i]->nomProperties);
        }
        
        // Retourne la listes des départements.
        return isset($langues) ? $langues : null;
    }

    public static function getIdLangue($nomLangue)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_ID_LANGUE);
        
        // Ajout des variables
        $requete->bindParam(':nom', $nomLangue, \PDO::PARAM_STR);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $langue = $requete->fetch();
        
        // Retourne l'utilisateur ou null s'il n'existe pas.
        return $langue ? $langue->idLangue : null;
    }

    public static function getLangue($idLangue)
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_LANGUE);
        
        // Ajout des variables
        $requete->bindParam(':idLangue', $idLangue, \PDO::PARAM_INT);
        
        // Exécute la requête
        $requete->execute();
        
        // Sauvegarde les lignes retournées.
        $langueBD = $requete->fetch();
        
        // Retourne l'utilisateur ou null s'il n'existe pas.
        return $langueBD ? new Langue($idLangue, $langueBD->nom, $langueBD->nomDrapeau, $langueBD->nomProperties) : null;
    }

    public function ajouter($drapeau, $properties)
    {
        if (self::insererBD()) {
            self::ajouterFichiers($drapeau, $properties);
        }
    }

    private function insererBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_AJOUTER_LANGUE);
        
        // Exécution de la requête avec les paramètres.
        return $requete->execute(array(
            ':nom' => $this->nom,
            ':nomDrapeau' => $this->nomDrapeau,
            ':nomProperties' => $this->nomProperties
        ));
    }

    private function ajouterFichiers($drapeau, $properties)
    {
        move_uploaded_file($drapeau, '../public/img/drapeau/' . $this->nomDrapeau);
        
        move_uploaded_file($properties, '../public/properties/' . $this->nomProperties);
    }

    // TODO a tester
    public function supprimer()
    {
        $err = self::supprimerBD();
        
        if ($err == null) {
            // supprimerFichiers();
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r($err->errorInfo());
        }
    }

    private function supprimerBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_SUPPRIMER_LANGUE);
        
        var_dump($this);
        
        // Ajout des variables
        $requete->bindParam(':idLangue', $this->idLangue, \PDO::PARAM_INT);
        
        // Exécution de la requête.
        if (! $requete->execute()) {
            return $requete->errorInfo();
        }
    }

    private function supprimerFichiers()
    {
        unlink(DRAPEAU . $this->nomDrapeau);
        unlink(PROPERTIES . $this->nomProperties);
    }

    /**
     *
     * @return string le login de l'utilisateur.
     */
    public function getId()
    {
        return $this->idLangue;
    }

    /**
     *
     * @return string le login de l'utilisateur.
     */
    public function getNom()
    {
        return $this->nom;
    }

    public function getNomDrapeau()
    {
        return $this->nomDrapeau;
    }

    public function getNomProperties()
    {
        return $this->nomProperties;
    }
}