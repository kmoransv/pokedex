<!-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pokedex - PHP Edition</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4 text-white">PHP Pokedex</h1>
        
        <div class="pokedex-container">
            <div class="row mb-4">
                <div class="col-md-6 offset-md-3">
                    <div class="input-group">
                        <input type="text" id="searchInput" class="form-control form-control-lg" placeholder="Search for a Pokemon...">
                        <button class="btn btn-lg btn-primary" type="button" id="searchBtn">Search</button>
                    </div>
                </div>
            </div>

            <div class="screen">
                <div id="pokemonDisplay" class="w-100">
                    <div class="card-body text-center">
                        <div id="pokemonInfo">
                            <img id="pokemonSprite" src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/pokemon/other/official-artwork/1.png" alt="Pokemon" class="img-fluid" width="200">
                            <h2 id="pokemonName" class="mt-3">Bulbasaur</h2>
                            <p id="pokemonTypes" class="text-muted"></p>
                            <div id="pokemonStats"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="controls">
                <div class="button red"></div>
                <div class="button blue"></div>
                <div class="button yellow"></div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-12">
                <h3 class="text-white">Recent Pokemon</h3>
                <div id="recentPokemon" class="row g-3">
                    <!-- Pokemon cards will be loaded here -->
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script src="assets/js/script.js"></script>
</body>
</html>
