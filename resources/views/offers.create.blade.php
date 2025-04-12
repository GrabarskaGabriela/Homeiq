<?php include 'includes/navbar.html'; ?>
<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wystaw ofertę - Homeiq</title>
  <link href="../includes/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../styl.css">
  <style>
    .center-column {
      display: flex;
      flex-direction: column;
    }
    .center-column > .card {
      flex: 1; 
    }
  </style>
</head>
<body>
  <main class="container my-5">
    <h2 class="mb-4">Wystaw ofertę nieruchomości</h2>
    <form action="submit_offer.php" method="POST" enctype="multipart/form-data">
      <div class="row align-items-stretch">
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Lokalizacja</h5>
              <div class="mb-3">
                <label for="country" class="form-label">Państwo</label>
                <input type="text" class="form-control" id="country" name="country" placeholder="Wpisz państwo">
              </div>
              <div class="mb-3">
                <label for="region" class="form-label">Region</label>
                <input type="text" class="form-control" id="region" name="region" placeholder="Wpisz region">
              </div>
              <div class="mb-3">
                <label for="city" class="form-label">Miasto</label>
                <input type="text" class="form-control" id="city" name="city" placeholder="Wpisz miasto">
              </div>
              <div class="mb-3">
                <label for="street" class="form-label">Ulica</label>
                <input type="text" class="form-control" id="street" name="street" placeholder="Wpisz ulicę">
              </div>
              <div class="mb-3">
                <label for="number" class="form-label">Numer</label>
                <input type="text" class="form-control" id="number" name="number" placeholder="Numer domu/mieszkania">
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-4 center-column">
          <div class="card mb-2 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Opis nieruchomości</h5>
              <div class="mb-3">
                <label for="description" class="form-label">Opis</label>
                <textarea class="form-control" id="description" name="description" rows="5" placeholder="Opisz nieruchomość"></textarea>
              </div>
            </div>
          </div>

          <div class="card mt-2 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Dodaj zdjęcia</h5>
              <div class="mb-3">
                <label for="images" class="form-label">Wybierz zdjęcia</label>
                <input class="form-control" type="file" id="images" name="images[]" multiple>
              </div>
            </div>
          </div>
        </div>
        
        <div class="col-md-4">
          <div class="card h-100 shadow-sm">
            <div class="card-body">
              <h5 class="card-title">Dane techniczne</h5>
              <div class="mb-3">
                <label for="price" class="form-label">Cena (PLN)</label>
                <input type="number" class="form-control" id="price" name="price" placeholder="Wpisz cenę">
              </div>
              <div class="mb-3">
                <label for="area" class="form-label">Powierzchnia</label>
                <div class="input-group">
                  <input type="number" class="form-control" id="area" name="area" placeholder="Powierzchnia">
                  <span class="input-group-text">m²</span>
                </div>
              </div>
              <div class="mb-3">
                <label for="property_type" class="form-label">Typ nieruchomości</label>
                <select class="form-select" id="property_type" name="property_type">
                  <option value="mieszkanie" selected>Mieszkanie</option>
                  <option value="dom">Dom</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="rooms" class="form-label">Liczba pokoi</label>
                <select class="form-select" id="rooms" name="rooms">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="construction" class="form-label">Zabudowa</label>
                <select class="form-select" id="construction" name="construction">
                  <option value="blok" selected>Blok</option>
                  <option value="blizniak">Bliźniak</option>
                  <option value="szeregowiec">Szeregowiec</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="equipment" class="form-label">Wyposażenie</label>
                <select class="form-select" id="equipment" name="equipment">
                  <option value="brak" selected>Brak</option>
                  <option value="czesciowo">Częściowo umeblowane</option>
                  <option value="umeblowane">Umeblowane</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="condition" class="form-label">Stan</label>
                <select class="form-select" id="condition" name="condition">
                  <option value="do_remontu" selected>Do remontu</option>
                  <option value="do_zamieszkania">Do zamieszkania</option>
                  <option value="surowy">Stan surowy</option>
                </select>
              </div>
            </div>
          </div>
        </div>
      </div>
      
      <div class="mb-5">
        <button type="submit" class="btn btn-primary">Wystaw ofertę</button>
      </div>
    </form>
  </main>

  <?php include 'includes/footer.html'; ?>
  <script src="../includes/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>
