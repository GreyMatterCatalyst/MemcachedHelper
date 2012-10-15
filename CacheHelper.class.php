<?php

/**
 * MemcachedHelper: A PHP convenience library for Memcached
 * Copyright (C) 2012  Craig Barber
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/* dependencies */
class_exists( 'CacheData' ) OR require_once( dirname( __FILE__ ) . '/CacheData.class.php' );
interface_exists( 'CacheDataLoader' ) OR require_once( dirname( __FILE__ ) . '/CacheDataLoader.php' );

/**
 * This class wraps around an instantiated Memcache object, providing convenience functionality for
 * storing and accessing data from said cache.
 * @author craigb
 */
class CacheHelper
{
	private $cachePrefix;
	private $memcacheObject;
	
	/**
	 * Constructs a new CacheHelper object.
	 * @param String $cachePrefix A prefix unique to the application or module utilizing the CacheHelper. This will
	 * be used by this class to help prevent cache collisions between other applications or modules utlizing the
	 * memcache instance.
	 * @param Memcache $memcacheObject The instantiated memcached object this class will wrap around and utilize for
	 * storing and accessing cached data.
	 */
	public function __construct( $cachePrefix, Memcache $memcacheObject )
	{
		$this->cachePrefix = $cachePrefix;
		$this->memcacheObject = $memcacheObject;
	}
	
	/**
	 * Deletes the data associated with the specified key from the cache.
	 * @param String $cacheKey The key associated with the data to be deleted.
	 * @return void
	 */
	public function deleteData( $cacheKey )
	{
		$this->memcacheObject->delete( $this->getCachePrefix( ) . $cacheKey );
	}
	
	/**
	 * Manually sets the data in the cache, associating it with the specified key. This is helpful when you know data
	 * has been updated and you want to ensure the accuracy of that data in the cache.
	 * @param String $cacheKey The key which will be associated with the cached data.
	 * @param CacheData $cacheData The data to be cached.
	 * @return void
	 */
	public function setData( $cacheKey, CacheData $cacheData )
	{
		$this->memcacheObject->set( $this->getCachePrefix( ) . $cacheKey, $cacheData->getData( ), $cacheData->getExpirationTime( ) );
	}
	
	/**
	 * Attempts to retrieve cached data associated with the specified key. If the data was not found in the cache,
	 * then the specified cache data loader will be utilized to retrieve the data, and then set in the cache.
	 * @param String $cacheKey The key associated with the data being retrieved.
	 * @param CacheDataLoader $cacheDataLoader The data source which will be used to load the data if it is not found in the cache.
	 * @return mixed The retrieved cached data.
	 */
	public function getData( $cacheKey, CacheDataLoader $cacheDataLoader )
	{
		$prefixedKey = $this->getCachePrefix( ) . $cacheKey;
		$retrievedData = $this->memcacheObject->get( $prefixedKey );
		
		if ( $retrievedData == null || empty( $retrievedData ) )
		{
			$cacheData = $cacheDataLoader->loadData( $cacheKey );
			$this->setData( $cacheKey, $cacheData );
			return $cacheData->getData( );
		}
		else
		{
			return $retrievedData;
		}
	}
	
	/**
	 * Returns the conifgured cache prefix for this helper object.
	 * @return String The configured cache prefix for this helper object.
	 */
	public function getCachePrefix( )
	{
		return $this->cachePrefix;
	}
}

?>