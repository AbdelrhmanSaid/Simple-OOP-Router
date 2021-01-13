# Simple OOP Router

Simple OOP Router using PHP 7.4

## Installation

You can clone this repo and use it wherever you want

```bash
git clone https://github.com/AbdelrhmanSaid/Simple-OOP-Router/
```


## Run your Project
Use this commands to get into your project after cloning it
```bash
cd Simple-OOP-Router
php -S localhost:8080
```

## Usage
At the first, Be Sure that you have Views Folder with your HTML Code.

in your index.php
```php
require __DIR__ . "/Router.php";

/**

    Creating a new Router instance

    ($rootPath = null) => If you would like to change your root path, Default is dirname(__DIR)

    ($error404 = "errors/_404") => To specify a 404 Page Handler, Default is (_404) in views/errors directory.

    ($routes = []) => If you already have an array with your exiting routes, you can easily import it here.

    $router = new Router($rootPath, $error404, $routes);

**/

$router = new Router();

/**
    This get function will catch all [ GET ] methods and resolve requests to its paths
**/

$router->get("/", "index");

/**
    This get function will catch all [ POST ] methods and resolve requests to its paths
**/

$router->post("/", "index");

/**
    You can also do functions instead of render a View
**/

$router->get("/function", function () {
    echo "This is a function!";
});

$router->resolve();

```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
