<?php
include "../../../db.php";
if(isset($_POST['add-pdf-to-material'])){
    $material_id = $_POST['material_id'];
    $group = $_POST['group'];
    $conn = OpenConn();



    if (($_FILES['file']['name']!="")){
// Where the file is going to be stored

        $target_dir = "../../../pdfs/";
        $file = $_FILES['file']['name'];
        $path = pathinfo($file);
        $filename = $path['filename'];
        $ext = $path['extension'];
        $temp_name = $_FILES['file']['tmp_name'];
        $path_filename_ext = $target_dir.$filename.".".$ext;

// Check if file already exists
        if (file_exists($path_filename_ext)) {
            $sql = "SELECT * FROM pdf_paths WHERE path = '$filename'";

            $result = mysqli_query($conn,$sql);
            $row = mysqli_fetch_assoc($result);
            $id = $row['id'];

            $stmt3 = $conn->prepare("INSERT INTO number_pdf(material_id,pdf_id,group_name) VALUES (?,?,?)");
            $stmt3->bind_param('iis',$material_id,$id, $group);
            $stmt3->execute();

        }else{
            move_uploaded_file($temp_name,$path_filename_ext);
            echo "Congratulations! File Uploaded Successfully.";
            $stmt3 = $conn->prepare("INSERT INTO pdf_paths(path) VALUES (?)");
            $stmt3->bind_param('s',$filename);
            $stmt3->execute();
            $id = $conn->insert_id;
            $stmt3 = $conn->prepare("INSERT INTO number_pdf(material_id,pdf_id,group_name) VALUES (?,?,?)");
            $stmt3->bind_param('iis',$material_id,$id,$group);
            $stmt3->execute();

        }
    }

    header('location:show.php?id=' . $material_id);
}
else{
    ?>

<?php } ?>