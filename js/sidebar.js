document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    const border = document.getElementById('sidebar-border');
    let startX;
    let startWidth;

    // Gestore di eventi per iniziare il ridimensionamento della sidebar
    border.addEventListener('mousedown', startResize);

    function startResize(e) {
        e.preventDefault();
        startX = e.clientX;
        startWidth = sidebar.offsetWidth;
        document.addEventListener('mousemove', resizeSidebar);
        document.addEventListener('mouseup', stopResize);
    }

    function resizeSidebar(e) {
        // Calcola la nuova larghezza della sidebar in base allo spostamento del mouse
        const width = startWidth + (e.clientX - startX);
        sidebar.style.width = `${width}px`;
    }

    function stopResize() {
        // Rimuove i gestori di eventi per il ridimensionamento della sidebar
        document.removeEventListener('mousemove', resizeSidebar);
        document.removeEventListener('mouseup', stopResize);
    }

    // Gestore di eventi per nascondere/mostrare la sidebar
    const toggleSidebarButton = document.getElementById('toggleSidebarButton');
    toggleSidebarButton.addEventListener('click', () => {
        sidebar.classList.toggle('hidden');
    });
});
