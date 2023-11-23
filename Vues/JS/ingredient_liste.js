$(document).ready(function() {
    // Fonction pour supprimer un Ingredient
    function deleteIngredient(Id_Ingredient, IngredientRow) {
        $.ajax({
            url: "./Vues/JS/undelerIngredient.php?Id_Ingredient=" + Id_Ingredient,
            type: "POST",
            success: function(data) {
                // Supprimer la ligne de l'Ingredient du tableau
                IngredientRow.remove();
            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite lors de la suppression du Ingredient: " + error);
            }
        });
    }

    // Vérifier que la bibliothèque jQuery est bien chargée
    if (typeof jQuery == 'undefined') { 
        console.log('jQuery n\'est pas chargé');
        return;
    }

    // Lorsque l'utilisateur clique sur l'icône de suppression
    $(document).on('click', '.delete-product', function(e) {
        e.preventDefault();
        var IngredientRow = $(this).closest('tr'); // Récupérer la ligne de l'Ingredient
        var Id_Ingredient = $(this).attr('data-id');
        var r = confirm("Voulez-vous vraiment supprimer cet Ingredient ?");

        if (r == true) {
            if (droit == 1) {
                deleteIngredient(Id_Ingredient, IngredientRow); // Appeler la fonction pour supprimer l'Ingredient
            } else {
                alert("Vous n'avez pas le droit de supprimer cette catégorie.");
            }
        }
    });
});

//-------------------------------------------------------- Trier --------------------------------------------------------

$(document).ready(function() {
    // Fonction pour trier le tableau
    function sortTable(table, columnIndex, ascending, numeric) {
        const rows = table.find('tbody > tr').get();
        rows.sort(function(a, b) {
            const x = $(a).find('td').eq(columnIndex).text().trim();
            const y = $(b).find('td').eq(columnIndex).text().trim();
            
            if (numeric) {
                return ascending ? parseFloat(x) - parseFloat(y) : parseFloat(y) - parseFloat(x);
            } else {
                return ascending ? x.localeCompare(y) : y.localeCompare(x);
            }
        });

        table.find('tbody').empty().append(rows);
    }
    
    // Lorsque l'utilisateur clique sur l'en-tête de colonne pour trier
    $('#myTable th.sortable').on('click', function() {
        const columnIndex = $(this).index();
        const ascending = !$(this).data('ascending');
        $(this).data('ascending', ascending);

        const numeric = $(this).hasClass('numeric');
        const table = $(this).closest('table');
        sortTable(table, columnIndex, ascending, numeric); // Appeler la fonction pour trier le tableau
    });
});
