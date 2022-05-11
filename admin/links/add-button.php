
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#add-link-modal">
    Pridať linku
</button>

<!-- Modal -->
<div class="modal fade" id="add-link-modal" tabindex="-1" aria-labelledby="add-link-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-link-label">Pridať novú linku</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/QM/admin/links/add.php" class="form w-100" method="POST">
                    <?php
                    if(isset($_GET['department_id'])) {
                        echo '<input type="hidden" name="department_id" value="'.$_GET['department_id'].'">';
                    }
                    ?>
                    <div class="input-group flex-nowrap mb-2">
                        <span class="input-group-text" id="addon-wrapping">Názov linky</span>
                        <input list="link_name" name="link_name">

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                        <button type="submit" name="add-link" class="btn btn-primary">Pridať</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

