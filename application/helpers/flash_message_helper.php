<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Div library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */

if ( ! function_exists('flash_message'))
{
	function flash_message($msg, $type) {
		
		
		switch($type) {
			case 'green':
				$style="green";				
				break; 
			
			case 'red':
				$style="red";				
				break; 

			case 'yellow':
			default:
				$style="yellow";				
				break; 
		}
		
		
		return "<div style=\"background:{$style}; width: 100%; padding: 5px 0\">{$msg}</div>";
	}
}	
if ( ! function_exists('flash_message_ok'))
{
	function flash_message_ok($msg) {
		return flash_message($msg, 'green');
	}
}	
if ( ! function_exists('flash_message_fail'))
{
	function flash_message_fail($msg) {
		return flash_message($msg, 'red');
	}
}	
if ( ! function_exists('flash_message_info'))
{
	function flash_message_info($msg) {
		return flash_message($msg, 'yellow');
	}
}	