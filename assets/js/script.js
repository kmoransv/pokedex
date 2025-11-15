// assets/js/script.js

$(document).ready(function() {
    // Load a default Pokemon on page load
    loadPokemon('bulbasaur');
    
    // Load recent Pokemon from localStorage
    const recentPokemons = JSON.parse(localStorage.getItem('recentPokemons') || '[]');
    displayRecentPokemons(recentPokemons);
    
    // Search button click event
    $('#searchBtn').click(function() {
        const searchValue = $('#searchInput').val().trim().toLowerCase();
        if (searchValue) {
            loadPokemon(searchValue);
        }
    });
    
    // Search on Enter key
    $('#searchInput').keypress(function(e) {
        if (e.which === 13) { // Enter key
            const searchValue = $(this).val().trim().toLowerCase();
            if (searchValue) {
                loadPokemon(searchValue);
            }
        }
    });
});

function loadPokemon(identifier) {
    $.ajax({
        url: 'api.php',
        method: 'GET',
        data: {
            request: 'pokemon',
            name: identifier
        },
        success: function(data) {
            if (data.error) {
                showError(data.error);
                return;
            }
            
            displayPokemon(data);
        },
        error: function(xhr, status, error) {
            showError('Failed to load Pokemon data. Please try again.');
        }
    });
}

function displayPokemon(pokemon) {
    $('#pokemonName').text(pokemon.name);
    
    // Display sprite
    const spriteUrl = pokemon.sprites.official_artwork || pokemon.sprites.front_default;
    $('#pokemonSprite').attr('src', spriteUrl).attr('alt', pokemon.name);
    
    // Display types
    const typesHtml = pokemon.types.map(type => 
        `<span class="badge bg-primary me-1 type-${type}">${type}</span>`
    ).join('');
    $('#pokemonTypes').html(typesHtml);
    
    // Display stats
    const statsHtml = `
        <div class="row text-center">
            <div class="col-4">
                <p class="mb-1">HP</p>
                <p class="fw-bold">${pokemon.stats.hp}</p>
            </div>
            <div class="col-4">
                <p class="mb-1">Attack</p>
                <p class="fw-bold">${pokemon.stats.attack}</p>
            </div>
            <div class="col-4">
                <p class="mb-1">Defense</p>
                <p class="fw-bold">${pokemon.stats.defense}</p>
            </div>
        </div>
        <div class="row text-center">
            <div class="col-4">
                <p class="mb-1">Sp. Atk</p>
                <p class="fw-bold">${pokemon.stats['special-attack']}</p>
            </div>
            <div class="col-4">
                <p class="mb-1">Sp. Def</p>
                <p class="fw-bold">${pokemon.stats['special-defense']}</p>
            </div>
            <div class="col-4">
                <p class="mb-1">Speed</p>
                <p class="fw-bold">${pokemon.stats.speed}</p>
            </div>
        </div>
    `;
    $('#pokemonStats').html(statsHtml);
    
    // Store in recent searches
    addToRecentPokemon(pokemon);
}

function addToRecentPokemon(pokemon) {
    // Get recent pokemons from localStorage
    let recentPokemons = JSON.parse(localStorage.getItem('recentPokemons') || '[]');
    
    // Check if already exists and remove it
    recentPokemons = recentPokemons.filter(p => p.id !== pokemon.id);
    
    // Add the new pokemon to the beginning
    recentPokemons.unshift({
        id: pokemon.id,
        name: pokemon.name,
        sprite: pokemon.sprites.official_artwork || pokemon.sprites.front_default
    });
    
    // Keep only the last 12 pokemons
    if (recentPokemons.length > 12) {
        recentPokemons = recentPokemons.slice(0, 12);
    }
    
    // Save back to localStorage
    localStorage.setItem('recentPokemons', JSON.stringify(recentPokemons));
    
    // Display recent pokemons
    displayRecentPokemons(recentPokemons);
}

function displayRecentPokemons(recentPokemons) {
    const container = $('#recentPokemon');
    container.empty();
    
    if (recentPokemons.length === 0) {
        container.html('<p class="text-muted">No recent Pokemons yet</p>');
        return;
    }
    
    recentPokemons.forEach(pokemon => {
        const pokemonCard = `
            <div class="col-md-2 col-4">
                <div class="card pokemon-card text-center" data-pokemon="${pokemon.name}">
                    <img src="${pokemon.sprite}" class="card-img-top p-2" alt="${pokemon.name}">
                    <div class="card-body p-2">
                        <h6 class="card-title">${pokemon.name}</h6>
                    </div>
                </div>
            </div>
        `;
        container.append(pokemonCard);
    });
    
    // Add click event to recent pokemon cards
    $('.pokemon-card').click(function() {
        const pokemonName = $(this).data('pokemon');
        loadPokemon(pokemonName);
        $('#searchInput').val(pokemonName);
    });
}

function showError(message) {
    $('#pokemonInfo').html(`
        <div class="alert alert-danger" role="alert">
            <h4>Error</h4>
            <p>${message}</p>
        </div>
    `);
}