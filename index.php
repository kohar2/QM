<?php session_start(); ?>
<?php include "header.php"?>
<?php include "db.php"?>

<div class="row">
    <div class="col">
        <img src="HYDAC_ELECTRONIC.svg" alt="">
        <form action="" method="get" class="mt-2 mb-2">
            <label for="department_name">Úsek výroby</label>
            <br>
            <select id="department_name" name="department_name" onchange='this.form.submit()' >
                <option value="empty">Vyberte úsek</option>
                <?php
                global $department_name;
                $conn = OpenConn();
                $select_department = "SELECT * FROM departments";

                $select_department_result = mysqli_query($conn,$select_department);

                if (mysqli_num_rows($select_department_result) > 0) {
                    while($department = mysqli_fetch_assoc($select_department_result)) {
                        ?>
                        <option value="<?php echo $department['name']?>"
                            <?php
                            if(isset($_GET['department_name']) && $_GET['department_name'] != 'empty'){
                             echo $_GET['department_name'] == $department['name'] ? 'selected="selected"' : '';
                             }
                            ?>
                        >
                            <?php echo $department['name']?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
        </form>

        <?php
        if(isset($_GET['department_name']) && $_GET['department_name'] != 'empty') {

            $department_name = $_GET['department_name'];
            $select_department_by_id = "SELECT * FROM departments WHERE name = '$department_name'";
            $select_department_by_id_result = mysqli_query($conn,$select_department_by_id);
            $department_id = mysqli_fetch_assoc($select_department_by_id_result)['id'];


        ?>
        <form action="" class="form form-inline" method="GET" >
            <label for="linka">Výrobné linky, úsek výroby <?php echo $department_name;?> </label>
            <br>
            <select name="linka" id="linka" onchange='this.form.submit()' >
                <option value="empty">Vyberte linku</option>
                <?php
                $conn = OpenConn();
                $select_link_by_department = "SELECT * FROM links WHERE department_id = '$department_id'";

                $select_link_by_department_result = mysqli_query($conn, $select_link_by_department);

                if (mysqli_num_rows($select_link_by_department_result) > 0) {
                    while($link = mysqli_fetch_assoc($select_link_by_department_result)) {
                        ?>
                        <option value="<?php echo $link['name']?>"
                            <?php
                            if(isset($_GET['linka']) && $_GET['linka'] != 'empty'){
                                echo $_GET['linka'] == $link['name'] ? 'selected="selected"' : '';
                            }
                            ?>
                        >
                            <?php echo $link['name']?>
                        </option>
                        <?php
                    }
                }
                ?>
            </select>
            <input type="text" value="<?php echo $_GET['department_name'] ?>" name="department_name" hidden>

            <?php }
        ?>

        </form>
        <?php
        if(isset($_GET['department_name']) && $_GET['department_name'] != 'empty' && isset($_GET['linka']) && $_GET['linka'] != 'empty') {
            $linka = $_GET['linka'];
            $conn = OpenConn();
            $select_link_by_department = "SELECT * FROM links WHERE name = '$linka'";

            $select_link_by_department_result = mysqli_query($conn, $select_link_by_department);

            $row = mysqli_fetch_assoc($select_link_by_department_result);

        ?>

        <form action="" autocomplete="off" method="POST">
            <label for="material_name">Materiálové číslo pre linku <?php echo $linka; ?></label>

            <br>

            <input list="material_name" name="material_name" class="form-control" autofocus>
            <datalist id="material_name" ">
            <?php
            $conn = OpenConn();
            $edit_sql = "SELECT * FROM material_numbers WHERE link_id = $row[id]";

            $update_departments = mysqli_query($conn,$edit_sql);

            if (mysqli_num_rows($update_departments) > 0) {
                while($department = mysqli_fetch_assoc($update_departments)) {
                    ?>
                    <option value="<?php echo $department['number']?>"
                    ><?php echo $department['number']?></option>
                    <?php
                }
            }
            ?>
            </datalist>
            <div class="">
                <button type="submit" name="search" class="btn btn-primary mt-2 search">Hľadať</button>
            </div>
        </form>
        <?php
        }
        ?>
        <div class="operator mt-4">Operátor</div>
        <div class="both mt-2">Operátor + Zoraďovač</div>
        <div class="zoradovac mt-2">Zoraďovač</div>

    </div>
    <div class="col tabulka">
    <?php
        $groups = ['AI','AA','PP','SL','PRA','MDB','ZD'];
    foreach ($groups as $group){
        ?>

        <table class="table table-sm table-bordered table-rounded table-striped <?php echo $group ?>">
            <?php
            $conn = OpenConn();
            if(isset($_POST['search'])){
                $material_name =  $_POST['material_name'];
                $select_link_id = "SELECT * FROM links WHERE name = '$linka'";
                $select_link_id_result = mysqli_query($conn, $select_link_id);
                $row = mysqli_fetch_assoc($select_link_id_result);

                $sql = "SELECT * FROM material_numbers WHERE number = '$material_name' AND link_id = $row[id] AND group_name = '$group'";
                $select_numbers = mysqli_query($conn,$sql);

                ?>
                <thead>
                <tr>
                    <th>
                          <?php echo $group . " pre úsek výroby: " . $_GET['department_name'] . ", výrobná linka: " . $row['name'] . ", materiálové čislo: ".$material_name?>
                    </th>
                </thead>
                <tr>
                <?php

            if (mysqli_num_rows($select_numbers) > 0) {
                while($row = mysqli_fetch_assoc($select_numbers)) {
                    $id = $row['id'];
                    $sql2 = "SELECT * FROM pdf_paths JOIN material_numbers m on m.pdf_id = pdf_paths.id WHERE m.id = $id AND m.group_name = '$group'";

                    $result = mysqli_query($conn,$sql2);
                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {
                            ?>
            <tr>
                <td><a href="pdfs/<?php echo $group . '/Platne_dokumenty/' .$row['path']; ?>" target="_blank"><?php echo $row['path']; ?> </a></td>
            </tr>
                            <?php
                        }
                    }

                    ?>
                    <?php

                }
            }
            else{
                echo "<tr class='empty'><td>Záznam neexistuje! </tr></td>";
            }

            }
            ?>

            </tbody>
        </table>
<?php
}
?>
</div>

<?php include "footer.php"; ?>