
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#add-path-modal">
    Upraviť
</button>

<!-- Modal -->
<div class="modal fade" id="add-path-modal" tabindex="-1" aria-labelledby="add-path-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-path-label">Pridať novú cestu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="pdfs/add.php" class="form w-100" method="post" enctype="multipart/form-data">

                    <div class="input-group flex-nowrap mb-2">
                        <span class="input-group-text" id="addon-wrapping">Cesta k pdf</span>
                        <input type="text" class="form-control" name="path">
                    </div>

                    <input type="file"
                           id="file" name="file"
                    >
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                        <button type="submit" name="add-path" class="btn btn-primary">Pridať</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

