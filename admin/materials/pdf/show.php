<?php include "../../../db.php";
include "../../header.php"; ?>
<div class="row">
    <div class="col-3"></div>
    <div class="col-8">
        <table class="table">
            <thead>
                <tr><th>PDF</th></tr>
            </thead>
            <tbody>
<?php


if(isset($_GET['id'])){
    $id = $_GET['id'];
    $conn = OpenConn();
    $sql = "SELECT * FROM number_pdf JOIN pdf_paths on number_pdf.pdf_id = pdf_paths.id WHERE number_pdf.material_id = $id";
    $result = mysqli_query($conn,$sql);

    if (mysqli_num_rows($result) > 0) {
        while($row = mysqli_fetch_assoc($result)) {

            ?>
            <tr><td>
                    <a href="../../../pdfs/<?php echo $row['path'] . ".pdf"; ?>"><?php echo $row['path'] . ".pdf"; ?> </a>
                </td>
                <td>
                    <a href="delete.php?material_id=<?php echo $id; ?>&pdf_id=<?php echo $row['id']; ?>">Odstrániť</a>
                </td>
            </tr>
            <?php
        }
    }
    ?>
            </tbody>
        </table>


    <form action="add.php" class="form w-100" method="post" enctype="multipart/form-data">


        <input type="number" value="<?php echo $id; ?>" name="material_id" hidden>

        <script>
            function toggle(source) {
                var checkboxes = document.querySelectorAll('input[type="checkbox"]');
                for (var i = 0; i < checkboxes.length; i++) {
                    if (checkboxes[i] !== source)
                        checkboxes[i].checked = source.checked;
                }
            }
        </script>
        <?php
        $sql_users = "SELECT * FROM material_numbers";
        $select_users = mysqli_query($conn,$sql_users);
        if (mysqli_num_rows($select_users) > 0) {
        while($row = mysqli_fetch_assoc($select_users)) {
            ?>
        <input type="checkbox" name="numbers[]" value="<?php echo $row['id']; ?>"> <?php echo $row['number']; ?><br/>

            <?php
        }
        }

        ?>


        <input type="checkbox" onClick="toggle(this)" /> Vybrať všetky<br/>

        <select name="group" id="group">
            <option value="AA">AA</option>
            <option value="PRA">PRA</option>
            <option value="AI">AI</option>
            <option value="PP">PP</option>
            <option value="MDB">MDB</option>
            <option value="DP">DP</option>
            <option value="WA">WA</option>
            <option value="WD">WD</option>
            <option value="SL">SL</option>
        </select>
        <br>
        <input type="file"
               id="file" name="file"
        >
        <div class="">
            <button type="submit" name="add-pdf-to-material" class="btn btn-primary">Pridať</button>
        </div>
    </form>
    <?php



}
?>

    </div>
</div>