<?php
include "../../../db.php";

if(isset($_GET['id'])){

    $conn = OpenConn();
    $material_id = $_GET['id'];
    $link_id = $_GET['link_id'];

    $stmt3 = $conn->prepare("DELETE FROM material_numbers WHERE id = ?");
    $stmt3->bind_param('i',$material_id);
    $stmt3->execute();

    $stmt3 = $conn->prepare("DELETE FROM number_pdf WHERE material_id = ?");
    $stmt3->bind_param('i',$material_id);
    $stmt3->execute();


    header("location:show.php?id=$link_id");
}

?>