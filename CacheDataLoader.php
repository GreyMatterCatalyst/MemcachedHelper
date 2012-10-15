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
 * This interface defines a means for the CacheHelper to retrieve data from any data source
 * in a de-coupled way.
 * @author craigb
 */
interface CacheDataLoader
{
	/**
	 * Loads the data associated with the specified key from this data source.
	 * @param string $key The key of the data being loaded.
	 * @return CacheData The loaded cache data object.
	 */
	public function loadData( $key );
}

?>