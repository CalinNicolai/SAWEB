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
        .delete-btn {
            margin: 0 5px;
        }
    </style>
</head>
<body>
<div class="container" style="display: flex; flex-direction: column; align-items: center;">
    <a href="/logout" class="btn btn-danger logout-btn">Logout</a>
    <h1 class="text-center mb-4">Users</h1>

    <table class="table table-dark table-striped">
        <thead>
        <tr>
            <th scope="col">Login</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo htmlspecialchars($user['login']); ?></td>
                <td><?php echo htmlspecialchars($user['created_at']); ?></td>
                <td>
                    <form action="/delete-account" method="post" style="display:inline;">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($user['id']); ?>">
                        <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete Account</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <h1 class="text-center mb-4">Comments</h1>

    <div class="w-50 mb-4" style="color: black">
        <?php
        foreach ($comments as $comment) {
            echo '<div class="card mb-4">';
            echo '<div class="card-body">';

            $user = $this->userRepository->find($comment['user']);
            if ($user) {
                echo '<h5 class="card-title">User: ' . htmlspecialchars($user['login'], ENT_QUOTES, 'UTF-8') . '</h5>';
            } else {
                echo '<h5 class="card-title">User: Unknown</h5>';
            }

            echo '<p class="card-text">Message: ' . htmlspecialchars($comment['text_message'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="card-text">Email: ' . htmlspecialchars($comment['e_mail'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<p class="card-text">Time: ' . htmlspecialchars($comment['data_time_message'], ENT_QUOTES, 'UTF-8') . '</p>';
            echo '<form action="/delete-comment" method="post" style="display:inline;">
                      <input type="hidden" name="comment_id" value="' . htmlspecialchars($comment['id']) . '">
                      <button type="submit" class="btn btn-danger btn-sm delete-btn">Delete Comment</button>
                  </form>';
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
