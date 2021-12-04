
//#############################################//////////////###################################///
// Ajax sur panier


    function sendNumber(x) {

        var row = (x.rowIndex) - 1;


        var txtID = '#livreID' + row;
        var txtQuantity = '#livreQuantity' + row;
        var txtPrice = '#livrePrice' + row;
/*
        alert('Row : ' + row);
        alert('Valeur ID : ' + $(txtID).val());
        alert('Quantité : ' + $(txtQuantity).val());

        alert('Prix : ' + $(txtPrice).val());
*/
        // Si numberLivre contient plus de 3 caractère alors on commence ajax



// Ajax contenu de addPanier
        $.ajax({

            url: "addBasket.php",
            data: {number: $(txtQuantity).val(),
                    id: $(txtID).val(),
                    price: $(txtPrice).val(),

            },
            type: "POST",

            success: function (data) {
                $('#messagesRetour').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
                // En cas de récupération de data; on les affiche
                //$('#messages').html(data);          // Récupération des données du fichier php pour les afficher dans la div id messages
            },
            error: function () {
                $('#messagesRetour').html("<p class='alert alert-danger'>Une erreur est survenue !</p>");
                // En cas d'échec de récupération de data; on affiche msg d'erreur
                //$("#messages").html("<p>L'utilisateur n'existe pas !!</p>");
            }
        });

        majAjaxPanierHeader();

    }