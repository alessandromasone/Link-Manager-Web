document.addEventListener('DOMContentLoaded', () => {
    const tree = document.querySelector('.tree');

    // Rimuovi la classe "hover" da tutti gli elementi quando si passa il mouse fuori dall'albero
    tree.addEventListener('mouseout', () => {
        const hoveredItems = document.querySelectorAll('.hover');
        hoveredItems.forEach((item) => {
            item.classList.remove('hover');
        });
    });

    // Evidenzia la voce quando si passa il mouse sopra di essa
    tree.addEventListener('mouseover', (event) => {
        const target = event.target;
        if (target.tagName === 'SPAN') {
            const listItem = target.closest('li');
            if (listItem) {
                listItem.classList.add('hover');
            }
        }
    });

    // Seleziona la voce quando si fa clic su di essa
    tree.addEventListener('click', (event) => {
        event.preventDefault();
        event.stopPropagation();

        const target = event.target;
        if (target.tagName === 'SPAN') {
            const listItem = target.closest('li');
            const selectedItem = document.querySelector('.selected');

            if (selectedItem === listItem) {
                listItem.classList.remove('selected');
            } else {
                if (selectedItem) {
                    selectedItem.classList.remove('selected');
                }
                listItem.classList.add('selected');
            }
        }
    });
});
