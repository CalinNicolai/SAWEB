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
<div class="container" style="display: flex; flex-direction: column; align-items: center;">
    <h1 class="text-center mb-4">Guest</h1>

    <!-- Форма для добавления записи -->
    <div class="mb-4 w-50">
        <form action="/guest" method="post">
            <div class="form-group">
                <input type="hidden" class="form-control" id="user" value="<?php echo $_SESSION['user_id']; ?>"
                       name="user" required>
            </div>
            <div class="form-group">
                <label for="text_message">Message:</label>
                <textarea class="form-control" id="text_message" name="text_message" rows="4" required></textarea>
                <div class="error-message" style="color: red">
                    <p id="message-err"></p>
                </div>
            </div>
            <div class="form-group">
                <label for="e_mail">Email:</label>
                <input type="email" class="form-control" id="e_mail" name="e_mail" required>
                <div class="error-message" style="color: red">
                    <p id="email-err"></p>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

    <!-- Таблица с данными -->
    <div class="w-50 mb-4" style="color: black">
        <?php
        foreach ($guests as $guest) {
            echo '<div class="card mb-4">';
            echo '<div class="card-body">';

            $user = $this->userRepository->find($guest['user']);
            if ($user) {
                echo '<h5 class="card-title">User: ' . htmlspecialchars($user['login'], ENT_QUOTES, 'UTF-8') . '</h5>';
            } else {
                echo '<h5 class="card-title">User: Unknown</h5>';
            }

            echo '<p class="card-text">Message: ' . htmlspecialchars($guest['text_message'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="card-text">Email: ' . htmlspecialchars($guest['e_mail'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="card-text">Time: ' . htmlspecialchars($guest['data_time_message'], ENT_QUOTES, 'UTF-8') . '</p>';

            echo '</div>';
            echo '</div>';
        }

        ?>
    </div>
</div>
<!-- Подключение Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
