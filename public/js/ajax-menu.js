/*
 * Fichier contenant les fonctions des requêtes AJAX du site.
 */

// S'exécute en boucle.
$(function () {
    
    // Dès que le texte du pseudo change.
    $('#form-inscrire > .form-group > input[name="login"]').on('input', function () {
    	   	
        // L'obejt HTML <input> du pseudo 
        $input = $(this);
        
        // Le bouton de soumissions de l'inscription.
        $btn = $('#form-inscrire > input[name="submit"]');
        
        // On enlève toute mise en forme d'une requête AJAX précédente.
        removeInfo($input);
        
        btnInscription($btn, false);

        if ($input.val() !== "") {        	
            // Requête AJAX
            $.ajax({                
                // URL de la fonction PHP à questionner
                url: "/Inscription/testPseudo/" + $input.val(),
                
                // Avant d'envoyer la requête
                beforeSend: function() {                    
                    // On enlève toute mise en forme d'une requête AJAX précédente.
                    removeInfo($input);
                    
                    // Si le pseudo n'est pas vide
                    if ($input.val() !== "") {
                        
                        // On affiche l'icône de requête envoyée et en attente de réponse.
                        pseudoAttente($input);
                    }
                },
                
                // Si la fonction PHP n'a pas retournée d'erreurs
                success: function () {                    
                    // On enlève toute mise en forme d'une requête AJAX précédente.
                    removeInfo($input);
                    
                    // Si le pseudo n'est pas vide
                    if ($input.val() !== "") {
                        
                        // On affiche que le pseudo est valide
                        pseudoValide($input, true);
                        
                        // On ré-active le bouton d'inscription
                        btnInscription($btn, true);
                    }
                },
                
                // Si une erreur est survenu lors de la fonction PHP
                error: function () {
                    // On enlève toute mise en forme d'une requête AJAX précédente.
                    removeInfo($input);
                    
                    // Si le pseudo n'est pas vide
                    if ($input.val() !== "") {
                        
                        // On affiche que le pseudo est invalide
                        pseudoValide($input, false);
                        
                        // On désactive le bouton d'inscription
                        btnInscription($btn, false);
                    }                	
                }
            });
        }
    });
});

/**
 * Affiche à l'utilisateur si le pseudo entré est valide ou non.
 * @param {type} $input l'objet HTML <input> ou est contenu le pseudo
 * @param {type} $valide si le pseudo est valide ou non
 */
function pseudoValide($input, $valide) {
    
    // Si le pseudo est valide
    if ($valide) {
        
        // Alors on affiche que le pseudo est valide
        $input.parent().addClass('has-success');
        $input.parent().append("<span class='fa fa-lg fa-check form-control-feedback' aria-hidden='true'></span>");
    } else {
        
        // Sinon on affiche que le pseudo est invalide
        $input.parent().addClass('has-error');
        $input.parent().append("<span class='fa fa-lg fa-close form-control-feedback' aria-hidden='true'></span>");
    }
}

/**
 * Affiche un icône pour informer l'utilisateur que le serveur
 * effectue une recherche (requête AJAX attend une réponse).
 * @param {type} $input l'objet HTML <input> ou est contenu le pseudo
 */
function pseudoAttente($input) {
    $input.parent().addClass('has-error');
    $input.parent().append("<span class='fa fa-lg fa-refresh fa-spin form-control-feedback' aria-hidden='true'></span>");
}

/**
 * Enlève toute information sur une requête AJAX passée précédemment.
 * @param {type} $input l'objet HTML <input> ou est contenu le pseudo
 */
function removeInfo($input) {
    $input.parent().removeClass('has-success has-error');
    $input.next(".fa").remove();
}

/**
 * Active ou désactive le bouton d'inscription.
 * @param {type} $btn le bouton HTML à active/désactiver.
 * @param {type} $valide si le pseudo est valide ou non.
 */
function btnInscription($btn, $valide) {
    if ($valide) {
        $btn.removeAttr('disabled');
    } else {
        $btn.attr('disabled', 'true');
    }
}