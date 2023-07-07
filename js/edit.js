// Dichiarazione globale del listener per il pulsante "Salva"
const saveButton = document.getElementById('editSaveButton');

saveButton.addEventListener('click', function () {
    const itemId = saveButton.getAttribute('data-item-id');
    const itemType = saveButton.getAttribute('data-item-type');
    const inputName = document.getElementById('editItemName');
    const inputUrl = document.getElementById('editItemUrl');

    const newName = inputName.value;

    // Recupera il nuovo URL solo se la tipologia è "link"
    const newUrl = (itemType === 'link') ? inputUrl.value : '';

    // Crea un oggetto FormData e aggiungi i dati
    const formData = new FormData();
    formData.append('itemId', itemId);
    formData.append('newName', newName);
    formData.append('itemType', itemType);
    formData.append('newUrl', newUrl);


    // Effettua la chiamata AJAX per salvare la modifica
    $.ajax({
        url: 'php/edit.php',
        method: 'POST',
        data: formData,
        processData: false, // Disabilita l'elaborazione dei dati
        contentType: false, // Disabilita l'impostazione del tipo di contenuto
        success: function (response) {

            if (response.status == 'success') {
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

                // Aggiorna l'interfaccia con il nuovo nome
                itemName.textContent = newName;

                // Recupera l'URL dell'elemento se presente
                const itemLink = item.querySelector('a');
                if (itemLink) {
                    // Aggiorna l'URL nell'attributo href del tag <a> se presente
                    itemLink.setAttribute('href', newUrl);
                }

                // Chiudi il modale
                const editModal = bootstrap.Modal.getInstance(document.getElementById('editModal'));
                editModal.hide();
            } else {
                console.error(response.data);
            }

        },
        error: function (xhr, status, error) {
            console.error(error);
        }
    });
});

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

    // Recupera l'URL dell'elemento se presente
    const itemLink = item.querySelector('a');
    const itemUrl = itemLink ? itemLink.getAttribute('href') : '';

    // Determina la tipologia dell'elemento
    const itemType = item.getAttribute('data-attrib-type');

    // Apri il modale per la modifica
    const editModal = new bootstrap.Modal(document.getElementById('editModal'));

    // Aggiorna i valori degli input del modale
    const inputName = document.getElementById('editItemName');
    const inputUrl = document.getElementById('editItemUrl');

    // Mostra o nascondi il campo URL in base alla tipologia dell'elemento
    const editLinkUrl = document.getElementById('editLinkUrl');
    editLinkUrl.style.display = (itemType === 'link') ? 'block' : 'none';
    inputUrl.value = (itemType === 'link') ? itemUrl : '';

    // Imposta il valore del campo nome con il nome corrente
    inputName.value = currentName;

    // Imposta gli attributi personalizzati per il pulsante "Salva"
    saveButton.setAttribute('data-item-id', itemId);
    saveButton.setAttribute('data-item-type', itemType);

    // Apri il modale
    editModal.show();
}
