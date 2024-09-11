<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <!-- Подключение Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #343a40; /* Темно-серый фон */
            color: #ffffff; /* Белый текст */
        }
        .container {
            margin-top: 20px;
        }
        table {
            background-color: #495057; /* Темно-серый фон таблицы */
        }
        th, td {
            color: #ffffff; /* Белый текст в таблице */
        }
        .logout-btn {
            position: absolute;
            top: 10px;
            right: 10px;
        }
    </style>
</head>
<body>
<div class="container">
    <a href="/logout" class="btn btn-danger logout-btn">Logout</a>
    <h1 class="text-center mb-4">Users</h1>
    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Login</th>
            <th scope="col">Created At</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
<!-- Подключение Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
