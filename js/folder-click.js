document.addEventListener('DOMContentLoaded', () => {
    const tree = document.querySelector('.tree');

    tree.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const target = event.target;
        const listItem = target.closest('li');

        if (listItem) {
            const folderIcon = listItem.querySelector('.folder-icon');

            if (folderIcon && folderIcon === target) {
                const childList = listItem.querySelector('ul');

                if (childList) {
                    if (childList.style.display === 'none') {
                        // Se la lista dei figli è nascosta, mostra la lista e aggiorna l'icona della cartella
                        childList.style.display = 'block';
                        folderIcon.classList.remove('fa-folder');
                        folderIcon.classList.add('fa-folder-open');
                    } else {
                        // Se la lista dei figli è visibile, nascondi la lista e aggiorna l'icona della cartella
                        childList.style.display = 'none';
                        folderIcon.classList.remove('fa-folder-open');
                        folderIcon.classList.add('fa-folder');
                    }
                }
            }
        }
    });
});
