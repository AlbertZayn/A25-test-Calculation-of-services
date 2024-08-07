<?php
// Подключение модели
require_once __DIR__ . '/../backend/sdbh.php';

// Исправление сериализованных строк
function repairSerializedString($string) {
    return preg_replace_callback('!s:(\d+):"(.*?)";!', function ($matches) {
        $length = strlen($matches[2]);
        return "s:$length:\"{$matches[2]}\";";
    }, $string);
}

// Получение данных сериализации
$dbh = new sdbh();
$serializedData = $dbh->mselect_rows('a25_settings', ['set_key' => 'services'], 0, 1, 'id')[0]['set_value'];
$fixedData = repairSerializedString($serializedData);

// Попытка десериализации
$services = @unserialize($fixedData);

if ($services === false && $fixedData !== 'b:0;') {
    $error = "Ошибка десериализации данных";
    $fixedDataDisplay = "<pre>" . print_r($fixedData, true) . "</pre>";
} else {
    $error = null;
    $fixedDataDisplay = null;
}

?>
