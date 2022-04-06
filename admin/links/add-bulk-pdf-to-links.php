<?php include "../header.php"?>
<?php include "../../db.php"?>
<?php
if(isset($_GET['link_id'])){
    $link_id = $_GET['link_id'];


?>


<div class="container">
    <form action="add-bulk-pdf-to-link.php" class="form w-100" method="post" enctype="multipart/form-data">

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
        $conn=OpenConn();
        $sql_users = "SELECT * FROM material_numbers WHERE link_id = $link_id";
        $select_users = mysqli_query($conn,$sql_users);
        if (mysqli_num_rows($select_users) > 0) {
            while($row = mysqli_fetch_assoc($select_users)) {
                ?>
                <input type="checkbox" name="links[]" value="<?php echo $row['id']; ?>"> <?php echo $row['number']; ?><br/>

                <?php
            }
        }


        ?>

        <input type="text" name="link_id" value="<?php echo $link_id; ?>" hidden>
        <input type="checkbox" onClick="toggle(this)" /> Vybrať všetky<br/>


        <select name="group_name" id="group" class="mt-4 mb-1">
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
        <input type="file" id="file" name="file"
        >
        <div class="mt-2">
            <button type="submit" name="add-bulk-pdf-to-links" class="btn btn-primary">Pridať</button>
        </div>
    </form>
</div>
<?php } ?>