sfRedisCachePlugin
==================

Redis is key/value persistent database. It's faster than APC, distributed like Memcache and most of all, it's not volatile.
On server restart, or shutdown, data will remain and even better, the lifetime of cached data is still calculated.

This plugin intends to make Redis server usable as a cache backend method for your factories, or directly, within your code.

**Notice**: despite the cache backend accepts a compiled Redis class, it requires to have at least the ``expire`` method.


Licence
-------

see LICENSE file


Requirements
------------

You need to have at least a decent Redis PHP class supporting those methods:
 * connect
 * delete
 * exists
 * expire
 * get
 * keys
 * mget
 * ping
 * set

So far, it has been unit-tested with the debian package ``libphp-redis``.
You can find out some other − yet unsupported − libraries:
 * [Predis](http://github.com/nrk/predis/)
 * [Rediska](http://rediska.geometria-lab.net/)
 * [phpredis](http://code.google.com/p/phpredis/) (initial compiled library)
 * [phpredis fork](http://github.com/owlient/phpredis) (improved compiled library)


Installation
------------

You can install easily the plugin through symfony CLI:
    symfony plugin:install sfRedisCachePlugin

Or through SVN repository by adding the following svn:external:
    sfRedisCachePlugin http://svn.symfony-project.com/plugins/sfRedisCachePlugin/trunk/

**Notice**: the trunk will one day branched if any compatibility issues appears.


Usage
-----

The main purpose of sfRedisCachePlugin is to use it as a cache backend for your factories.yml.
For example:

    view_cache:
      class: sfRedisCachePlugin
      param:
        host:                      127.0.0.1
        mode:                      shared
        port:                      6379
        prefix:                    %SF_APP_DIR%/template

As the class extends sfCache class, it follows the same usage.


Configuration
-------------

The class accepts some option parameters:
 * _class_': the Redis class we try to load (default to Redis)
 * _mode_:   Defines if we work with the "compiled" (faster) or "shared" (easier) library (default to "shared")
 * _host_:   The default server (default to 127.0.0.1)
 * _port_:   The default port (default to 6379)
 * _redis_:  a redis object (not mandatory)


Todo-list
---------

 * Support for clustering
 * Include autoloader