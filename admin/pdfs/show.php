<?php include "../../db.php"?>
<div class="row justify-content-center">
    <div class="col-6">
<table class="table table-sm table-bordered table-rounded table-striped">
    <?php include "add-button.php";?>

    <thead>
    <tr>
        <th>
            Cesta
        </th>
    </thead>
    <tbody>

    <?php
    $conn = OpenConn();

    $sql_users = "SELECT * FROM pdf_paths";

    $select_users = mysqli_query($conn,$sql_users);

    if (mysqli_num_rows($select_users) > 0) {
        while($row = mysqli_fetch_assoc($select_users)) {
            ?>
            <tr>
                <td><?php echo $row['path']?></td>
            </tr>

            <?php

        }
    }

    ?>

    </tbody>
</table>
    </div>
</div>