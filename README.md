# Simple Auth.gg Laravel wrapper

[![Latest Version on Packagist](https://img.shields.io/packagist/v/deko96/auth-gg.svg?style=flat-square)](https://packagist.org/packages/deko96/auth-gg)
[![Total Downloads](https://img.shields.io/packagist/dt/deko96/auth-gg.svg?style=flat-square)](https://packagist.org/packages/deko96/auth-gg)

This package was rapidly developed for my personal needs, but since I didn't found any similar package I've decided to publish it so anyone can use it. I am sorry for the poor documentation, once I get some time I will do some updates and provide with actual examples of how to use this package. In the meanwhile, you need to find your way through by reading my code 😁

## Installation

You can install the package via composer:

```bash
composer require deko96/auth-gg
```

## Configuration

The Wrapper is depending on 4 parameters which can be configured through: 

- Environment Variables
```bash
AUTHGG_AUTHORIZATION=
AUTHGG_SECRET=
AUTHGG_AID=
AUTHGG_API_KEY=
```
- Config file (config/auth-gg.php)
```php
return [
    'authorization' => env('AUTHGG_AUTHORIZATION', ''),
    'secret' => env('AUTHGG_SECRET', ''),
    'aid' => env('AUTHGG_AID', ''),
    'apikey' => env('AUTHGG_API_KEY', '')
];
```
The config file can be published using the `vendor:publish` artisan command.
```bash
php artisan vendor:publish --provider="Deko96\AuthGG\AuthGGServiceProvider" --tag="config"
```

## Usage

Please note that all of the functions parameters are taken from the [auth.gg developer documentation](https://setup.auth.gg/).

``` php
use Deko96\AuthGG\AuthGG;

class SomeController extends Controller {
    // ...
    
    public function index(AuthGG $authGG) {
        $adminAPI = $authGG->admin();
        $universalAPI = $authGG->universal();
        
        // Users - https://setup.auth.gg/admin/users
        $users = $adminAPI->users([
            'type' => 'fetchall'
        ]);
        
        // The rest of the examples coming soon.
    }
    // ...
}
```


## Contributing

Wanna contribute? Feel free to make a pull request 🍺


## Credits

- [Dejan Bozhinoski](https://github.com/deko96)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

## Laravel Package Boilerplate

This package was generated using the [Laravel Package Boilerplate](https://laravelpackageboilerplate.com) ❤️