
<div class="row justify-content-center">
    <div class="col-3">
        <form action="" class="form w-100" method="post">

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text" id="addon-wrapping">Materiálové číslo</span>
                <input list="material_name" name="material_name">
                <datalist id="material_name" ">
                <?php
                $conn = OpenConn();
                $edit_sql = "SELECT * FROM material_numbers";

                $update_departments = mysqli_query($conn,$edit_sql);

                if (mysqli_num_rows($update_departments) > 0) {
                    while($department = mysqli_fetch_assoc($update_departments)) {
                        ?>
                        <option value="<?php echo $department['number']?>"><?php echo $department['number']?></option>
                        <?php
                    }
                }
                ?>
                </datalist>
            </div>
            <div class="">
                <button type="submit" name="search" class="btn btn-primary">hladaj</button>
            </div>
    </div>


    </form>
    <div class="col-8">
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
    if(isset($_POST['search'])){
       $material_name =  $_POST['material_name'];
        $sql_users = "SELECT * FROM material_numbers WHERE number = '$material_name'";
    }
    else{
    $sql_users = "SELECT * FROM material_numbers";
    }
    $select_users = mysqli_query($conn,$sql_users);

    if (mysqli_num_rows($select_users) > 0) {
        while($row = mysqli_fetch_assoc($select_users)) {
            ?>
            <tr>
                <td><a href="materials/material/show.php?id=<?php echo $row['id']?>"> <?php echo $row['number']?></a></td>
            </tr>

            <?php

        }
    }

    ?>

    </tbody>
</table>
    </div>
</div>

<div class="row justify-content-center">
    <div class="col-3">
        <form action="" class="form w-100" method="post">

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text" id="addon-wrapping">Materiálové číslo</span>
                <input list="pdf_name" name="pdf_name">
                <datalist id="pdf_name" ">
                <?php
                $conn = OpenConn();
                $sql = "SELECT * FROM pdf_paths";

                $update_departments = mysqli_query($conn,$sql);

                if (mysqli_num_rows($update_departments) > 0) {
                    while($department = mysqli_fetch_assoc($update_departments)) {
                        ?>
                        <option value="<?php echo $department['path']?>"><?php echo $department['path']?></option>
                        <?php
                    }
                }
                ?>
                </datalist>
            </div>
            <div class="">
                <button type="submit" name="search_pdf" class="btn btn-primary">hladaj</button>
            </div>
    </div>


    </form>
    <div class="col-8">
        <table class="table table-sm table-bordered table-rounded table-striped">
            <?php include "add-button.php";?>

            <thead>
            <tr>
                <th>
                    PDF
                </th>
            </thead>
            <tbody>

            <?php
            $conn = OpenConn();
            if(isset($_POST['search_pdf'])){
                $pdf_name =  $_POST['pdf_name'];
                $sql_users = "SELECT * FROM pdf_paths WHERE path = '$pdf_name'";
            }
            else{
                $sql_users = "SELECT * FROM pdf_paths";
            }
            $select_users = mysqli_query($conn,$sql_users);

            if (mysqli_num_rows($select_users) > 0) {
                while($row = mysqli_fetch_assoc($select_users)) {
                    ?>
                    <tr>
                        <td><a href="materials/pdf/show.php?id=<?php echo $row['id']?>"> <?php echo $row['path']?></a></td>
                    </tr>

                    <?php

                }
            }

            ?>

            </tbody>
        </table>
    </div>
</div>
</div>