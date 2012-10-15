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
class_exists( 'CacheHelper' ) OR require_once( dirname( __FILE__ ) . '/CacheHelper.class.php' );

/**
 * This is factory for constructing an instance of the CacheHelperFactory. It encapsulates the
 * configuration data of your memcached server, connecting to said server, and wrapping it
 * within a CacheHelper object. This is where you specify your memcached server configuration data.
 * @author craigb
 */
class CacheHelperFactory
{
	private $memcacheObject;
	private $cachePrefix;
	
	/**
	 * Constructs a new CacheHelperFactory. Utilizes configuring data hard coded within this constructor
	 * to connect to instance(s) of memcache server the application utilizes. This approach was
	 * chosen over having a separate configuration file for efficiency.
	 * @param String $cachePrefix The cache prefix unique to your application or module, which will prevent
	 * caching collisions with other applications or modules utilizing the same memcached instance.
	 */
	public function __construct( $cachePrefix )
	{
		// This is where you configure your memcached server data
		$this->cachePrefix = $cachePrefix;
		$this->memcacheObject = new Memcache( );
		
		/** SPECIFY MEMCACHED CONFIGURATION DATA HERE  **/
		// This assumes the memcached server is running locally, modify the URL as needed.
		// To add multiple server instances, simply call addServer( URL ) additional times.
		$this->memcacheObject->addServer( "localhost" );
		
	}
	
	/**
	 * Constructs a new CacheHelper, initializing it with the pre-configured memcacheObject and cache prefix.
	 * @return CacheHelper An initialized CacheHelper object.
	 */
	public function getCacheHelper( )
	{
		return new CacheHelper( $this->cachePrefix, $this->memcacheObject );
	}
}

?>