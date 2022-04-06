<?php
include "../../../db.php";

if(isset($_GET['material_id']) and isset($_GET['pdf_id'])){

    $conn = OpenConn();
    $material_id = $_GET['material_id'];
    $pdf_id = $_GET['pdf_id'];

    $stmt3 = $conn->prepare("DELETE FROM number_pdf WHERE material_id = ? AND pdf_id = ?");
    $stmt3->bind_param('ii',$material_id,$pdf_id);
    $stmt3->execute();
    header("location:show.php?id=$material_id");
}

?>