<?php
namespace Rodez_3IL_Ingenieurs\Modeles;

use Rodez_3IL_Ingenieurs\Libs\GestionFichier;
use Rodez_3IL_Ingenieurs\Libs\PhotoSlider;

/**
 * Représente une langue.
 *
 * @package Rodez_3IL_Ingenieurs\Modeles
 */
class Langue extends Modele
{

    /** @var string Requête SQL permettant de rechercher tous les langues */
    const RQT_LANGUES = 'SELECT idLangue, nom
                         FROM t_langues';

    /** @var string Requête SQL permettant de rechercher une langue a partir de son identifiant */
    const RQT_LANGUE = 'SELECT idLangue, nom
                        FROM t_langues
                        WHERE idLangue = :idLangue';

    /** @var string Requête SQL permettant de rechercher l'identifiant d'une langue a partir de son nom */
    const RQT_ID_LANGUE = 'SELECT idLangue
                           FROM t_langues
                           WHERE nom = :nom';

    /** @var string Requête SQL permettant de rechercher le nom d'une langue a partir de son identifiant */
    const RQT_NOM_LANGUE = 'SELECT nom
                            FROM t_langues
                            WHERE idLangue = :idLangue';

    /** @var string Requête SQL permettant de créer une langue */
    const RQT_AJOUTER_LANGUE = 'INSERT INTO t_langues (idLangue, nom) VALUES (:idLangue, :nom)';

    /** @var string Requête SQL permettant de supprimer une langue */
    const RQT_SUPPRIMER_LANGUE = 'DELETE FROM t_langues WHERE idLangue = :idLangue';

    /** @var string le login de l'utilisateur. */
    private $idLangue;

    /** @var string le mot de passe de l'utilisateur. */
    private $nom;

    /**
     * Créer une nouvel langue.
     *
     * @param string $idLangue
     *            Identifiant de la langue (EX : FR, EN, ...)
     * @param string $nom
     *            Nom de la langue (Ex : Francais, English, ...)
     */
    public function __construct($idLangue, $nom)
    {
        $this->idLangue = $idLangue;
        $this->nom = $nom;
    }

    /**
     * Retourne toutes les langues présentes en BD
     *
     * @return NULL|Langue La liste des langues si elle existe, null sinon
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
     * Recherche l'identifiant de la langue à partir de son nom
     *
     * @param string $nomLangue
     *            Nom de la langue à chercher
     * @return NULL|string L'id de la langue si il a été trouvé, null sinon
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
     * Recherche une langue à partir de son identifiant
     *
     * @param string $idLangue
     *            L'identifiant de la langue
     * @return NULL|Langue Langue si trouvé, null sinon
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
     * Enregistre une nouvelle langue dans la BD et sauvegarde le drapeau et le properties associé sur le serveur
     *
     * @param string $drapeau
     *            Nom du drapeau associé à la langue
     * @param string $properties
     *            Nom du fichier properties associé à la langue
     */
    public function ajouter($drapeau, $properties)
    {
        return self::insererBD() && self::ajouterFichiers($drapeau, $properties) && PhotoSlider::addDescriptions($this->getId());
    }

    /**
     * Ajoute un nouvelle langue dans la BD
     *
     * @return boolean True si insertion OK, false sinon
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
     * Telecharge le drapeau et le fichier properties de la langue sur le serveur
     *
     * @param string $drapeau
     *            Nom du drapeau de la langue
     * @param string $properties
     *            Nom du fichier properties de la langue
     */
    private function ajouterFichiers($drapeau, $properties)
    {
        return GestionFichier::telecharger(GestionFichier::$TYPE_DRAPEAU, $drapeau, $this->idLangue . EXTENSION_DRAPEAU)
            && GestionFichier::telecharger(GestionFichier::$TYPE_PROPERTIES, $properties, $this->idLangue . EXTENSION_PROPERTIES);
    }

    /**
     * Supprime une langue
     */
    public function supprimer()
    {
        return self::supprimerBD() && self::supprimerFichiers() && PhotoSlider::deleteDescription($this->getId());
    }

    /**
     * Supprime la langue de la BD
     *
     * @return boolean True si OK, false sinon
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
        return $requete->execute();
    }

    /**
     * Supprimer le drapeau et le fichier properties du serveur
     */
    private function supprimerFichiers()
    {
        return GestionFichier::supprimer(GestionFichier::$TYPE_DRAPEAU, $this->idLangue . EXTENSION_DRAPEAU) && GestionFichier::supprimer(GestionFichier::$TYPE_PROPERTIES, $this->idLangue . EXTENSION_PROPERTIES);
    }

    /**
     *
     * {@inheritdoc}
     * @see \Rodez_3IL_Ingenieurs\Modeles\Modele::getId()
     */
    public function getId()
    {
        return $this->idLangue;
    }

    /**
     *
     * @return string Le login de l'utilisateur.
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     *
     * @return string Le nom du drapeau de la langue
     */
    public function getNomDrapeau()
    {
        return $this->idLangue . EXTENSION_DRAPEAU;
    }

    /**
     *
     * @return string Le nom du fichier properties
     */
    public function getNomProperties()
    {
        return $this->idLangue . EXTENSION_PROPERTIES;
    }
}