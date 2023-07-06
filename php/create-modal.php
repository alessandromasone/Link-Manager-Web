<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Crea un nuovo elemento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createForm">
                    <div class="mb-3">
                        <label for="itemType" class="form-label">Tipo di elemento</label>
                        <select class="form-select" id="itemType" onchange="toggleUrlInput()">
                            <option value="folder">Cartella</option>
                            <option value="link">Link</option>
                        </select>
                    </div>
                    <input type="hidden" class="form-control" id="parentId" readonly>
                    <div class="mb-3">
                        <label for="itemName" class="form-label">Nome dell'elemento</label>
                        <input type="text" class="form-control" id="itemName">
                    </div>
                    <div class="mb-3" id="urlInputContainer" style="display: none;">
                        <label for="itemUrl" class="form-label">URL</label>
                        <input type="text" class="form-control" id="itemUrl">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" onclick="createNewItem()">Crea</button>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleUrlInput() {
        const itemType = document.getElementById('itemType').value;
        const urlInputContainer = document.getElementById('urlInputContainer');

        if (itemType === 'link') {
            urlInputContainer.style.display = 'block';
        } else {
            urlInputContainer.style.display = 'none';
        }
    }
</script>