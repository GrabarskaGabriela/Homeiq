<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Pomoc - Homeiq</title>
  <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styl.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <style>
    html, body {
      height: 100%;
      margin: 0;
    }
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }
    main {
      flex: 1;
    }
  </style>
</head>
<body>
  <?php include 'includes/navbar.html'; ?>

  <main class="container mt-3">
    <div class="card shadow-sm">
      <div class="card-header" style="background-color: #845f48; color: white;">
        <h2 class="mb-0">Kontakt z administracją</h2>
      </div>
      <div class="card-body">
        <p>Masz pytania, problemy lub sugestie? Napisz do nas – chętnie pomożemy!</p>
        <form action="submit_help.php" method="POST">
          <div class="mb-3">
            <label for="name" class="form-label">Twoje imię</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Wpisz swoje imię">
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Twój email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Wpisz swój email">
          </div>
          <div class="mb-3">
            <label for="message" class="form-label">Wiadomość</label>
            <textarea class="form-control" id="message" name="message" rows="5" placeholder="Napisz swoją wiadomość"></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Wyślij wiadomość</button>
        </form>
      </div>
    </div>
  </main>

  <?php include 'includes/footer.html'; ?>
  <script src="../includes/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
