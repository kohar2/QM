
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-pdf-to-material-modal">
    Pridať
</button>

<!-- Modal -->
<div class="modal fade" id="add-pdf-to-material-modal" tabindex="-1" aria-labelledby="add-pdf-to-material-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-pdf-to-material-label">Pridať nové materiálové číslo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="material/add.php" class="form w-100" method="post">
                    <input type="file"
                           id="file" name="file"
                    >
                    </div>
            <select name="group" id="group">
                <option value="AA">AA</option>
                <option value="PRA">PRA</option>
                <option value="AI">AI</option>
                <option value="PP">PP</option>
                <option value="MDB">MDB</option>
                <option value="DP">DP</option>
                <option value="WA">WA</option>
                <option value="WD">WD</option>
                <option value="SL">SL</option>
            </select>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                        <button type="submit" name="add-pdf-to-material" class="btn btn-primary">Pridať</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

