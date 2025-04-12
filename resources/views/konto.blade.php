<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Homeiq</title>
    <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../styl.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="d-flex flex-column min-vh-100">
<main class="container flex-grow-1 my-5">
    <div class="card shadow-sm mx-auto" style="max-width: 400px;">
        <div class="card-body">
            <h3 class="card-title text-center mb-4">Logowanie</h3>

            <?php if (isset($login_error)): ?>
                <div class="alert alert-danger"><?php echo $login_error; ?></div>
            <?php endif; ?>

            <form method="POST">
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Wpisz swój email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Hasło</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Wpisz hasło" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Zaloguj się</button>
                </div>
            </form>
            <div class="mt-3 d-flex justify-content-between">
                <a href="przypominanie_hasla.blade.php">Zapomniałeś hasła?</a>
                <a href="rejestracja.blade.php">Zarejestruj się</a>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.html'; ?>
<script src="../includes/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
