<!doctype html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="icon" type="image/svg" href="/qm/HYDAC_ELECTRONIC.svg">

    <title>HYDAC-Admin</title>
</head>
<body>
    <div class="row">
        <div class="col-4 mt-4 ms-4 mb-5">
            <a href="/QM/qm-admin/index.php"><img src="/qm/HYDAC_ELECTRONIC.svg" alt=""></a>
            <h2>QM - Elektronické dokumenty</h2>
        </div>
        <div class="col-4 mt-3">
            <ul class="nav">
                <li class="nav-link"><a href="/QM/admin/index.php">Domov</a></li>
                <?php
                if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
                    echo '<li class="nav-link"><a href="login.php">Prihlasit</a></li>';

                }
                else{
                    echo ' <li class="nav-link"><a href="logout.php">Odhlásiť</a></li>';
                }

                ?>
                <li class="nav-link"><a href="/QM/index.php">Frontend</a></li>

            </ul>
        </div>
    </div>


