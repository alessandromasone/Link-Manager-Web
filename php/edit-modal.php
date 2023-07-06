<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Modifica elemento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm">
                    <div class="mb-3">
                        <label for="editItemName" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editItemName">
                    </div>
                    <div class="mb-3" id="editLinkUrl" style="display: none;">
                        <label for="editItemUrl" class="form-label">URL</label>
                        <input type="text" class="form-control" id="editItemUrl">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annulla</button>
                <button type="button" class="btn btn-primary" id="editSaveButton">Salva</button>
            </div>
        </div>
    </div>
</div>
