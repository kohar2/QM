<form action="" class="form w-100" method="post">
    <div class="input-group flex-nowrap mb-2">
        <span class="input-group-text" id="addon-wrapping">Linky</span>
        <input list="material_name" name="material_name">
        <datalist id="material_name" ">
        <?php
        $conn = OpenConn();
        $select_links = "SELECT * FROM links";

        $selected_links = mysqli_query($conn,$select_links);

        if (mysqli_num_rows($selected_links) > 0) {
            while($link = mysqli_fetch_assoc($selected_links)) {
                ?>
                <option value="<?php echo $link['name']?>"><?php echo $link['name']?></option>
                <?php
            }
        }
        ?>
        </datalist>
    </div>

    <div class="">
        <button type="submit" name="search" class="btn btn-primary">Hľadaj</button>
    </div>
</form>