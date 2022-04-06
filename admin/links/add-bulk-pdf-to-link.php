<?php
include "../../db.php";
if(isset($_POST['add-bulk-pdf-to-links'])) {
    $links = $_POST['links'];
    $link_id = $_POST['link_id'];
    $conn = OpenConn();
    $group_name = $_POST['group_name'];
    foreach ($links as $link) {
        $sql = "SELECT * FROM material_numbers WHERE id = $link";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $material_id = $row['id'];

            if (($_FILES['file']['name'] != "")) {

                $target_dir = "../../pdfs/";
                $file = $_FILES['file']['name'];
                $path = pathinfo($file);
                $filename = $path['filename'];
                $ext = $path['extension'];
                $temp_name = $_FILES['file']['tmp_name'];
                $path_filename_ext = $target_dir . $filename . "." . $ext;
                if (file_exists($path_filename_ext)) {
                    $sql = "SELECT * FROM pdf_paths WHERE path = '$filename'";

                    $results = mysqli_query($conn, $sql);
                    while($rows = mysqli_fetch_assoc($results)) {

                        $id = $rows['id'];

                        $stmt3 = $conn->prepare("INSERT INTO number_pdf(material_id,pdf_id,group_name) VALUES (?,?,?)");
                        $stmt3->bind_param('iis', $material_id, $id, $group_name);
                        $stmt3->execute();
                    }
                } else {
                    move_uploaded_file($temp_name, $path_filename_ext);
                    $stmt3 = $conn->prepare("INSERT INTO pdf_paths(path) VALUES (?)");
                    $stmt3->bind_param('s', $filename);
                    $stmt3->execute();
                    $id = $conn->insert_id;
                    $stmt3 = $conn->prepare("INSERT INTO number_pdf(material_id,pdf_id,group_name) VALUES (?,?,?)");
                    $stmt3->bind_param('iis', $material_id, $id, $group_name);
                    $stmt3->execute();

                }
            }
        }
    }
    header("Location:../../admin/links/add-bulk-pdf-to-links.php?link_id=$link_id");
}
?>