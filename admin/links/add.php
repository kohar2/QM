<?php

include "../../db.php";

if(isset($_POST['add-link'])){

    $department_id = $_POST['department_id'];
    $link_name = $_POST['link_name'];
    $conn = OpenConn();

    $stmt = $conn->prepare("INSERT INTO links(name,department_id) VALUES (?,?)");
    $stmt->bind_param('ss',$link_name,$department_id);
    $stmt->execute();

    CloseConn($conn);

    header('location:../department/show.php?department_id='.$department_id);
}
else{
    ?>

<?php } ?>