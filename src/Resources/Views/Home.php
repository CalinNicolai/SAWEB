<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/main.css">
    <style>
        body {
            background-color: #343a40; /* Темно-серый фон */
            color: #ffffff; /* Белый текст */
        }

        .container {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<?php
include __DIR__ . '/../../Resources/Components/navbar.php';
?>
<div class="container">
    <h1 class="text-center mb-4">Welcome</h1>
</div>
<!-- Подключение Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
