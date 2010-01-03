<?php

/**
 * Cache class that stores cached content in Redis server.
 *
 * @package    sfRedisCachePlugin
 * @subpackage cache
 * @author     Thomas Parisot <thomas@oncle-tom.net>
 * @version    SVN: $Id$
 */
class sfRedisCache extends sfCache
{
  protected $redis = null;

  /**
   * Checks for the existence of Redis object, through the PHP Lib (libphp-redis) or PHP Module (phpredis)
   *
   * Available options :
   * * redis:  a redis object (not mandatory)
   * * class:  the Redis class we try to load (default to Redis)
   *
   * * mode:   Defines if we work with the "compiled" (faster) or "shared" (easier) library (default to "shared")
   * * port:   The default port (default to 6379)
   * * server: The default server (default to 127.0.0.1)
   * 
   * @see sfCache
   */
  public function initialize($options = array())
  {
    parent::initialize($options);

    if($this->getOption('mode', 'shared') === 'shared' && !class_exists($this->getOption('class', 'Redis')))
    {
      include 'redis.php';
    }

    if (!class_exists($this->getOption('class', 'Redis')))
    {
      throw new sfInitializationException(sprintf('You must have %s installed as a compiled module or shared class.', $this->getOption('class', 'Redis')));
    }

    if (!method_exists($this->getOption('class', 'Redis'), 'expire'))
    {
      throw new sfInitializationException(sprintf('Your %s version of %s does not support expire method. Too bad, it will not work.', $this->getOption('mode', 'shared'), $this->getOption('class', 'Redis')));
    }

    $class = $this->getOption('class', 'Redis');
    $this->redis = $this->getOption('redis') ? $this->getOption('redis') : new $class;
    $this->redis->connect($this->getOption('server', '127.0.0.1'), $this->getOption('port', 6379));

    if (!$this->redis->ping())
    {
      throw new sfInitializationException(sprintf("Could not connect to redis server at %s:%s", $this->getOption('server', '127.0.0.1'), $this->getOption('port', 6379)));
    }
  }

  /**
   * @see sfCache
   */
  public function getBackend()
  {
    return $this->redis;
  }

 /**
  * @see sfCache
  */
  public function get($key, $default = null)
  {
    $value = $this->redis->get($this->getOption('prefix').$key);

    return null === $value ? $default : $value;
  }

  /**
   * @see sfCache
   */
  public function has($key)
  {
    return $this->redis->exists($this->getOption('prefix').$key);
  }

  /**
   * @see sfCache
   */
  public function set($key, $data, $lifetime = null)
  {
    $lifetime = null === $lifetime ? $this->getOption('lifetime') : $lifetime;

    if ($lifetime < 1)
    {
      $response = $this->remove($key);
    }
    else
    {
      $this->setMetadata($key, $lifetime);
      $response = $this->redis->set($this->getOption('prefix').$key, $data, false);
      $this->redis->expire($this->getOption('prefix').$key, $lifetime);
    }

    return $response;
  }

  /**
   * @see sfCache
   */
  public function remove($key)
  {
    $this->deleteMetadata($key);
    return $this->redis->delete($this->getOption('prefix').$key);
  }

  /**
   * @see sfCache
   */
  public function clean($mode = sfCache::ALL)
  {
    if (sfCache::ALL === $mode)
    {
      $this->removePattern('*');
    }
  }

  /**
   * Optimized getMany with Redis mget method
   * 
   * @param array $keys
   * @return array
   */
  public function getMany($keys)
  {
    $cache_keys = array_map(array($this, 'applyPrefix'),  $keys);
    
    return array_combine($keys, $this->redis->mget($cache_keys));
  }

  /**
   * @see sfCache
   */
  public function getLastModified($key)
  {
    return $this->redis->get($this->getOption('prefix').'lastmodified'.self::SEPARATOR.$key);
  }

  /**
   * Checks if a key is expired or not
   *
   * @author oncletom
   * @param string $key
   * @return boolean
   */
  public function isExpired($key)
  {
    return time() > $this->getTimeout($key);
  }

  /**
   * @see sfCache
   */
  public function getTimeout($key)
  {
    return $this->redis->get($this->getOption('prefix').'timeout'.self::SEPARATOR.$key);
  }

  /**
   * We manually remove keys as the redis glob style * == sfCache ** style
   *
   * @author oncletom
   * @see sfCache
   */
  public function removePattern($pattern)
  {
    $keys = $this->redis->keys($this->getOption('prefix').$pattern);

    $regexp = self::patternToRegexp($this->getOption('prefix').$pattern);
    foreach ($keys as $key)
    {
      if (preg_match($regexp, $key))
      {
        $this->remove(substr($key, strlen($this->getOption('prefix'))));
      }
    }
  }

  /**
   * Stores metada for a key
   *
   * Why storing timeout despite we have an expire/ttl method? Because the PHP library in 0.1v does not have tll method
   *
   * @protected
   * @author oncletom
   * @param string $key
   * @param integer $lifetime
   * @return string Redis Reply Type
   */
  protected function setMetadata($key, $lifetime)
  {
    $response = $this->redis->set($this->getOption('prefix').'lastmodified'.self::SEPARATOR.$key, time());
    $this->redis->set($this->getOption('prefix').'timeout'.self::SEPARATOR.$key, time() + $lifetime);

    $this->redis->expire($this->getOption('prefix').'lastmodified'.self::SEPARATOR.$key, $lifetime);
    $this->redis->expire($this->getOption('prefix').'timeout'.self::SEPARATOR.$key, $lifetime);

    return $response;
  }

  /**
   * Deletes every metadata related to a key
   *
   * @author oncletom
   * @param string $key
   * @return boolean
   */
  protected function deleteMetadata($key)
  {
    $this->redis->delete($this->getOption('prefix').'lastmodified'.self::SEPARATOR.$key);
    return !!$this->redis->delete($this->getOption('prefix').'timeout'.self::SEPARATOR.$key);
  }

  /**
   * Apply prefix to a value
   *
   * Usefull to be mapped on an array. Faster than foreach
   *
   * @protected
   * @author oncletom
   * @param string $value
   * @return string
   */
  protected function applyPrefix($value)
  {
    return $this->getOption('prefix').$value;
  }
}
