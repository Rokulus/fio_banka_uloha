<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vítězové Oscarů</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="./index.php" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <span class="fs-4">Nahrajte soubory CSV s vítězem Oscara</span>
    </a>

    <ul class="nav nav-pills">
        <li class="nav-item"><a href="./index.php" class="nav-link active" aria-current="page">Nahrát soubory</a></li>
    </ul>
    </header>
</div>
<div class="container mt-5">
    <form action="results.php" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="femaleWinners" class="form-label">Ženy CSV</label>
            <input class="form-control" type="file" name="femaleWinners" id="femaleWinners" required>
        </div>
        <div class="mb-3">
            <label for="maleWinners" class="form-label">Muži CSV</label>
            <input class="form-control" type="file" name="maleWinners" id="maleWinners" required>
        </div>
        <button type="submit" class="btn btn-primary">Nahrát</button>
    </form>
</div>
</body>
</html>
