
<div class="row justify-content-center">
    <div class="col-6">
<table class="table table-sm table-bordered table-rounded table-striped">
    <?php include "add-button.php";?>

    <thead>
    <tr>
        <th>
            Materiálové čísla
        </th>
    </thead>
    <tbody>

    <?php
    $conn = OpenConn();

    $sql_users = "SELECT * FROM number_pdf";

    $select_users = mysqli_query($conn,$sql_users);

    if (mysqli_num_rows($select_users) > 0) {
        while($row = mysqli_fetch_assoc($select_users)) {
            ?>
            <tr>
                <td><?php echo $row['material_id']?></td>
                <td><?php
                    $pdf_id = $row['pdf_id'];
                    $sql = "SELECT * FROM pdf_paths where id= $pdf_id";

                    $select = mysqli_query($conn,$sql);
                    $row = mysqli_fetch_assoc($select);

                        $path = $row['path'];
                        echo  $file_name = basename($path);

                    ?>

                    <a href=<?php echo $path ?> target="_blank"><?php echo $path ?></a>
                </td>


            </tr>
            <?php

        }
    }

    ?>

    </tbody>
</table>
    </div>
</div>