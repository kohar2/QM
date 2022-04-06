
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-material-modal">
    Pridať
</button>

<!-- Modal -->
<div class="modal fade" id="add-material-modal" tabindex="-1" aria-labelledby="add-material-label" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1400px">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="add-material-label">Pridať nové materiálové číslo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="material-to-pdf/add.php" class="form w-100" method="post">

                    <div class="input-group flex-nowrap mb-2">
                        <span class="input-group-text" id="addon-wrapping">Materiálové číslo</span>
                        <input list="material_id" name="material_id">
                        <datalist id="material_id" ">

                            <?php
                            $conn = OpenConn();
                            $edit_sql = "SELECT * FROM material_numbers";

                            $update_departments = mysqli_query($conn,$edit_sql);

                            if (mysqli_num_rows($update_departments) > 0) {
                                while($department = mysqli_fetch_assoc($update_departments)) {
                                    ?>
                                    <option value="<?php echo $department['id']?>"><?php echo $department['number']?></option>

                                    <?php

                                }
                            }
                            ?>

                        </datalist>
                    </div>

                    <div class="input-group flex-nowrap mb-2">
                        <span class="input-group-text" id="addon-wrapping">Cesta k pdf</span>
                        <select name="pdf_id" id="user-department">
                            <?php
                            $edit_sql = "SELECT * FROM pdf_paths";

                            $update_departments = mysqli_query($conn,$edit_sql);

                            if (mysqli_num_rows($update_departments) > 0) {
                                while($department = mysqli_fetch_assoc($update_departments)) {
                                    ?>
                                    <option value="<?php echo $department['id']?>"><?php echo $department['path']?></option>

                                    <?php

                                }
                            }
                            ?>
                        </select>
                    </div>

                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                        <button type="submit" name="add-material-to-pdf" class="btn btn-primary">Pridať</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

