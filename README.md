# PHP Pokedex

A responsive Pokedex application built with PHP, Bootstrap 5, jQuery, and Guzzle HTTP client.

## Features

- Search for any Pokemon by name or ID
- View detailed Pokemon information including stats, types, and sprites
- See recent searches saved in local storage
- Responsive design that works on all devices
- Pokedex-themed UI with authentic styling

## Technologies Used

- **PHP**: Backend server-side scripting
- **Bootstrap 5**: Frontend CSS framework for responsive design
- **jQuery**: JavaScript library for DOM manipulation and AJAX requests
- **Guzzle**: PHP HTTP client for consuming the PokeAPI
- **PokeAPI**: External API providing Pokemon data

## Installation

1. Clone or download this repository to your local development environment
2. Make sure you have PHP 7.4+ and Composer installed
3. Navigate to the project directory in your terminal
4. Install dependencies using Composer:
   ```
   composer install
   ```
5. Start your local server (e.g., using XAMPP, WAMP, or PHP's built-in server)
6. Access the application through your browser

## Project Structure

```
pokedex/
├── index.php           # Main HTML page with Bootstrap UI
├── api.php             # API endpoint for fetching Pokemon data
├── PokemonAPI.php      # PHP class using Guzzle to interact with PokeAPI
├── composer.json       # Composer dependencies file
├── composer.lock       # Composer lock file
├── assets/
│   ├── css/
│   │   └── style.css   # Custom CSS styles
│   └── js/
│       └── script.js   # Client-side JavaScript/jQuery code
```

## Usage

1. Open the application in your browser
2. Search for a Pokemon by name or ID in the search box
3. Click "Search" or press Enter to view the Pokemon's information
4. The Pokemon's details will be displayed in the Pokedex screen
5. Recent searches appear in the "Recent Pokemon" section at the bottom

## API Endpoints

### Get Pokemon Data
```
GET /api.php?request=pokemon&name={pokemon_name_or_id}
```

Returns detailed information about a specific Pokemon.

### Get Pokemon List
```
GET /api.php?request=list&limit={limit}&offset={offset}
```

Returns a list of Pokemon with names and URLs.

## Customization

Feel free to customize the application:

- Modify `assets/css/style.css` to change the styling
- Enhance `assets/js/script.js` with additional functionality
- Add new features to `PokemonAPI.php` to handle more PokeAPI endpoints

## Troubleshooting

- If you get an error about Guzzle not being found, make sure to run `composer install`
- Ensure your server has internet access to connect to the PokeAPI
- Check browser console for any JavaScript errors
- Verify that your PHP version is compatible with the dependencies

## Credits

- [PokeAPI](https://pokeapi.co/) for providing the Pokemon data
- [Bootstrap](https://getbootstrap.com/) for the responsive UI framework
- [jQuery](https://jquery.com/) for simplifying JavaScript operations
- [Guzzle](https://docs.guzzlephp.org/) for the HTTP client library