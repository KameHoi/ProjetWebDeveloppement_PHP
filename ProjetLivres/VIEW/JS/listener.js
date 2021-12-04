// Ajax charger le header (panier
$(document).ready(function () {

    majAjaxPanierHeader();
});

function majAjaxPanierHeader(){

    $.ajax({

        url: "majBasket.php",
        data: {},
        type: "POST",

        success: function (data) {
            $('#resultatDuPanier').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
            // En cas de récupération de data; on les affiche
            //$('#messages').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
        },
        error: function () {
            //$('#messagesRetour').html("<p class='alert alert-danger'>Une erreur est survenue !</p>");
            // En cas d'échec de récupération de data; on affiche msg d'erreur
            //$("#messages").html("<p>L'utilisateur n'existe pas !!</p>");
        }
    });

};
/////////////////////////////////////////////
// Fonction sur listUsers.php !! En cas de clic sur rechercher au lieu d'attendre 3 lettres
search = false;
function searchTrue(){
    search = true;
    check();
}
//#############################################//////////////###################################///
// Ajax sur listUsers.php
function check() {
    username=document.getElementById("username");

    //  alert($("#username").val().length);
    if (($("#username").val().length > 2) || (search == true)) {          // Si usename contient plus de 3 caractère alors on commence ajax
        $.ajax({
            url: "displayUsers.php",
            data: {username: $("#username").val()},
            type: "POST",

            success: function (data) {
                // En cas de récupération de data; on les affiche
                $('#messages').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
            },
            error: function () {                  // En cas d'échec de récupération de data; on affiche msg d'erreur
                $("#messages").html("<p>L'utilisateur n'existe pas !!</p>");


            }
        });
    }
}
//#############################################//////////////###################################///

////////////////////////////////////////////////////////////////////////////
// Fonction utilisé sur displayUsers.php. Pour changer l'état du users avec la checkbox (actif, inactif)

function changeEtatActive(x) {

    //alert( $("#desactive").val());
    //alert(row);
    //alert(txt);
    //alert($(txt).val());
    // Traitements sur des cases à chocher
    $("input[type=checkbox][name=name-checkbox]").change(function() {

        var row = (x.rowIndex)-1;

        var txt = '#utilisateur' + row;
        if(this.checked) {

            //alert(row);
            //alert();
            // Si la case est cochée, on fait des traitements
            $.ajax({
                url: "actifUser.php",
                type: "POST",
                data : {
                    actif : ('1'),
                    utilisateur : $(txt).val(),

                },
                success : function(){
                    check();
                    //alert( $("#desactive").val());

                    // faire qqchavec la réponse du serveur
                }

            });
        }else if(!this.checked) {
            // Si la case est n'est pas cochée, on fait d'autres traitements
            //alert();
            $.ajax({
                url: "actifUser.php",
                type: "POST",
                data : {
                    actif : ('0'),
                    utilisateur : $(txt).val(),

                },
                success : function(){
                    check();
                    //alert( $("#desactive").val());

                    // faire qqchavec la réponse du serveur
                }

            });
        }
    });


}



/////////////////////////////////////////////
// Fonction sur book.php !! En cas de clic sur rechercher au lieu d'attendre 3 lettres
search = false;
function searchTrueBook(){
    search = true;
    checkBook();
}

function checkBook() {
    //var searchLabel = document.getElementById("searchLabel");
    console.log("enter- checkBook()");
//pour la recherche par titre
    if (($("#searchLabelBook").val().length > 2) || ($("#searchAuth").val().length > 2 ) || (search == true))  {         // Si la longueur du titre contient plus de 3 caractère alors on commence ajax
        $.ajax({

            url: "displayBook.php",//affiche bien la page
            data: {searchLabelBook: $("#searchLabelBook").val(),
                   searchAuth: $("#searchAuth").val()
            },
            type: "POST",  //post asynchrone sur affichage books

            success: function (data) {
                // En cas de récupération de data; on les affiche
                console.log("begin ajax");
                $('#messages').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
            },
            error: function () {
                console.log("erreur ajax");// En cas d'échec de récupération de data; on affiche msg d'erreur
                $("#messages").html("<p>Le livre n'existe pas !!</p>");
            }
        });
    }


    console.log("exit- checkBook()");
}

///////////////////////////////////////
// Pour changer l'état des livres :actif ou inactif
function ActifOrInactif(x) {
    console.log("enter- checkactif()");
    //alert( $("#desactive").val());
    //alert(row);
    //alert(txt);
    //alert($(txt).val());
    //alert(auth);

    // Traitements sur des cases à chocher

    $("input[type=checkbox][name=checkBoxActif]").change(function() {

        //var row = (x.rowIndex)-1;

       // var txt = '#livre' + row;
        //console.log('Row : ' + txt)
        //alert(txt);
        if(this.checked) {
            //alert(row);
            //alert();
            // Si la case est cochée, on fait des traitements
            $.ajax({
                url: "actifBook.php",
                type: "POST",
                data : {
                    actif : ('1'),
                    id : this.id.replace("checkBoxActif", ""),

                },
                success : function(){
                    checkBook();
                    //alert( $("#desactive").val());

                    // faire qqchavec la réponse du serveur
                }

            });
        }else if(!this.checked) {
            // Si la case est n'est pas cochée, on fait d'autres traitements
            //alert();
            $.ajax({
                url: "actifBook.php",
                type: "POST",
                data : {
                    actif : ('0'),
                    id : this.id.replace("checkBoxActif", ""),

                },
                success : function(){
                    checkBook();
                    //alert( $("#desactive").val());

                    // faire qqchavec la réponse du serveur
                }

            });
        }
        // console.log("exit- checkactif()");
    });
}


function verifAuthor(){
    var auth = document.getElementById("author").value;
    var label = document.getElementById("label").value;
    var div_comp = document.getElementById("divcomp");


    if(auth == "" && label == "")
    {
        divcomp.innerHTML = "";
        document.getElementById("button").disabled= false;
        var passOK = 1;
    }
    else
    {
        divcomp.innerHTML = "Le titre ou l'auteur ne sont pas modifiable";
        document.getElementById("button").disabled = true;
        /*document.getElementById("button").prop(disabled, true);
        $("#button").attr("disabled", true);*/
        var passOK = 0;
    }
    return passOK;
}


function verifButton(){
    var passOK = verifAuthor();
    if(passOK == 0){
        document.getElementById("boutonSubmit").disabled = true;
    }
    else{
        document.getElementById("boutonSubmit").disabled= false;
    }
}




function test(){
    alert('test');
}


