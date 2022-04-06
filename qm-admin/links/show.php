<div class="row">
    <div class="col-3">
        <?php include "search.php";?>
    </div>

    <div class="col-8">
        <table class="table table-sm table-bordered table-rounded table-striped">
            <thead>
            <tr>
                <th>
                    Linky
                </th>
            </thead>
            <tbody>

            <?php
            $conn = OpenConn();
            if(!isset($_POST['search'])) {
                $sql_users = "SELECT * FROM links";
            }
            else {
                $material_name = $_POST['material_name'];
                if ($material_name != "") {
                    $sql_users = "SELECT * FROM links WHERE name = '$material_name'";
                } else {
                    $sql_users = "SELECT * FROM links";
                }
            }
            $select_users = mysqli_query($conn,$sql_users);






            if (mysqli_num_rows($select_users) > 0) {
                while($row = mysqli_fetch_assoc($select_users)) {
                    ?>
                    <tr>
                        <td><a href="links/link/show.php?id=<?php echo $row['id']?>"> <?php echo $row['name']?></a></td>
                        <td><a href="materials/material/show.php?id=<?php echo $row['id'];?>" class="btn btn-sm btn-danger">Odstrániť</a></td>

                    </tr>

                    <?php

                }
            }

            ?>

            </tbody>
        </table>

        <a class="btn btn-primary" href="links/bulk-pdf.php">Pridať PDF k Linkám</a>
    </div>
</div>
