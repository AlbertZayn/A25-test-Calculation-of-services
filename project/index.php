<?php
require_once 'backend/sdbh.php';
$dbh = new sdbh();

?>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
    </head>
    <body>
        <div class="container">
            <div class="row row-header">
                <div class="col-12">
                    <img src="assets/img/logo.png" alt="logo" style="max-height:50px"/>
                    <h1>Прокат</h1>
                </div>
            </div>
            <div class="row row-body">
                <div class="col-12">
                    <h4>Дополнительные услуги:</h4>
                    <ul>
                    <?
                        $services = unserialize($dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value']);
                        foreach($services as $k => $s) { ?>
                            <li><?=$k?>: <?=$s?></li>
                        <?}
                    ?>
                    </ul>
                </div>
            </div>
            <!-- TODO: реализовать форму расчета -->
            <!-- <div class="row row-form">
                <div class="col-12">
                    <h4>Форма расчета:</h4>
                    <p></p>
                </div>
            </div> -->
        </div>
    </body>
</html>