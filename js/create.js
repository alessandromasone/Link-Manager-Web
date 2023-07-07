function toggleUrlInput() {
    // Ottieni il valore del tipo di elemento selezionato
    const itemType = document.getElementById('create-itemType').value;

    // Ottieni il riferimento al container dell'input URL
    const urlInputContainer = document.getElementById('create-urlInputContainer');

    // Verifica il tipo di elemento selezionato
    if (itemType === 'link') {
        // Se il tipo di elemento è 'link', mostra il container dell'input URL
        urlInputContainer.style.display = 'block';
    } else {
        // Altrimenti, nascondi il container dell'input URL
        urlInputContainer.style.display = 'none';
    }
}

function clickaddbutton(parentId) {

    toggleUrlInput();
    // Pulisci i valori del form del modal
    document.getElementById('create-itemName').value = '';
    document.getElementById('create-itemUrl').value = '';
    document.getElementById('create-parentId').value = '';

    // Imposta l'ID del genitore nel campo nascosto del modal
    document.getElementById('create-parentId').value = parentId;

    // Apri il modal utilizzando il metodo show() di Bootstrap
    const createModal = new bootstrap.Modal(document.getElementById('createModal'));
    createModal.show();
}

function createNewItem() {
    // Recupera i valori dal form del modal
    const itemType = document.getElementById('create-itemType').value;
    const parentId = document.getElementById('create-parentId').value;
    const itemName = document.getElementById('create-itemName').value;
    const itemUrl = document.getElementById('create-itemUrl').value;

    // Esegui la logica di salvataggio e aggiunta dell'elemento
    if (itemName.trim() !== '') {
        // Crea un oggetto FormData per inviare i dati al server
        const formData = new FormData();
        formData.append('itemName', itemName);
        formData.append('parentId', parentId);
        formData.append('itemUrl', (itemType === 'link') ? itemUrl : '');

        // Effettua la chiamata AJAX per aggiungere l'elemento
        $.ajax({
            url: 'php/create.php?' + itemType,
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {

                if (response.status == 'success') {
                    const parentElement = document.querySelector(`[data-attrib-id="${parentId}"]`);
                    let childList = parentElement.querySelector('ul');

                    // Se l'elemento <ul> non è presente, crealo e aggiungilo all'elemento genitore
                    if (!childList) {
                        childList = document.createElement('ul');
                        parentElement.appendChild(childList);
                    }

                    childList.insertAdjacentHTML('beforeend', response.data);

                    // Chiudi il modal
                    const createModal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                    createModal.hide();
                } else {
                    console.error(response.data);
                }

            },
            error: function (xhr, status, error) {
                console.error(error);
            }
        });
    }
}
