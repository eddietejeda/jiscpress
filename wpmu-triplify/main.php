<?php
/***************************************************************************
Plugin Name: WPMU Triplify
Plugin URI: http://code.google.com/p/jiscpress
Description: Allows Triples to be created for WPMU on sub directories
Version: 0.1
Author: Alex Bilbie
Author URI: http://www.alexbilbie.com/

Copyright 2009 University of Lincoln <jwinn@lincoln.ac.uk>
	
	This program is free software; you can redistribute it and/or modify
    it under the terms of the FreeBSD License:
	http://www.freebsd.org/copyright/freebsd-license.html

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    FreeBSD License for more details.
***************************************************************************/
/*
 * This plugins presumes that the Triplify application is installed at http://your.domain.com/triplify and you are using
 * the config script from http://code.google.com/p/jiscpress
 */

/**
 * @package Triplify
 * Looks for a query string of 'triplfy' and displays a triple as a result
 */

function triplify_init()
{
	//die("bob");
	global $blog_id;
	if(isset($_REQUEST['triplify']))
	{
		$http = 'http://';
		$https = $_SERVER['HTTPS'];
		if(!empty($https)){ 
			$http = 'https://';
		}
		header('Location: '.$http.$_SERVER['SERVER_NAME'].'/triplify/'.$blog_id.'/');
	}
}

add_action('init', triplify_init()); 
?>