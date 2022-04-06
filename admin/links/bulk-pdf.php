<?php include "../header.php"?>
<?php include "../../db.php"?>
<div class="container">
    <form action="add-bulk.php" class="form w-100" method="post" enctype="multipart/form-data">

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
        $sql_users = "SELECT * FROM links";
        $select_users = mysqli_query($conn,$sql_users);
        if (mysqli_num_rows($select_users) > 0) {
            while($row = mysqli_fetch_assoc($select_users)) {
                ?>
                <input type="checkbox" name="links[]" value="<?php echo $row['id']; ?>"> <?php echo $row['name']; ?><br/>

                <?php
            }
        }

        ?>


        <input type="checkbox" onClick="toggle(this)" /> Vybrať všetky<br/>

        <select name="group_name" id="group" class="mt-2 mb-3">
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
            <button type="submit" name="add-bulk" class="btn btn-primary">Pridať</button>
        </div>
    </form>
</div>
