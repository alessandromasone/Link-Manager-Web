function clickeditbutton(itemId) {
    // Trova l'elemento HTML con l'ID specificato
    const item = document.querySelector(`[data-attrib-id="${itemId}"]`);
    if (!item) {
        console.error(`Element with ID ${itemId} not found.`);
        return;
    }

    // Recupera il nome dell'elemento dallo span
    const itemName = item.querySelector('span');
    if (!itemName) {
        console.error(`Name element not found for item with ID ${itemId}.`);
        return;
    }

    const currentName = itemName.textContent;

    // Apri il modale per la modifica
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));
    const inputName = document.getElementById('editItemName');
    inputName.value = currentName; // Imposta il valore del campo nome con il nome corrente

    // Aggiungi un evento al pulsante "Salva" del modale
    const saveButton = document.getElementById('editSaveButton');
    saveButton.addEventListener('click', function() {
        const newName = inputName.value;

        // Effettua la chiamata AJAX per salvare la modifica
        $.ajax({
            url: 'php/edit.php',
            method: 'POST',
            data: {
                itemId: itemId,
                newName: newName
            },
            success: function(response) {
                console.log(response); // Risposta dal server

                // Aggiorna l'interfaccia con il nuovo nome
                itemName.textContent = newName;

                // Chiudi il modale
                editModal.hide();
            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    });

    // Apri il modale
    editModal.show();
}
