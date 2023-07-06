document.addEventListener('DOMContentLoaded', () => {


    const tree = document.querySelector('.tree');
    let draggedItem = null;

    tree.addEventListener('dragstart', (event) => {
        draggedItem = event.target.closest('li');
        event.dataTransfer.effectAllowed = 'move';
        event.dataTransfer.setData('text/html', draggedItem.outerHTML);
        draggedItem.classList.add('drag-over');
    });

    tree.addEventListener('dragend', (event) => {
        draggedItem = event.target.closest('li');
        draggedItem.classList.remove('drag-over');
    });


    tree.addEventListener('dragover', (event) => {
        event.preventDefault();
        event.dataTransfer.dropEffect = 'move';
        const dropZone = event.target.closest('li');
        const dropZoneType = dropZone.getAttribute('data-attrib-type');

        if (dropZone && dropZone !== draggedItem && dropZoneType !== 'link') {
            dropZone.classList.add('drag-over');
        }
    });

    tree.addEventListener('dragleave', (event) => {
        const dropZone = event.target.closest('li');
        const dropZoneType = dropZone.getAttribute('data-attrib-type');

        if (dropZone && dropZone !== draggedItem && dropZoneType !== 'link') {
            dropZone.classList.remove('drag-over');
        }
    });

    tree.addEventListener('drop', (event) => {
        event.preventDefault();
        const dropZone = event.target.closest('li');
        const dropZoneType = dropZone.getAttribute('data-attrib-type');
    
        if (dropZone && dropZone !== draggedItem && dropZoneType !== 'link') {
            const dropZoneAncestors = getAncestors(dropZone);
            const isParent = dropZoneAncestors.includes(draggedItem);
            const isSelf = dropZone === draggedItem;
    
            if (!isParent && !isSelf) {
                dropZone.classList.remove('drag-over');
    
                const dropZoneList = dropZone.querySelector('ul');
                const sourceList = draggedItem.parentNode;
    
                draggedItem.parentNode.removeChild(draggedItem);
                dropZone.appendChild(draggedItem);
    
                // Rimuovi l'elemento <ul> vuoto dalla cartella di origine se diventa vuota dopo il trascinamento
                if (sourceList.childElementCount === 0 && sourceList.parentNode !== tree) {
                    sourceList.remove();
                }
    
                // Aggiorna il genitore dell'elemento nel database
                const itemId = draggedItem.getAttribute('data-attrib-id');
                const newParentId = dropZone.getAttribute('data-attrib-id');
                updateDatabase(itemId, newParentId);
            }
        }
    });
    
    


    function getAncestors(element) {
        const ancestors = [];
        let currentElement = element.parentElement;

        while (currentElement !== null && currentElement !== tree) {
            ancestors.push(currentElement);
            currentElement = currentElement.parentElement;
        }

        return ancestors;
    }

    function updateDatabase(itemId, newParentId) {
        // Aggiungi qui la logica per aggiornare il database con le informazioni del trascinamento
        console.log('Aggiorna database:', itemId, newParentId);
    }


});
