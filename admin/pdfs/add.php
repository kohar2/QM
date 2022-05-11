<?php include "../header.php"?>
<?php require_once "../../db.php"; ?>
<form action="" class="mx-2">
    <textarea name="" id="" cols="100" rows="30"><?php
        if(isset($_GET['pdf_id'])){
            $pdf_id = $_GET['pdf_id'];
        $conn = OpenConn();
        $select_pdf = "SELECT * FROM pdf_paths p WHERE p.id = $pdf_id";
        $sql_pdfs_result = mysqli_query($conn,$select_pdf);
        if (mysqli_num_rows($sql_pdfs_result) > 0) {
            while($row = mysqli_fetch_assoc($sql_pdfs_result)) {
                $select_material_numbers = "SELECT distinct(number) FROM material_numbers JOIN number_pdf ON material_numbers.id = number_pdf.material_id
                                                        JOIN pdf_paths on number_pdf.pdf_id = $row[id] ORDER BY number ASC";
                $select_material_numbers_result = mysqli_query($conn,$select_material_numbers);
                if (mysqli_num_rows($select_material_numbers_result) > 0) {
                    while($row_material_numbers = mysqli_fetch_assoc($select_material_numbers_result)) {
                        echo $row_material_numbers['number'];
                        echo "\n";
                    }
                }
                ?>
                <?php
            }
        }
        }
        ?>
    </textarea>
</form>
