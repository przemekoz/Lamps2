<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Image library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('errorlog'))
{
	function errorlog($message, $dir='') {

		//jesli zostala podana sciezka
		if (!strlen($dir)) {
			$dir = '__debug';
		}

		//jesli nie mozna pisac do katalogu - proba zapisu do katalogu g³ownego
		if (!is_writable($dir)) {
			$dir = $_SERVER['DOCUMENT_ROOT'].'/'.$dir;
		}

		//jesli nie mozna pisac do katalogu
		if (!is_writable($dir)) {
			return;
		}



		@file_put_contents($dir.'/error.log', date(' [Y-m-d H:i:s] ').$message."\r\n", FILE_APPEND);
	}
}


if ( ! function_exists('file_dump'))
{
	function file_dump($data, $cust_data='') {

		$str = date('[Y-m-d H:i:s]')." ";

		if (is_array($data)) {
			$str .= '-ARRAY- '. print_r($data, true);
		}
		elseif ($data === null) {
			$str .= '-NULL-';
		}
		elseif ($data === '') {
			$str .= '-EMPTY STRING-';
		}
		elseif (is_string($data) && strlen($data)) {
			$str .= '-STRING- :: '.$data;
		}
		elseif (is_numeric($data)) {
			$str .= '-NUMERIC- :: '.$data;
		}
		elseif (is_resource($data) == true) {
			$str .= '-RESOURCE- ::'.serialize($data);
		}


		if (strlen($cust_data)) {
			$str .= ' --'.$cust_data.'-- ';
		}

		$str .= "\r\n";


		//uwaga plik za kazdym razy nadpisywany
		@file_put_contents($_SERVER['DOCUMENT_ROOT'].'/uploads/debug.log', $str, FILE_APPEND);
	}
}
