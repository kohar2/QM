<?php include "header.php"?>
<?php include "../db.php"?>

<div class="row m-3">

    <div class="col-4">
        <img src="HYDAC_ELECTRONIC.svg" alt="" class="mb-5 mt-5">

        <form action="" class="form form-inline" method="post">
            <label for="material_name">Materiálové číslo</label>
            <input list="material_name" name="material_name" class="form-control" autofocus>
            <datalist id="material_name" ">
            <?php
            $conn = OpenConn();
            $edit_sql = "SELECT * FROM material_numbers";

            $update_departments = mysqli_query($conn,$edit_sql);

            if (mysqli_num_rows($update_departments) > 0) {
                while($department = mysqli_fetch_assoc($update_departments)) {
                    ?>
                    <option value="<?php echo $department['number']?>"><?php echo $department['number']?></option>
                    <?php
                }
            }
            ?>
            </datalist>
            <div class="">
                <button type="submit" name="search" class="btn btn-primary mt-2">Hľadať</button>
            </div>
        </form>
        <div class="operator mt-4">Operátor</div>
        <div class="both mt-2">Operátor + Zoraďovač</div>
        <div class="zoradovac mt-2">Zoraďovač</div>

    </div>
    <div class="col-8">
    <?php
        $groups = ['AI','AA','PP','SL','PRA','MDB'];
    foreach ($groups as $group){
        ?>

        <table class="table table-sm table-bordered table-rounded table-striped <?php echo $group ?>">
            <?php
            $conn = OpenConn();
            if(isset($_POST['search'])){
                $material_name =  $_POST['material_name'];
                $sql = "SELECT * FROM material_numbers WHERE number = '$material_name'";

                $select_users = mysqli_query($conn,$sql);
                ?>
                <thead>
                <tr>
                    <th>
                          <?php echo $group . " pre " . $material_name; ?>
                    </th>
                </thead>
                <tr>
                <?php

            if (mysqli_num_rows($select_users) > 0) {
                while($row = mysqli_fetch_assoc($select_users)) {
                    $id = $row['id'];
                    $sql2 = "SELECT * FROM number_pdf JOIN pdf_paths on number_pdf.pdf_id = pdf_paths.id WHERE number_pdf.material_id = $id AND number_pdf.group_name = '$group'";
                    $result = mysqli_query($conn,$sql2);

                    if (mysqli_num_rows($result) > 0) {
                        while($row = mysqli_fetch_assoc($result)) {

                            ?>
            <tr>
                <td><a href="../pdfs/<?php echo $row['path'] . ".pdf"; ?>" target="_blank"><?php echo $row['path'] . ".pdf"; ?> </a></td>
            </tr>
                            <?php
                        }
                    }
                    else{
                        echo "<tr class='empty'><td>!</tr></td>";
                    }
                    ?>
                    <?php

                }
            }

            }
            ?>

            </tbody>
        </table>
<?php
}
?>
</div>

    <style>
        .AA,.AI{
            background-color: #008B8B;
        }

        .AA a,.AA th{
            color:white;
        }

        .AI a,.AI th{
            color:white;
        }
        .empty{
            background-color: red;
        }
        .home{
            background-color: #f3f3f3;
            border-radius: 10px;
        }
        .MDB{
            background-color: #00ccff;
        }
        .MDB a,.MDB th{
            color:black;
        }
        .PP,.SL,.PRA{
            background-color: yellow;
            color: black;
        }
        .PP a,.SL a,.PRA a{

            color: black;
        }
        .operator{
            background-color: #008B8B;
            color:white;
            font-size: 25px;
            text-align: center;
        }
        .zoradovac{
            background-color: #00ccff;
            color:black;
            font-size: 25px;
            text-align: center;

        }
        .both{
            background-color: yellow;
            color:black;
            font-size: 25px;
            text-align: center;

        }
    </style>

<?php include "footer.php"; ?>