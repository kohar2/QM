<?php include "../../../db.php";
include "../../header.php"; ?>

<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = OpenConn();
    $sql = "SELECT * FROM number_pdf JOIN pdf_paths on number_pdf.pdf_id = pdf_paths.id WHERE number_pdf.material_id = $id";
    $result = mysqli_query($conn,$sql);
    $select_material = "SELECT * FROM material_numbers WHERE id = $id";
    $result_material = mysqli_query($conn,$select_material);
    $row_material = mysqli_fetch_assoc($result_material);
    $material_name = $row_material['number'];

    ?>
<div class="row">
    <div class="col-3"></div>
    <div class="col-8">
        <table class="table">
            <thead>
            <tr>
                <th>
                    <div class="row">
                       <div class="col"><h3> PDF </h3> </div>
                        <div class="col"><h2><?php echo $material_name; ?></h2></div>
                    </div>
                </th>
            </tr>
            </thead>
            <tbody>

    <?php
    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            ?>
            <tr><td>
                    <a href="../../../pdfs/<?php echo $row['path'] . ".pdf"; ?>"><?php echo $row['path'] . ".pdf"; ?> </a>
                </td>
                <td>
                    <a href="delete.php?material_id=<?php echo $id; ?>&pdf_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-danger">Odstrániť</a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
            </tbody>
        </table>
    <?php



}
?>

    </div>
</div>