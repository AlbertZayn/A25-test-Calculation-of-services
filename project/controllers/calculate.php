<?php
require_once __DIR__ . '/../backend/sdbh.php';
$dbh = new sdbh();

// Функция для получения и исправления сериализованных данных
function getSerializedData($dbh, $table, $key) {
    $data = $dbh->mselect_rows($table, ['set_key' => $key], 0, 1, 'id');
    if (!empty($data)) {
        $fixedData = preg_replace_callback('!s:(\d+):"(.*?)";!', function ($matches) {
            $length = strlen($matches[2]);
            return "s:$length:\"{$matches[2]}\";";
        }, $data[0]['set_value']);
        return unserialize($fixedData);
    }
    return [];
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $productID = $_POST['product'];
    $days = intval($_POST['days']);
    $selectedServices = isset($_POST['services']) ? $_POST['services'] : [];

    // Получение данных продукта
    $product = $dbh->mselect_rows('a25_products', ['ID' => $productID], 0, 1, 'ID')[0];
    $price = $product['PRICE'];
    $tariff = !empty($product['TARIFF']) ? unserialize($product['TARIFF']) : [];

    // Цена в зависимости от тарифа и дней
    if (!empty($tariff)) {
        foreach ($tariff as $day => $tariffPrice) {
            if ($days >= $day) {
                $price = $tariffPrice;
            }
        }
    }
    // Итоговая стоимость
    $totalCost = $price * $days;

    // Добавление стоимости доп. услуг
    $services = getSerializedData($dbh, 'a25_settings', 'services');
    foreach ($selectedServices as $serviceKey) {
        if (isset($services[$serviceKey])) {
            $totalCost += $services[$serviceKey] * $days;
        }
    }

    echo $totalCost;
}
?>
