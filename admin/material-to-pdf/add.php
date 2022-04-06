<?php
include "../../db.php";
if(isset($_POST['add-material-to-pdf'])){
    $material_id = $_POST['material_id'];
    $pdf_id = $_POST['pdf_id'];

    $conn = OpenConn();

    $stmt3 = $conn->prepare("INSERT INTO number_pdf(material_id,pdf_id) VALUES (?,?)");
    $stmt3->bind_param('ii',$material_id,$pdf_id);
    $stmt3->execute();

    CloseConn($conn);

    header('location:../material-to-pdf.php');
}
else{
    ?>

<?php } ?>