<?php
session_start();
require_once "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mobil</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <script src="assets/js/jquery.min.js"></script>
    <!-- Optional, Add fancyBox for media, buttons, thumbs -->
    <link rel="stylesheet" href="assets/fancybox/source/jquery.fancybox.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-buttons.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="assets/fancybox/source/helpers/jquery.fancybox-thumbs.css" type="text/css" media="screen" />
    <script type="text/javascript" src="assets/fancybox/source/jquery.fancybox.pack.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-buttons.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-media.js"></script>
    <script type="text/javascript" src="assets/fancybox/source/helpers/jquery.fancybox-thumbs.js"></script><!-- Optional, Add mousewheel effect -->
    <script type="text/javascript" src="assets/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <style>
        body {
            margin-top: 40px;
        }
    </style>
</head>
<body>
    <div class="container">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#">RENTAL MOBIL</a>
                </div>
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="?page=home">Beranda <span class="sr-only">(current)</span></a></li>
                        <?php if (isset($_SESSION["pelanggan"])): ?>
                          <li><a href="?page=profil">Profil</a></li>
                          <li><a href="logout.php">Logout</a></li>
                          <li><a href="#">|</a></li>
                          <li><a href="#" style="font-weight: bold; color: red;"><?= ucfirst($_SESSION["pelanggan"]["username"]) ?></a></li>
                        <?php else: ?>
                          <li><a href="?page=daftar">Daftar</a></li>
                          <li><a href="login.php">Login</a></li>
                        <?php endif; ?>
                    </ul>
                </div><!-- /.navbar-collapse -->
            </div><!-- /.container-fluid -->
        </nav>
        <div class="row">
            <div class="col-md-12">
              <?php include page($_PAGE); ?>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
