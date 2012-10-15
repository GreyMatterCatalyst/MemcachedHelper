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

/**
 * This class encapsulates a piece of Cached data.
 * @author craigb
 */
class CacheData
{
	private $data;
	private $expirationTime;
	
	/**
	 * Constructs a new CacheData object.
	 * @param $data The data being cached.
	 * @param $expirationTime An expiration time to be associated with the cached data.
	 */
	public function __construct( $data, $expirationTime )
	{
		$this->data = $data;
		$this->expirationTime = $expirationTime;
	}
	
	/**
	 * Returns the cached data.
	 * @return The cached data.
	 */
	public function getData( )
	{
		return $this->data;
	}
	
	/**
	 * Returns the expiration time associated with the cached data.
	 * @return The expiration time associated with the cached data.
	 */
	public function getExpirationTime( )
	{
		return $this->expirationTime;
	}
}

?>