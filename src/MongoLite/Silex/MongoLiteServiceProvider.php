<?php

/*
 * MongoLite Service Provider for Silex microframework.
 *
 * (c) Nick B. Palomino <nbpalomino@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MongoLite\Silex;

use Silex\Application;
use Silex\ServiceProviderInterface;
use MongoLite\Client;

/**
 * MongoLite Service Provider.
 *
 * @author Nick B. Palomino <nbpalomino@gmail.com>
 */
class MongoLiteServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        // Default directory for databases
        $app['mongolite.path'] = __DIR__;

        // Create MongoLite\Client instance
        $app['mongolite'] = $app->share(function ($app) {
            return new Client($app['mongolite.path']);
        });

        // Create MongoLite default database
        $app['mongolite.db'] = $app->share(function ($app) {
            return $app['mongolite']->defaultdb;
        });
    }

    public function boot(Application $app)
    {
    }
}
