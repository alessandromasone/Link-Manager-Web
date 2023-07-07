function clickdeletebutton(itemId) {
    // Effettua la chiamata AJAX per eliminare l'elemento
    $.ajax({
        url: 'php/delete.php',
        method: 'POST',
        data: { itemId: itemId },
        success: function (response) {
            if (response.status == 'success') {
                // Rimuovi l'elemento dalla sidebar o esegui altre azioni necessarie
                const item = document.querySelector(`[data-attrib-id="${itemId}"]`);
                if (item) {
                    item.remove();
                }
            } else {
                console.error(response.data);
            }

        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
}
