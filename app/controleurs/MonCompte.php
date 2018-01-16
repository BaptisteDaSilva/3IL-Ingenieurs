<?php
    namespace GeoVilles\controleurs;
    use GeoVilles\Core\Controleur;
    use GeoVilles\Modeles\Utilisateur;

    class MonCompte extends Controleur {

        /** @var bool */
        private $modifOK;

        /**
         * Méthode lancée par défaut sur un contrôleur.
         */
        public function index() {
            if (isset($_SESSION['util'])) {

                $this->setTitre("Mon Compte");

                require_once VUES . 'MonCompte/VueMonCompte.php';

            } else {
                header('Location: /GeoVilles/');
            }
        }

        public function modifier() {
            if (isset($_POST['email']) && isset($_POST['mdp'])) {

                $this->setTitre($this->modifOK ? "Modification Réussie !" :
                                "Un Problème est survenue");

                $email = $_POST['email'];
                $mdp = $_POST['mdp'];

                if (empty($mdp)) {
                    $mdp = $_SESSION['util']->getMdp();
                } else {
                    $mdp = Utilisateur::hashMdp($mdp);
                }

                $this->modifOK = $_SESSION['util']->modifierUtil($email, $mdp);

                $login = $_SESSION['util']->getLogin();

                $_SESSION['util'] = Utilisateur::getUtilisateur($login, $mdp);

                require_once VUES . 'MonCompte/VueCompteModifie.php';

            } else {
                header('Location: /GeoVilles/monCompte/');
            }
        }
    }