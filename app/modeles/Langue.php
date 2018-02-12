<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Libs\Photo;

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
    const RQT_LANGUES = 'SELECT idLangue, nom
                            FROM t_langues';

    /**
     * Requête SQL permettant de vérifier qu'un utilisateur existe.
     */
    const RQT_LANGUE = 'SELECT idLangue, nom
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

    const RQT_AJOUTER_LANGUE = 'INSERT INTO t_langues (idLangue, nom)
                                  VALUES (:idLangue, :nom)';

    const RQT_SUPPRIMER_LANGUE = 'DELETE FROM t_langues WHERE idLangue = :idLangue';

    /** @var string le login de l'utilisateur. */
    private $idLangue;

    /** @var string le mot de passe de l'utilisateur. */
    private $nom;

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
    public function __construct($idLangue, $nom)
    {
        $this->idLangue = $idLangue;
        $this->nom = $nom;
    }

    /**
     *  TODO ecrire
     * @return NULL|Langue TODO ecrire
     */
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
            $langues[$i] = new Langue($langueBD[$i]->idLangue, $langueBD[$i]->nom);
        }
        
        // Retourne la listes des départements.
        return isset($langues) ? $langues : null;
    }

    /**
     *  TODO ecrire
     * @param string $nomLangue TODO ecrire
     * @return NULL|string TODO ecrire
     */
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

    /**
     *  TODO ecrire
     * @param string $idLangue TODO ecrire
     * @return NULL|Langue TODO ecrire
     */
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
        return $langueBD ? new Langue($idLangue, $langueBD->nom) : null;
    }

    /**
     *  TODO ecrire
     * @param string $drapeau TODO ecrire
     * @param string $properties TODO ecrire
     */
    public function ajouter($drapeau, $properties)
    {
        if (self::insererBD()) {
            self::ajouterFichiers($drapeau, $properties);
            
            Photo::addDescription($this->getId());
        }
    }

    /**
     *  TODO ecrire
     * @return boolean TODO ecrire
     */
    private function insererBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_AJOUTER_LANGUE);
        
        // Exécution de la requête avec les paramètres.
        return $requete->execute(array(
            ':idLangue' => $this->idLangue,
            ':nom' => $this->nom
        ));
    }

    /**
     *  TODO ecrire
     * @param string $drapeau TODO ecrire
     * @param string $properties TODO ecrire
     */
    private function ajouterFichiers($drapeau, $properties)
    {
        move_uploaded_file($drapeau, '../public/img/drapeau/' . $this->idLangue . EXTENSION_DRAPEAU);
        
        move_uploaded_file($properties, '../public/properties/' . $this->idLangue . EXTENSION_PROPERTIES);
    }

    /**
     *  TODO ecrire
     */
    public function supprimer()
    {
        $err = self::supprimerBD();
        
        if ($err == null) {
            self::supprimerFichiers();
            
            Photo::deleteDescription($this->getId());
        } else {
            echo "\nPDO::errorInfo():\n";
            print_r($err->errorInfo());
        }
    }

    /**
     *  TODO ecrire
     * @return array|NULL TODO ecrire
     */
    private function supprimerBD()
    {
        // Connexion à la base
        self::connexionBD();
        
        // Prépare la requête
        $requete = self::getBaseDeDonnees()->getCnxBD()->prepare(self::RQT_SUPPRIMER_LANGUE);
        
        // Ajout des variables
        $requete->bindParam(':idLangue', $this->idLangue, \PDO::PARAM_INT);
        
        // Exécution de la requête.
        if (! $requete->execute()) {
            return $requete->errorInfo();
        }
        
        return null;
    }

    /**
     *  TODO ecrire
     */
    private function supprimerFichiers()
    {
        unlink('../public/img/drapeau/' . $this->idLangue . EXTENSION_DRAPEAU);
        unlink('../public/properties/' . $this->idLangue . EXTENSION_PROPERTIES);
    }

    /**
     * {@inheritDoc}
     * @see \Rodez_3IL_Ingenieurs\Modeles\Modele::getId()
     */
    public function getId()
    {
        return $this->idLangue;
    }

    /**
     * TODO ecrire
     * @return string le login de l'utilisateur.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *  TODO ecrire
     * @return string TODO ecrire
     */
    public function getNomDrapeau()
    {
        return $this->idLangue . EXTENSION_DRAPEAU;
    }

    /**
     *  TODO ecrire
     * @return string TODO ecrire
     */
    public function getNomProperties()
    {
        return $this->idLangue . EXTENSION_PROPERTIES;
    }
}