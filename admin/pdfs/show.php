<?php include "../header.php"; ?>
<?php require_once "../../db.php"; ?>
<?php
if (isset($_GET['link_id'])) {
    $link_id = $_GET['link_id'];
    $department_id = $_GET['department_id'];
    $conn = OpenConn();
    $sql = "SELECT * FROM links WHERE id = '$link_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo "<h1 class='ms-5'>PDF pre linku: " . $row['name'] . "</h1>";
    }


    $select_groups = "SELECT * FROM groups";
    $select_groups_result = mysqli_query($conn, $select_groups);
    ?>
    <div class="mx-2">
        <?php if (mysqli_num_rows($select_groups_result) > 0) {
            while ($row = mysqli_fetch_assoc($select_groups_result)) {
                $group_name = $row['name'];
                $group_id = $row['id'];
                ?>
                    <div class="border mb-2 border-danger border-2">
                <table class="table table-sm table-bordered table-rounded table-striped">
                    <thead>
                    <tr>
                        <th> <?php echo $group_name ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $select_pdf_for_link = "SELECT * FROM pdf_paths p WHERE link_id = $link_id AND p.group_name = '$group_name'";
                    $select_pdf_for_link_result = mysqli_query($conn, $select_pdf_for_link);
                    if (mysqli_num_rows($select_pdf_for_link_result) > 0) {
                        while ($row = mysqli_fetch_assoc($select_pdf_for_link_result)) {
                            $pdf_path = $row['path'];
                            $pdf_id = $row['id'];
                            ?>
                            <tr>
                                <td class="col-2">
                                    <a href="../../pdfs/<?php echo $group_name ?>/Platne_dokumenty/<?php echo $pdf_path ?>"><?php echo $pdf_path ?></a>
                                </td>
                                <td class="col-9">
                                    <?php
                                    $select_material_numbers = "SELECT * FROM material_numbers m WHERE pdf_id=$pdf_id AND link_id=$link_id AND m.group_name='$group_name'";
                                    $select_material_numbers_result = mysqli_query($conn, $select_material_numbers);
                                    if (mysqli_num_rows($select_material_numbers_result) > 0) {
                                        while ($row = mysqli_fetch_assoc($select_material_numbers_result)) {
                                            echo $row['number'] . " / ";
                                        }
                                    }

                                    ?>
                                </td>
                                <td class="col-1">
                                    <a href="edit.php?department_id=<?php echo $department_id?>&link_id=<?php echo $link_id ?>&pdf_id=<?php echo $pdf_id ?>&group_name=<?php echo $group_name?>">Upravit</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    ?>

                    </tbody>
                </table>
                <form action="add-pdf.php" class="mb-2 ms-2 " method="post">

                    <?php
                    $dir = "../../pdfs/" . $group_name . "/Platne_dokumenty/";
                    if (is_dir($dir)) {
                        $files = scandir($dir); // get all files in directory
                        $files = array_diff($files, array('.', '..')); // remove . and ..
                        ?>
                        <select name="pdf_path" id="">
                            <?php
                            foreach ($files as $file) {
                                ?>

                                <option value="<?php echo $file ?>"><?php echo $file ?></option>
                                <?php
                            }
                            ?>
                        </select>

                        <?php
                    }
                    ?>
                    <input type="hidden" name="link_id" value="<?php echo $link_id ?>">
                    <input type="hidden" name="group_name" value="<?php echo $group_name ?>">
                    <input type="hidden" name="department_id" value="<?php echo $department_id ?>">

                    <input type="submit" name="submit" class="btn btn-success ms-3"
                           value="Pridať PDF do skupiny: <?php echo $group_name ?>">
                 </form>
                    </div>
                <?php

            }
        } ?>

    </div>
    <?php
}
?>