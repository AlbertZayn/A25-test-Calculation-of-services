<?php
require 'controllers/serializing.php';
?>
<html>
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet"/>
    <link href="form/style_form.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
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
                                <?php
                                if (isset($products) && is_array($products)) {
                                    foreach ($products as $product) {
                                        echo '<option value="' . htmlspecialchars($product['ID']) . '">' . htmlspecialchars($product['NAME']) . ' за ' . htmlspecialchars($product['PRICE']) . '</option>';
                                    }
                                } else {
                                    echo "<option>Ошибка: данные о продуктах недоступны</option>";
                                }
                                ?>
                            </select>

                            <label for="customRange1" class="form-label">Количество дней:</label>
                            <input type="number" class="form-control" id="customRange1" name="days" min="1" max="30" required>

                            <label for="customRange1" class="form-label">Дополнительно:</label>
                            <?php
                            if (is_array($services)) {
                                foreach ($services as $k => $s) { ?>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="services[]" value="<?= $k ?>" id="<?= $k ?>" checked>
                                        <label for="<?= $k ?>"><?= $k ?>: <?= $s ?></label>
                                    </div>
                                <?php }
                            } else {
                                echo "<li>Ошибка: данные не являются массивом</li>";
                            }
                            ?>
                            <button type="submit" class="btn btn-primary">Рассчитать</button>
                        </form>
                        <div id="result"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="ajax.js"></script>
</body>
</html>



