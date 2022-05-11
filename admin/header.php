<?php
session_start();

// Check if the user is logged in, if not then redirect him to login page
if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>
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
    <div class="row ms-3 mt-3 mb-3">
        <div class="col-12 col-xl-3">
            <a href="/QM/admin/index.php"><img src="/qm/HYDAC_ELECTRONIC.svg" alt="" class="img-fluid"></a>
            <h2>QM - Elektronické dokumenty</h2>
        </div>
        <div class="col-12 col-xl-9">
            <ul class="nav main-nav">
                <div class="row w-100">
                    <div class="col-12 col-lg-10 d-flex">
                        <li class="nav-link"><a href="/QM/admin/departments/show.php" class="btn">Úseky výroby</a></li>
                        <li class="nav-link"><a href="/QM/admin/pdfs/show.php" class="btn">PDF</a></li>
                        <li class="nav-link"><a href="/QM/index.php" class="btn">Frontend</a></li>
                        <li class="nav-link"><a href="/QM/admin/logout.php" class="btn">Odhlásiť</a></li>

                    </div>

                    <div class="col-2">
                        <li class="nav-link">
                            <form>
                                <input type="button" class="btn btn-secondary" value="Späť" onclick="history.back()">
                            </form>
                        </li>
                    </div>
                </div>
            </ul>
        </div>
    </div>

    <style>
        .main-nav li a{
            background-color: #242424;
            color: #FFFFFF;
        }
        .main-nav li a:hover{
            background-color: #e30613;
            color: #242424;
        }
        .pull-right{
            text-align: right;
        }
    </style>

