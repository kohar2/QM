<?php
include "../../db.php";
if(isset($_POST['add-link'])){
    $name = $_POST['link_name'];
    $conn = OpenConn();

    $stmt = $conn->prepare("INSERT INTO links(name) VALUES (?)");
    $stmt->bind_param('s',$name);
    $stmt->execute();

    CloseConn($conn);

    header('location:../index.php');
}
else{
    ?>

<?php } ?>