<?php
require_once('../config/database.php');
require_once('../models/CarModel.php');

$carModel = new CarModel($conn);

// Collect filter parameters from POST request
$filters = [
    'marca' => isset($_POST['marca']) ? $_POST['marca'] : null,
    'modelo' => isset($_POST['modelo']) ? $_POST['modelo'] : null,
    'cor' => isset($_POST['cor']) ? $_POST['cor'] : null,
    'ano' => isset($_POST['ano']) ? $_POST['ano'] : null,
    'status' => isset($_POST['status']) ? $_POST['status'] : null,
];

// call os filtros de carros
$filteredCars = $carModel->filterCars($filters);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Filtered Cars</title> <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/main.css">

</head>
<body>
<div class="wrapper container mt-5">
    <h1 class="mb-4">Resultado filtro:</h1>
    <?php if (!empty($filteredCars)): ?>
        <div class="cars-grid">
            <?php foreach ($filteredCars as $car): ?>
                <div class="car">                    
                    <div class="car-details">
                        <div><strong>Marca:</strong> <?php echo htmlspecialchars($car['marca']); ?></div>
                        <div><strong>Modelo:</strong> <?php echo htmlspecialchars($car['modelo']); ?></div>
                        <div><strong>Cor:</strong> <?php echo htmlspecialchars($car['cor']); ?></div>
                        <div><strong>Ano:</strong> <?php echo htmlspecialchars($car['ano']); ?></div>
                        <div><strong>Status:</strong> <?php echo htmlspecialchars($car['status']); ?></div>
                    </div>
                     <div class="car-actions">
                         <div class="car-image">
                        <?php 
                            $model = strtolower($car['marca']);
                            $icon_path = "../assets/img/svgs/{$model}.svg";
                            echo '<img class="marcaicon" src="' . $icon_path . '" alt="' . $car['marca'] . '">';
                        ?>
                    </div>
                     </div>
                   
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="alert alert-warning" role="alert">
            Nenhum resultado encontrado.
        </div>
    <?php endif; ?>
    <a href="dashboard.php" class="btn btn-secondary mt-3"><i class="fas fa-arrow-left"></i> Voltar</a>
</div>


    <?php include('../views/footer.php') ?>
</body>
</html>
