<?php
include "../../header.php";
include "../../../db.php";
if(isset($_POST['add-material'])){
    $name = $_POST['number'];
    print_r($name);
    $conn = OpenConn();

    $id = $_POST['link_id'];
    $split = explode(" ", $name);

    print_r($split);
    die();
    foreach ($split as $key => $value) {
        $split[$key] = strtolower($value);
        $stmt3 = $conn->prepare("INSERT INTO material_numbers(number,link_id) VALUES (?,?)");
        $stmt3->bind_param('si',$value,$id);
        $stmt3->execute();

    }

    CloseConn($conn);

    header('location:show.php?id=' . $id);
}
else{
    ?>

<?php } ?>

<div class="row justify-content-center">
    <div class="col-3">
        <form action="" class="form w-100" method="post">

            <div class="input-group flex-nowrap mb-2">
                <span class="input-group-text" id="addon-wrapping">Materiálové čislo</span>
                <input list="material_name" name="material_name">
                <datalist id="material_name" ">
                <?php
                $conn = OpenConn();
                $edit_sql = "SELECT * FROM material_numbers WHERE  id = '" . $_GET['id'] . "'";
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

    <div class="col-8">
        <table class="table table-sm table-rounded table-striped ">
            <thead>
            <tr>
                <th>Materiálové čisla</th>
            </tr>
            </thead>
            <div class="row">
            <?php
            if(isset($_GET['id'])){
                $id = $_GET['id'];
                $link_id = $_GET['id'];
                ?>
                <div class="col-5">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-material-modal">
                    Pridať nové materiálové číslo
                </button>

                <!-- Modal -->
                <div class="modal fade" id="add-material-modal" tabindex="-1" aria-labelledby="add-material-label" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="add-material-label">Pridať nové materiálové číslo</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="" class="form w-100" method="post">

                                    <div class="input-group flex-nowrap mb-2">
                                        <span class="input-group-text" id="addon-wrapping">Materiálové číslo</span>
                                        <textarea type="textarea" class="form-control" name="number"></textarea>
                                    </div>
                                    <input type="text" value="<?php echo $id ?>" name="link_id" hidden>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Zatvoriť</button>
                                        <button type="submit" name="add-material" class="btn btn-primary">Pridať</button>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>
                </div>
                </div>
                <div class="col-3">
                <?php
                $link_sql = "SELECT * FROM links WHERE id = '" . $_GET['id'] . "'";
                $select_link = mysqli_query($conn,$link_sql);
                $row = mysqli_fetch_assoc($select_link);
                echo '<h1>Linka: ' . $row['name'] . '</h1>';

                ?>
                </div>
            </div>

                <?php
                $conn = OpenConn();
                if(isset($_POST['search']) && $_POST['material_name'] != "" && $_POST['material_name'] != null){
                    $stmt = $conn->prepare("SELECT * from material_numbers WHERE link_id = ? AND number = ?");
                    $stmt->bind_param("ii",$id,$_POST['material_name']);

                }else {
                    $stmt = $conn->prepare("SELECT * from material_numbers WHERE link_id = ?");
                    $stmt->bind_param("i",$id);

                }
                $stmt->execute();

                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <tr>
                        <td><a href="/qm/admin/materials/material/show.php?id=<?php echo $row['id'];?>"><?php echo $row['number']; ?></a></td>
                        <td><a href="/qm/admin/links/link/delete.php?id=<?php echo $row['id'];?>&link_id=<?php echo $link_id; ?>" class="btn btn-sm btn-danger">Odstrániť</a></td>
                    </tr>
                    <?php
                }
            }
            ?>
            </tbody>
        </table>
        <a class="btn btn-primary" href="../add-bulk-pdf-to-links.php?link_id=<?php echo $id; ?>">Pridať PDF k Materiálovým číslam</a>

    </div>
</div>