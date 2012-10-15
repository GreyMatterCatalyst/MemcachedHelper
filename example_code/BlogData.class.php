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
 * This is an example of a simple data abstraction object, representing a hypothetical blog post, which is utilized in this example.
 * @author craigb
 */
class BlogData
{
	private $id;
	private $title;
	private $author;
	private $date;
	private $content;
	
	public function __construct( $id, $title, $author, $date, $content )
	{
		$this->id = $id;
		$this->title = $title;
		$this->author = $author;
		$this->content = $content;
		$this->date = $date;
	}
	
	public function getDate( )
	{
		return $this->date;
	}
	
	public function getId( )
	{
		return $this->id;
	}
	
	public function getAuthor( )
	{
		return $this->author;
	}
	
	public function getContent( )
	{
		return $this->content;
	}
	
	public function getTitle( )
	{
		return $this->title;
	}
}

?>