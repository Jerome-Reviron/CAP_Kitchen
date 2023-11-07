$(document).ready(function() {
    // Fonction pour supprimer un Admin
    function deleteAdmin(Id_Admin, AdminRow) {
        $.ajax({
            url: "./Vues/JS/undelerAdmin.php?Id_Admin=" + Id_Admin,
            type: "POST",
            success: function(data) {
                // Supprimer la ligne de l'admin du tableau
                AdminRow.remove();
            },
            error: function(xhr, status, error) {
                console.log("Une erreur s'est produite lors de la suppression du Admin: " + error);
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
        var AdminRow = $(this).closest('tr'); // Récupérer la ligne de l'admin
        var Id_Admin = $(this).attr('data-id');
        var r = confirm("Voulez-vous vraiment supprimer cet Admin ?");

        if (r == true) {
            deleteAdmin(Id_Admin, AdminRow); // Appeler la fonction pour supprimer l'Admin
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
