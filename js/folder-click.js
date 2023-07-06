document.addEventListener('DOMContentLoaded', () => {
    const tree = document.querySelector('.tree');

    tree.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const target = event.target;
        const listItem = target.closest('li');

        if (listItem) {
            const folderIcon = listItem.querySelector('.folder-icon');
            const addIcon = listItem.querySelector('.add-icon');
            const deleteIcon = listItem.querySelector('.delete-icon');

            if (folderIcon && folderIcon === target) {
                const childList = listItem.querySelector('ul');

                if (childList) {
                    if (childList.style.display === 'none') {
                        childList.style.display = 'block';
                        folderIcon.classList.remove('fa-folder');
                        folderIcon.classList.add('fa-folder-open');
                    } else {
                        childList.style.display = 'none';
                        folderIcon.classList.remove('fa-folder-open');
                        folderIcon.classList.add('fa-folder');
                    }
                }
            } else if (addIcon && addIcon === target) {
                const folderId = listItem.dataset.attribId;
                console.log('Aggiungi elemento:', folderId);
                // Aggiungi qui la logica per aggiungere un elemento
            } else if (deleteIcon && deleteIcon === target) {
                const folderId = listItem.dataset.attribId;
                console.log('Elimina elemento:', folderId);
                // Aggiungi qui la logica per eliminare un elemento
            } else {
                const folderName = listItem.querySelector('.folder-name');
                const selectedItem = document.querySelector('.selected');

                if (selectedItem) {
                    selectedItem.classList.remove('selected');
                }

                listItem.classList.add('selected');
            }
        }
    });




});
