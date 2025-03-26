<?php
require 'db_connect.php';

$cpus = $collection->distinct("cpu");

$software_list = $collection->distinct("software");
?>

<!DOCTYPE html>
<html lang="ua">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Фільтр ПК</title>
    <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; padding: 20px; text-align: center; }
        .container { max-width: 500px; margin: auto; background: #fff; padding: 20px; border-radius: 10px; padding: 20px; }
        h2 { text-align: center; }
        form { margin: 20px 0; }
        select, button { padding: 10px; margin: 5px; width: 100%; }
        button { background: #007bff; color: white; border: none; cursor: pointer; }
        button:hover { background: #0056b3; }
        .history { margin-top: 20px; text-align: left; padding: 10px; background: #eee; border-radius: 5px; }
        .hidden { display: none; }
    </style>
</head>
<body>
    <div class="container">
        <h2>Оберіть фільтр</h2>

        <form action="computers_by_cpu.php" method="GET">
            <label>Фільтр по процесору:</label>
            <select name="cpu" id="cpu-select">
                <option value="">Оберіть процесор</option>
                <?php foreach ($cpus as $cpu): ?>
                    <option value="<?= htmlspecialchars($cpu) ?>"><?= htmlspecialchars($cpu) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Показати</button>
        </form>

        <form action="computers_by_software.php" method="GET">
            <label>Фільтр по ПО:</label>
            <select name="software" id="software-select">
                <option value="">Оберіть ПО</option>
                <?php foreach ($software_list as $software): ?>
                    <option value="<?= htmlspecialchars($software) ?>"><?= htmlspecialchars($software) ?></option>
                <?php endforeach; ?>
            </select>
            <button type="submit">Показати</button>
        </form>

        <form action="computers_expired_warranty.php" method="GET">
            <button type="submit" name="expired_warranty" value="1">Показати з простроченою гарантією</button>
        </form>

        <div class="history hidden" id="history">
            <h3>Останні обрані параметри:</h3>
            <p id="last-cpu">Процесор: -</p>
            <p id="last-software">ПО: -</p>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const cpuSelect = document.getElementById("cpu-select");
            const softwareSelect = document.getElementById("software-select");
            const historyBlock = document.getElementById("history");
            const lastCpu = document.getElementById("last-cpu");
            const lastSoftware = document.getElementById("last-software");

            // Загрузка сохранённых данных
            const savedCpu = localStorage.getItem("lastCpu");
            const savedSoftware = localStorage.getItem("lastSoftware");

            if (savedCpu || savedSoftware) {
                lastCpu.textContent = savedCpu ? `Процессор: ${savedCpu}` : "Процессор: -";
                lastSoftware.textContent = savedSoftware ? `ПО: ${savedSoftware}` : "ПО: -";
                historyBlock.classList.remove("hidden");
            }

            // Сохранение выбранных значений
            cpuSelect.addEventListener("change", function () {
                localStorage.setItem("lastCpu", cpuSelect.value);
            });

            softwareSelect.addEventListener("change", function () {
                localStorage.setItem("lastSoftware", softwareSelect.value);
            });
        });
    </script>
</body>
</html>
