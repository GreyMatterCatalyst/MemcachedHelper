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
 * This is an example script which demonstrates how you could go about utilizing this library
 * in an actual web application.
 * @author craigb
 */

/* dependencies */
class_exists( 'DbInterface' ) OR require_once( 'DbInterface.class.php' );
class_exists( 'BlogData' ) OR require_once( 'BlogData.class.php' );
class_exists( 'CacheHelperFactory' ) OR require_once( 'CacheHelperFactory.class.php' );
class_exists( 'CacheHelper' ) OR require_once( 'CacheHelper.class.php' );
class_exists( 'CacheData' ) OR require_once( 'CacheData.class.php' );
interface_exists( 'CacheDataLoader' ) OR require_once( 'CacheDataLoader.php' );

/**
 * This is a very simple example class demonstrating how to implement the CacheDataLoader interface
 * in order for it to be used by the CacheHelper. It simply loads the latest blog post
 * from the hypothetical data source.
 */
class MyDataLoader implements CacheDataLoader
{
	private $foo;
	
	/**
	 * @param string $key The key of the data being loaded.
	 * @return CacheData The loaded cache data object.
	 */
	public function loadData( $key )
	{
		$dbInterface = DbInterface::getInstance( );
		$latestBlogPost = $dbInterface->getLatestBlogPost( );
		return new CacheData( $latestBlogPost, 300 );
	}
}

/* The following code shows in essence the bread and butter way you would go about utilizing
 * this library throughout your application.
 */
 
// construct your data source 
$myDataLoader = new MyDataLoader( );
// construct the cache helper factory, specifying your module's cache prefix
$cacheHelperFactory = new CacheHelperFactory( 'emo.boy' );
// get an instance to a cache helper object
$cacheHelper = $cacheHelperFactory->getCacheHelper( );

/* Use cache helper to retrieve the data being displayed on this page, if the data hasn't already been
 * cached, then the helper will utilized the specified data loader to initially load it from your data source.
 * Once this initial load has occurred, subsequent executions of the script will load the data directly from cache
 * until the cache data expires.
 */
$newestBlogPost = $cacheHelper->getData( 'newestBlogPost', $myDataLoader );

?>

<html>
<head>
<title>Emo Boy's Tragic Life</title>

<style type="text/css">
body
{
	background-color: #000000;
	color: #FF0000;
	font-size: 20;
}
h1
{
	text-align:center;
}
</style>

</head>

<body>
<div>
<h1>Emo Boy's Tragic Life</h1>
</div>

<div>
<h3>Latest Post</h3>
</div>

<div>
	<div>Title: <?=$newestBlogPost->getTitle( )?></div>
	<div>Date: <?=$newestBlogPost->getDate( )?></div>
	<br/>
	<div>
	<?=$newestBlogPost->getContent( );?>
	</div>
</div>

</body>
</html>

