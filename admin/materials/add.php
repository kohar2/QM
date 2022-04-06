<?php
include "../../db.php";
if(isset($_POST['add-material'])){
    $name = $_POST['number'];
    $id = $_POST['link_id'];
    var_dump($id);
    die();
    $conn = OpenConn();

    $stmt3 = $conn->prepare("INSERT INTO material_numbers(number,link_id) VALUES (?,?)");
    $stmt3->bind_param('si',$name,$id);
    $stmt3->execute();
    CloseConn($conn);

    header('location:../materials.php');
}
else{
    ?>

<?php } ?>