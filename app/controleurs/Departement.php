<?php
namespace Rodez_3IL_Ingenieurs\controleurs;

use Rodez_3IL_Ingenieurs\Core\Controleur;
use Rodez_3IL_Ingenieurs\Modeles;
require_once MODELES . 'Ville.php';
require_once MODELES . 'Departement.php';
require_once MODELES . 'Region.php';

class Departement extends Controleur
{

    /**
     *
     * @var Modeles\Departement le département dont on veut afficher les
     *      informations.
     */
    private $dep;

    private $listeDeps;

    private $modifDepOk;

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        header('Location: /Rodez_3IL_Ingenieurs/departement/liste/');
    }

    public function details($numDep)
    {
        if (isset($numDep)) {
            // Récupère les informations du département.
            $this->dep = Modeles\Departement::getDepartement($numDep);
            
            // Si le département existe.
            if (isset($this->dep)) {
                // Affiche la page de la ville.
                $this->setTitre($this->dep->getNom());
                require_once VUES . 'Departement/VueDepartement.php';
            } else {
                // Affiche que le département n'existe pas.
                $this->setTitre('Département Inconnue');
                require_once VUES . 'Departement/VueDepartementErreur.php';
            }
        } else {
            header('Location: /Rodez_3IL_Ingenieurs/');
        }
    }

    public function liste()
    {
        $this->setTitre('Liste des départements');
        $this->listeDeps = Modeles\Departement::getListeDepartements();
        require_once VUES . 'Departement/VueListeDepartements.php';
    }

    public function modifierDes($numDep)
    {
        if (isset($numDep) && isset($_SESSION['util'])) {
            // Récupère les informations du département.
            $this->dep = Modeles\Departement::getDepartement($numDep);
            
            // Si le département existe.
            if (isset($this->dep)) {
                // Affiche la page de la ville.
                $this->setTitre($this->dep->getNom());
                require_once VUES . 'Departement/VueModifierDescDepartement.php';
            } else {
                // Affiche que le département n'existe pas.
                $this->setTitre('Département Inconnue');
                require_once VUES . 'Departement/VueDepartementErreur.php';
            }
        } else {
            header('Location: /Rodez_3IL_Ingenieurs/');
        }
    }

    public function modifDep($numDep)
    {
        if (isset($_POST['desc'])) {
            $this->modifDepOk = Modeles\Departement::setDesc($numDep, $_POST['desc']);
        }
        require_once VUES . 'Departement/VueResModifDep.php';
    }
}