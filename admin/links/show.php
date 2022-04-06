<div class="row justify-content-center">
    <div class="col-3">
        <form action="" class="form w-100" method="post">

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text" id="addon-wrapping">Linky</span>
                <input list="material_name" name="material_name">
                <datalist id="material_name" ">
                <?php
                $conn = OpenConn();
                $edit_sql = "SELECT * FROM links";

                $update_departments = mysqli_query($conn,$edit_sql);

                if (mysqli_num_rows($update_departments) > 0) {
                    while($department = mysqli_fetch_assoc($update_departments)) {
                        ?>
                        <option value="<?php echo $department['name']?>"><?php echo $department['name']?></option>
                        <?php
                    }
                }
                ?>
                </datalist>
            </div>
            <div class="">
                <button type="submit" name="search" class="btn btn-primary">Hľadaj</button>
            </div>
    </div>


    </form>
    <div class="col-8">
        <table class="table table-sm table-bordered table-rounded table-striped">
            <?php include "add-button.php";?>

            <thead>
            <tr>
                <th>
                    Linky
                </th>
            </thead>
            <tbody>

            <?php
            $conn = OpenConn();
            if(isset($_POST['search'])){
                $material_name =  $_POST['material_name'];
                if ($material_name == "") {
                    $sql_users = "SELECT * FROM links";
                }else {
                    $sql_users = "SELECT * FROM links WHERE name = '$material_name'";
                }
            }
            else{
                $sql_users = "SELECT * FROM links";
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
