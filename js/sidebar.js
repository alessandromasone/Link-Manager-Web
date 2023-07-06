

document.addEventListener('DOMContentLoaded', () => {
    const sidebar = document.getElementById('sidebar');
    let startX;
    let startWidth;

    sidebar.addEventListener('mousedown', startResize);

    function startResize(e) {
        e.preventDefault();
        startX = e.clientX;
        startWidth = sidebar.offsetWidth;
        document.addEventListener('mousemove', resizeSidebar);
        document.addEventListener('mouseup', stopResize);
    }

    function resizeSidebar(e) {
        const width = startWidth + (e.clientX - startX);
        sidebar.style.width = `${width}px`;
    }

    function stopResize() {
        document.removeEventListener('mousemove', resizeSidebar);
        document.removeEventListener('mouseup', stopResize);
    }


    // Evento per gestire il clic sul pulsante per nascondere/mostrare la sidebar
    const toggleSidebarButton = document.getElementById('toggleSidebarButton');
    toggleSidebarButton.addEventListener('click', () => {
        const sidebar = document.getElementById('sidebar');
        sidebar.classList.toggle('hidden');
    });



});
