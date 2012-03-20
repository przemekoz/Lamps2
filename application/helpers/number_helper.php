<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
| funkcje operowania na liczbach 
|author: Przemek Kozinski
|copyright: (c) 2012
*/

if ( ! function_exists('number_format_my'))
{
	function number_format_ci($number) {
		return number_format($number, 2, '.', '');
	}
}

if ( ! function_exists('discount_price'))
{
	function discount_price($price, $discount=0) {
		return $price - ($discount * $price / 100);
	}
}