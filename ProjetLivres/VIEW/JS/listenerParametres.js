

// Check du password
// Initialisation après chargement du DOM. On met ça pour exécuter le code après la page
document.addEventListener("DOMContentLoaded", function() {
    // mettre ici le code à exécuter


    var password = document.getElementById("password");
    var password2 = document.getElementById("password2");

// fonction de correspondance d'égalité
    function verifPsw(){
        if (password.value.length >= 4)
        {

                if (password.value !== password2.value )
            {
                boutonSubmit.disabled = true;
                password.className = 'alert alert-danger';
                password2.className = 'alert alert-danger';

                $("#resultatPassword").html("<p class='alert alert-danger'>Vos mots de passes ne correspondent pas !!</p>");
            }
            else if (password.value == password2.value )
            {
                boutonSubmit.disabled = false;
                password.className ='alert alert-success';
                password2.className ='alert alert-success';

                $("#resultatPassword").html("");
            }
        }
        else
        {

            password.className = "alert alert-danger";

            password2.className = "alert alert-danger";

            $("#resultatPassword").html("<p class='alert alert-danger'>Votre mot de passe doit contenir minimum 4 caractères !!</p>");
        }
    }
    password.addEventListener('keyup', function() {

        if (password.value !='' && password2.value!= '' )
            verifPsw();
    });

    password2.addEventListener('keyup', function() {
        if (password.value !='' && password2.value!= '' )
            verifPsw();
    });

// vérification supplémentaire par validation
    boutonSubmit.addEventListener('click', function(event) {
        if (password.value !== password2.value ){
            event.preventDefault(); // Annuler la validation du formulaire
        }
    });

});
