<?php

namespace Paradigms;

use DateInterval;
use DateTime;
use InvalidArgumentException;
use Psr\Cache\CacheItemInterface;
use Psr\Cache\CacheItemPoolInterface;


/**
 * Class CacheManager
 * 
 * @package Paradigms
 */
class CacheManager implements CacheItemPoolInterface
{
    /**
     * @var CacheStoreInterface
     */
    private $store;

    /**
     * CacheManager constructor.
     * 
     * @param CacheStoreInterface $store
     */
    public function __construct(CacheStoreInterface $store)
    {
        $this->store = $store;
    }

    /**
     * @param string $key
     * 
     * @return CacheItemInterface
     */
    public function getItem(string $key): CacheItemInterface
    {
        $item = $this->store->retrieve($key);

        return $item ? $item->toPsrItem() : new CacheItem($key);
    }

    /**
     * @inheritDoc
     */
    public function getItems(array $keys = []): array
    {
        $items = [];
        foreach ($keys as $key) {
            $items[$key] = $this->getItem($key);
        }

        return $items;
    }

    /**
     * @inheritDoc
     */
    public function hasItem($key): bool
    {
        return $this->store->has($key);
    }

    /**
     * @inheritDoc
     */
    public function clear(): bool
    {
        return $this->store->clear();
    }

    /**
     * @inheritDoc
     */
    public function deleteItem($key): bool
    {
        return $this->store->forget($key);
    }

    /**
     * @inheritDoc
     */
    public function deleteItems(array $keys): bool
    {
        return $this->store->forgetMany($keys);
    }

    /**
     * @inheritDoc
     */
    public function save(CacheItemInterface $item): bool
    {
        return $this->store->store(
            $item->getKey(),
            $item->get()
        );
    }

    /**
     * @inheritDoc
     */
    public function saveDeferred(CacheItemInterface $item): bool
    {
        return $this->save($item);
    }

    /**
     * @inheritDoc
     */
    public function commit(): bool
    {
        // No need for explicit commit in PSR-6.
        return true;
    }
}

/**
 * Class CacheItem
 * 
 * @package Paradigms
 */
class CacheItem implements CacheItemInterface
{
    /**
     * @var string
     */
    private $key;

    /**
     * @var mixed
     */
    private $value;

    /**
     * @var int|null
     */
    private $expiration;

    /**
     * @var bool
     */
    private $isHit;


    /**
     * CacheItem constructor.
     * 
     * @param string $key
     * @param mixed $value
     * @param int|null $expiration
     */
    public function __construct($key, $value = null, $expiration = null)
    {
        $this->key = $key;
        $this->value = $value;
        $this->expiration = $expiration;
        $this->isHit = false;
    }

    /**
     * @return CacheItem
     */
    public function getKey(): string
    {
        return $this->key;
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * Indicates if the current item is a hit or a miss.
     * 
     * @return bool
     */
    public function isHit(): bool
    {
        return $this->isHit;
    }

    /**
     * A value can be associated with a cache item when it is created.
     * 
     * @return CacheItem
     */
    public function set($value): CacheItemInterface
    {
        $this->value = $value;
        $this->isHit = true;

        return $this;
    }

    /**
     * Expires the cache item at the specified expiration time.
     * 
     * @param int|null $expiration
     * 
     * @return CacheItem
     */
    public function expiresAt($expiration): CacheItemInterface
    {
        $this->expiration = $expiration;

        return $this;
    }

    /**
     * Expires the cache item after the specified interval.
     * 
     * @param DateInterval|int|null $time
     * 
     * @return CacheItem
     */
    public function expiresAfter($time): CacheItem
    {
        if ($time instanceof DateInterval) {
            $now = new DateTime();
            $now->add($time);
            $this->expiration = $now;
        } elseif (is_int($time)) {
            $this->expiration = time() + $time;
        } else {
            throw new InvalidArgumentException('Invalid expiration time.');
        }

        return $this;
    }

    /**
     * Get the expiration time of the cache item.
     * 
     * @return \Psr\Cache\CacheItemInterface
     */
    public function getExpiration(): ?int
    {
        return $this->expiration;
    }
}



/**
 * Interface CacheStoreInterface
 * 
 * @package Paradigms
 */
interface CacheStoreInterface
{
    public function retrieve($key);

    public function store($key, $value, $expiration = null);

    public function has($key);

    public function forget($key);

    public function forgetMany(array $keys);

    public function clear();
}


/**
 * Class MemoryStore
 * A simple in-memory cache store.
 * 
 * @package Paradigms
 */
class MemoryStore implements CacheStoreInterface
{
    /**
     * @var array<string, CacheItem>
     */
    private $cache = [];

    /**
     * @inheritDoc
     */
    public function retrieve($key)
    {
        return isset($this->cache[$key]) ? $this->cache[$key] : null;
    }

    /**
     * @inheritDoc
     */
    public function store($key, $value, $expiration = null): bool
    {
        $this->cache[$key] = new CacheItem($key, $value, $expiration);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function has($key)
    {
        return isset($this->cache[$key]);
    }

    /**
     * @inheritDoc
     */
    public function forget($key)
    {
        unset($this->cache[$key]);

        return true;
    }

    /**
     * @inheritDoc
     */
    public function forgetMany(array $keys)
    {
        foreach ($keys as $key) {
            unset($this->cache[$key]);
        }

        return true;
    }

    /**
     * @inheritDoc
     */
    public function clear()
    {
        $this->cache = [];

        return true;
    }
}


/**
 * Class FileStore
 * A simple file-based cache store.
 * 
 * @package Paradigms
 */
class FileStore implements CacheStoreInterface
{
    /**
     * The cache directory.
     * 
     * @var string
     */
    private $directory;

    /**
     * The cache file extension.
     * 
     * @var string
     */
    private $extension;

    public function __construct($directory, $extension = '.cache')
    {
        $this->directory = rtrim($directory, '/');
        $this->extension = $extension;
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function retrieve($key)
    {
        $filename = $this->getFilename($key);

        if (!file_exists($filename)) {
            return null;
        }

        $content = file_get_contents($filename);
        $data = unserialize($content);

        if ($data['expiration'] > 0 && time() > $data['expiration']) {
            $this->forget($key);
            return null;
        }

        return new CacheItem($key, $data['value'], $data['expiration']);
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function store($key, $value, $expiration = null): bool
    {
        $filename = $this->getFilename($key);
        $data = [
            'value' => $value,
            'expiration' => $expiration > 0 ? time() + $expiration : 0,
        ];

        $content = serialize($data);
        $result = file_put_contents($filename, $content);

        return $result !== false;
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function has($key)
    {
        $filename = $this->getFilename($key);

        return file_exists($filename);
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function forget($key)
    {
        $filename = $this->getFilename($key);

        if (file_exists($filename)) {
            return unlink($filename);
        }

        return false;
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function forgetMany(array $keys)
    {
        $success = true;

        foreach ($keys as $key) {
            if (!$this->forget($key)) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    public function clear()
    {
        $files = glob($this->directory . '/*' . $this->extension);
        $success = true;

        foreach ($files as $file) {
            if (!unlink($file)) {
                $success = false;
            }
        }

        return $success;
    }

    /**
     * Get the cache filename for the given key.
     * 
     * @param string $key
     * 
     * @return string
     */
    private function getFilename($key)
    {
        $key = md5($key);

        return $this->directory . '/' . $key . $this->extension;
    }
}
