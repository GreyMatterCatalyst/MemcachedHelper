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

class_exists( 'BlogData' ) OR require_once( dirname( __FILE__ ) . '/BlogData.class.php' );

/**
 * This is a very contrived class representing some hypothetical DB data source. It simply loads the same BlogData object each time
 * for the purposes of the example code in test.php
 * @author craigb
 */
class DbInterface
{
	private static $singleton;
	
	private function __construct( )
	{
	}
	
	public static function getInstance( )
	{
		if ( DbInterface::$singleton == null )
		{
			DbInterface::$singleton = new DbInterface( );
		}
		
		return DbInterface::$singleton;
	}
	
	public function getLatestBlogPost( )
	{
		$blogData = new BlogData( 1, 'Sad de moi', 'EmoBoy', '10/12/2010', 'Dear gentle readers,<br/> Life is so hard. Woe is me. Nobody understands me but you :(' );
		return $blogData;
	}

}

?>