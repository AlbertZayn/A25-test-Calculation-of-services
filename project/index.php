<?php
require_once 'backend/sdbh.php';
$dbh = new sdbh();

// Исправление сериализованных строк
function repairSerializedString($string) {
    return preg_replace_callback('!s:(\d+):"(.*?)";!', function ($matches) {
        $length = strlen($matches[2]);
        return "s:$length:\"{$matches[2]}\";";
    }, $string);
}

// Получение данных сериализации
$serializedData = $dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value'];
$fixedData = repairSerializedString($serializedData);

// Попытка десериализации
$services = @unserialize($fixedData);

if ($services === false && $fixedData !== 'b:0;') {
    echo "Ошибка десериализации данных";
    echo "<pre>";
    print_r($fixedData);
    echo "</pre>";
} else {
    ?>
    <html>
    <head>
        <meta charset="UTF-8">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
        <link href="assets/css/style.css" rel="stylesheet" />
        <link href="form/style_form.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"  crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    </head>
    <body>
    <div class="container">
        <!--TODO: реализовать форму расчета-->
        <div class="row row-form">
            <div class="col-12">
                <div class="container">
                    <div class="row row-body">
                        <div class="col-3">
                            <span style="text-align: center">Форма расчета:</span>
                            <i class="bi bi-activity"></i>
                        </div>
                        <div class="col-9">
                            <form action="" id="form">
                                <label class="form-label" for="product">Выберите продукт:</label>
                                <select class="form-select" name="product" id="product">
                                    <option value="100">Продукт 1 за 100</option>
                                    <option value="200">Продукт 2 за 200</option>
                                    <option value="300">Продукт 3 за 300</option>
                                    <option value="400">Продукт 4 за 400</option>
                                </select>

                                <label for="customRange1" class="form-label">Количество дней:</label>
                                <input type="text" class="form-control" id="customRange1" min="1" max="30">

                                <label for="customRange1" class="form-label">Дополнительно:</label>
                                <?php
                                if (is_array($services)) {
                                    foreach($services as $k => $s) { ?>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="<?=$k?>" checked>
                                            <label><?=$k?>: <?=$s?></label>
                                        </div>
                                    <?php }
                                } else {
                                    echo "<li>Ошибка: данные не являются массивом</li>";
                                }
                                ?>
                                <button type="submit" class="btn btn-primary">Рассчитать</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </body>
    </html>
    <?php
}
?>
