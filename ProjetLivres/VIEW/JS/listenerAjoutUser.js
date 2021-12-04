

//#############################################//////////////###################################///



// Check du password
// Initialisation après chargement du DOM. On met ça pour exécuter le code après la page
document.addEventListener("DOMContentLoaded", function() {
    // mettre ici le code à exécuter

    var boutonSubmit=document.getElementById("boutonSubmit");
    var username=document.getElementById("username");
    var name=document.getElementById("name");
    var surname=document.getElementById("surname");

    var password = document.getElementById("password");
    var password2 = document.getElementById("password2");

    usernameOk = false;
    passwordOk = false;
    password2Ok = false;
    nameOk = false;
    surnameOk = false;


    // mettre ici le code à exécuter
    function verifUsername(){

        var regex = /^([a-zA-Z0-9-_]{4,36})$/;

        // On teste la regex d'abord si c'est bon !
        if (!regex.test(username.value)) {
            username.className = "alert alert-danger";

            usernameOk = false;

            verifAllOk();

            $("#resultatUsername").html("<p class='alert alert-danger  alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Votre pseudo doit contenir minimum 4 lettres</p>");
        } else {
            // Si la regex est OK. Alors on vérifie en DB si l'utilisateur est existant !!

            $.ajax({
                url: "checkUser.php",
                data: {username: $("#username").val()},
                type: "POST",
                success: function (data) {

                    // $("#user-availability-status").html(data);
                    if (data == 'null') {
                        username.className = "alert alert-danger";

                        usernameOk = false;

                        verifAllOk();
                        $("#resultatUsername").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Veuillez remplir le champ !</p>");
                    } else if (data != 'true') {
                        username.className = "alert alert-danger";

                        usernameOk = false;

                        verifAllOk();
                        $("#resultatUsername").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Username existe déjà !</p>");
                    } else {
                        username.className = "alert alert-success";
                        usernameOk = true;

                        verifAllOk();
                        // On revérifie les passwords

                        $("#resultatUsername").html("");
                    }

                },
                error: function () {
                }
            });
        }

    }


    username.addEventListener('blur', function(event) {

        verifUsername();


    });

// fonction de correspondance d'égalité
    function verifPsw(){
        if (password.value.length >= 4)
        {

            if (password.value !== password2.value )
            {

                passwordOk = false;

                password2Ok = false;

                verifAllOk();


                password.className = "alert alert-danger";

                password2.className = "alert alert-danger";


                $("#resultatPassword").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Vos mots de passes ne correspondent pas !!</p>");
            }
            else if (password.value == password2.value )
            {
                // On revérifie l'username avant de valider
                passwordOk = true;

                password2Ok = true;
                password.className = "alert alert-success";

                password2.className = "alert alert-success";

                verifAllOk();

                $("#resultatPassword").html("");
            }

        }
        else
        {

            passwordOk = false;

            password2Ok = false;
            password.className = "alert alert-danger";

            password2.className = "alert alert-danger";
            verifAllOk();

            $("#resultatPassword").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Votre mot de passe doit contenir minimum 4 caractères !!</p>");
        }
    }

    password.addEventListener('keyup', function() {

        if (password.value !='' && password2.value!= '' )
        {
            verifPsw();
        }
    });

    password2.addEventListener('keyup', function() {
        if (password.value !='' && password2.value!= '' )
        {
            verifPsw();
        }
    });


    // Fonction pour le nom et le prénom
    function verifNom(champ)
    {
        var regexChamp = /^([a-zA-ZÀ-ú\-\s]{4,36})$/;

        // On teste la regex d'abord si c'est bon !
        if (!regexChamp.test(champ.value)) {

            surnameOk = false;

            verifAllOk();
            champ.className = "alert alert-danger";
            $("#resultatSurname").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Votre nom doit contenir minimum 4 lettres</p>");
        } else
        {

            surnameOk = true;

            verifAllOk();
            champ.className = "alert alert-success";
            $("#resultatSurname").html("");
        }
    }

    function verifPrenom(champ)
    {
        var regexChamp = /^([a-zA-ZÀ-ú\-\s]{4,36})$/;

        // On teste la regex d'abord si c'est bon !
        if (!regexChamp.test(champ.value)) {

            nameOk = false;

            verifAllOk();
            champ.className = "alert alert-danger";
            $("#resultatName").html("<p class='alert alert-danger alert-dismissible fade show'><button type='button' class='close' data-dismiss='alert'>&times;</button>Votre prénom doit contenir minimum 4 lettres</p>");
        } else
        {

            nameOk = true;

            verifAllOk();
            champ.className = "alert alert-success";
            $("#resultatName").html("");
        }
    }
    // Vérification du prénom
    name.addEventListener('keyup', function() {
        if (name.value !='')
        {
            verifPrenom(name);


            verifAllOk();
        }
    });

    // Vérification du nom
    surname.addEventListener('keyup', function() {
        if (surname.value !='')
        {
            verifNom(surname);


            verifAllOk();
        }
    });
// vérification supplémentaire par validation
    boutonSubmit.addEventListener('click', function(event) {
        if (password.value !== password2.value ){
            event.preventDefault(); // Annuler la validation du formulaire
        }
    });

    function verifAllOk()
    {
        if ((usernameOk == true) && (password2Ok == true) && (password2Ok == true) && (nameOk  == true) && (surnameOk == true))
        {
            boutonSubmit.disabled=false;
        }
        else
        {
            boutonSubmit.disabled=true;
        }
    }
});
