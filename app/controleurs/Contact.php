<?php
namespace Rodez_3IL_Ingenieurs\Controleurs;

use PHPMailer\PHPMailer\PHPMailer;
use Rodez_3IL_Ingenieurs\Core\Controleur;

/**
 * Contrôleur de la page de contact.
 *
 * @package Rodez_3IL_Ingenieurs\Controleurs
 */
class Contact extends Controleur
{

    /**  @var boolean Statut de l'envoie du mail */
    private $statutEnvoie;

    /**
     * Créé un nouveau contrôleur de la page de contact.
     */
    public function __construct()
    {
        parent::__construct();
        
        $this->setActivePage('Contact');
    }

    /**
     * Méthode lancée par défaut sur un contrôleur.
     */
    public function index()
    {
        $this->setTitre($this->get('Contact', 'Titre'));
        
        require_once VUES . 'Contact/VueContact.php';
    }

    public function sendMail()
    {
        $this->setTitre($this->get('Contact', 'Titre'));
        
        $mail = new PHPMailer(true); // Passing `true` enables exceptions
        
        $mail->CharSet = 'UTF-8';
        
        // Server settings
        $mail->SMTPDebug = 0; // 2 debug // Enable verbose debug output
        $mail->isSMTP(); // Set mailer to use SMTP
        $mail->Host = 'smtp.gmail.com'; // Specify main and backup SMTP servers
        $mail->SMTPAuth = true; // Enable SMTP authentication
        $mail->Username = 'site.3il.ingenieurs@gmail.com'; // SMTP username
        $mail->Password = 'Azerty123+'; // SMTP password
        $mail->SMTPSecure = 'ssl'; // Enable TLS encryption, `ssl` also accepted
        $mail->Port = 465; // TCP port to connect to
        
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );
        
        // Recipients
        $mail->setFrom($_SESSION['util']->getEmail(), $_SESSION['util']->getLogin());
        $mail->addAddress('site.3il.ingenieurs@gmail.com', 'Site 3iL-Ingénieurs'); // Add a recipient
                                                                                   // $mail->addAddress('ellen@example.com'); // Name is optional
                                                                                   // $mail->addReplyTo('info@example.com', 'Information');
        $mail->addCC($_SESSION['util']->getEmail());
        // $mail->addBCC('bcc@example.com');
        
        // Attachments
        // $mail->addAttachment('/var/tmp/file.tar.gz'); // Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg'); // Optional name
        
        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $_POST['objet'];
        $mail->Body = $_POST['message'];
        // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
        
        $this->statutEnvoie = $mail->send();
        
        $this->index();
    }
}
