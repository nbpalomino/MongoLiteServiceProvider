MongoLiteServiceProvider
========================

A [MongoLite](https://github.com/aheinze/MongoLite) Service Provider for Silex micro framework...

## Getting started ##

Supposing your Silex application is ready, you simply need to register the service provider speciying the directory path where databases will be stored.

```php
$app['root'] = __DIR__.'/..'

$app->register(new MongoLite\Silex\MongoLiteServiceProvider(), array(
    'mongolite.path' => $app['root'].'/config',
));
```

## Usage ##

Inside your application you can call `$app['mongolite']` which is a `MongoLite\Client` instance and also `$app['mongolite.db']` who is a `$app['mongolite']->defaultdb`

```php
$app->get('/mongolite', function () use ($app) {

    $database   = $app['mongolite.db']; // Or app['mongolite']->testdb for create a new database file
    $collection = $database->products;

    $entry = ["name"=>"Super cool Product", "price"=>20];

    $collection->insert($entry);

    $products = $collection->find(); // Get Cursor

    if ($products->count()) {

        foreach($products->sort(["price"=>1])->limit(5) as $product) {
            $data['product'] = $product;
        }
    }

    return $app['twig']->render('index.html', $data);
});
```

## Installation ##

Install MongoLite Service Provider using [Composer](https://getcomposer.org) PHP's package manager

Add the following to the composer.json file..
```
{
    "require": {
        "nbpalomino/mongo-lite-service-provider": "dev-master"
    }
}
```

Install composer (if it isn’t already installed):
```
curl -s https://getcomposer.org/installer | php
php composer.phar install
```