<?php
require_once 'UploadHandler.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $handler = new UploadHandler();
    $handler->handleUpload($_FILES['femaleWinners'], $_FILES['maleWinners']);

    $oscarOverview = $handler->getOscarsByYear();
    $moviesWithBothAwards = $handler->getMoviesWithBothAwards();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Výsledky vítězů Oscarů</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Přehled vítězů Oscarů</span>
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="./index.php" class="nav-link active" aria-current="page">Nahrát soubory</a></li>
    </ul>
    </header>
</div>
<div class="container mt-5">
    <h2>Přehled Oscarů podle roku</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Index</th>
                <th>Rok</th>
                <th>Ženy</th>
                <th>Muži</th>
            </tr>
        </thead>
        <tbody>
            <?php $i = 1; ?>    
            <?php foreach ($oscarOverview as $year => $winners): ?>
                <tr>
                    <td><?= $i ?></td>
                    <td><?= htmlspecialchars($year) ?></td>
                    <td><?= isset($winners['women']) ? $winners['women'] : 'N/A' ?></td>
                    <td><?= isset($winners['men']) ? $winners['men'] : 'N/A' ?></td>
                    <?php $i++; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Filmy, které získaly Oscary za obě hlavní role</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Název filmu</th>
                <th>Rok</th>
                <th>Herečka</th>
                <th>Herec</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($moviesWithBothAwards as $movie): ?>
                <tr>
                    <td><?= htmlspecialchars($movie['title']) ?></td>
                    <td><?= htmlspecialchars($movie['year']) ?></td>
                    <td><?= htmlspecialchars($movie['actress']) ?></td>
                    <td><?= htmlspecialchars($movie['actor']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
