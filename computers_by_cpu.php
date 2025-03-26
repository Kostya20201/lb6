<?php
require 'db_connect.php';

$cpu_filter = isset($_GET['cpu']) ? $_GET['cpu'] : null;
$query = $cpu_filter ? ['cpu' => $cpu_filter] : [];
$computers = $collection->find($query, ['typeMap' => ['root' => 'array', 'document' => 'array']]);   
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <title>ПК по процесору</title>
</head>
<body>
    <h2>Список ПК з процесором: <?= htmlspecialchars($cpu_filter) ?></h2>
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
