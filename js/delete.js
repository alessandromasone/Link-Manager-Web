function clickdeletebutton(itemId) {
    // Effettua la chiamata AJAX per eliminare l'elemento
    $.ajax({
        url: 'php/delete.php',
        method: 'POST',
        data: {
            itemId: itemId
        },
        success: function(response) {
            console.log(response); // Risposta dal server

            // Rimuovi l'elemento dalla sidebar o esegui altre azioni necessarie
            const item = document.querySelector(`[data-attrib-id="${itemId}"]`);
            if (item) {
                item.remove();
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
        }
    });
}
