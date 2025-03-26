<?php
require 'db_connect.php';

$current_year = 2025;
$query = [
    '$expr' => ['$lt' => [['$add' => ['$purchase_year', '$warranty_years']], $current_year]]
];
$computers = $collection->find($query, ['typeMap' => ['root' => 'array', 'document' => 'array']]); 
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>ПК з простроченою гарантією</title>
</head>
<body>
    <h2>Список ПК з простроченою гарантією</h2>
    <table border="1">
        <tr>
            <th>Інв. номер</th><th>Рік покупки</th><th>Гарантія</th><th>Процесор</th><th>ОЗУ</th><th>Диск</th><th>ПО</th>
        </tr>
        <?php foreach ($computers as $pc): ?>
        <tr>
        <td><?= htmlspecialchars($pc['inventory_number']) ?></td>
            <td><?= htmlspecialchars($pc['purchase_year']) ?></td>
            <td><?= htmlspecialchars($pc['warranty_years']) ?> роки</td>
            <td><?= htmlspecialchars($pc['cpu']) ?></td>
            <td><?= htmlspecialchars($pc['ram']) ?></td>
            <td><?= htmlspecialchars($pc['disk']) ?></td>
            <td><?= implode(', ', $pc['software']) ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
