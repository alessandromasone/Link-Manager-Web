function clickaddbutton(parentId) {
    // Imposta l'ID del genitore nel campo nascosto del modal
    document.getElementById('parentId').value = parentId;

    // Apri il modal utilizzando il metodo show() di Bootstrap
    const createModal = new bootstrap.Modal(document.getElementById('createModal'));
    createModal.show();
}



function createNewItem() {
    // Recupera i valori dal form del modal
    const itemType = document.getElementById('itemType').value;
    const parentId = document.getElementById('parentId').value;
    const itemName = document.getElementById('itemName').value;

    // Esegui la logica di salvataggio e aggiunta dell'elemento
    if (itemName.trim() !== '') {

        $.ajax({
            url: 'php/create.php?' + itemType,
            method: 'POST',
            data: {
                folderName: itemName,
                parentId: parentId // Passa l'ID del genitore al server
            },
            success: function(response) {
                console.log("R: " + response);
                const parentElement = document.querySelector(`[data-attrib-id="${parentId}"]`);
                let childList = parentElement.querySelector('ul');

                // Se l'elemento <ul> non è presente, crealo e aggiungilo all'elemento genitore
                if (!childList) {
                    childList = document.createElement('ul');
                    parentElement.appendChild(childList);
                }
                console.log(parentElement);
                childList.insertAdjacentHTML('beforeend', response);

                // Chiudi il modal
                const createModal = bootstrap.Modal.getInstance(document.getElementById('createModal'));
                createModal.hide();

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }
}