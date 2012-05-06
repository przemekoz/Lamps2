<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Image library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('getButton'))
{
	/**
	 * wyswietla przycisk
	 * @param string $text - text wyswietlany w title i na buttonie
	 * @param string $onclick - akcja JS
	 * @param string $type - green|red|grey
	 */
	function getButton($text, $onclick, $type='green') {
		$fontColor = 'white';
		if ($type == 'grey') {
			//$fontColor = '#889797';
			$fontColor = '#5f6969';
		}
		if ($type == 'green') {
			$fontColor = '#3C703C';
		}
		if ($type == 'red') {
			$fontColor = '#B24B4B';
		}

		//$btn  = '<div title="'.$text.'" onclick="'.$onclick.'" style="background: url(\'/img/btn_'.$type.'.png\') top left no-repeat;  width: 160px; height:62px; border:none; margin:0; padding:0; cursor: pointer">';
		//$btn .= '<div style="padding: 18px 0 0 0; text-align: center;  font-family: arial, sans-serif; font-size: 19px; line-height: 1.1em; font-weight: bold; color: '.$fontColor.'">'.$text.'</div>';
		$btn  = '<div title="'.$text.'" onclick="'.$onclick.'" style="background: url(\'/img/btn_'.$type.'.png\') top left no-repeat;  width: 120px; height:34px; border:none; margin:0; padding:0; cursor: pointer">';
		$btn .= '<div style="padding: 9px 0 0 0; text-align: center;  font-family: arial, sans-serif; font-size: 12px; line-height: 1.1em; font-weight: bold; color: '.$fontColor.'">'.$text.'</div>';
		$btn .= '</div>';

		return $btn;

	}

}
if ( ! function_exists('showButton'))
{
	/**
	 * wyswietla przycisk
	 * @param string $text - text wyswietlany w title i na buttonie
	 * @param string $onclick - akcja JS
	 * @param string $type - green|red|grey
	 */
	function showButton($text, $onclick, $type='green') {
		echo getButton($text, $onclick, $type);
	}

}

if ( ! function_exists('showSubmit'))
{
	/**
	 * wyswietla przycisk formurza  - submit
	 * @param string $text - text wyswietlany w title i na buttonie
	 */
	function showSubmit($text, $type='green') {
		$fontColor = '#3C703C';
		if ($type == 'grey') {
			$fontColor = '#889797';
		}
		if ($type == 'red') {
			$fontColor = '#B24B4B';
		}
		
		$btn = '<input type="submit" value="'.$text.'" title="'.$text.'" style="background: url(\'/img/btn_'.$type.'.png\') top left no-repeat;  width: 160px; height:62px; border:none; margin: 0; padding:0; cursor: pointer;font-family: arial, sans-serif; font-size: 19px; line-height: 1.1em; font-weight: bold; color: '.$fontColor.';">';
		echo $btn;
	}
}

if ( ! function_exists('getLink'))
{
	/**
	 * wyswietla przycisk formurza  - submit
	 * @param string $text - text wyswietlany w title i na buttonie
	 */
	function getLink($text, $href='', $onclick='', $isBig=false) {
		$size = 14;
		if ($isBig) {
			$size = 16;
		}

		$a = '<a style="font-weight:bold; color:#003D4C;font-size:'.$size.'px;font-family:verdana, sans-serif;" href="'.$href.'" onclick="'.$onclick.'" title="'.$text.'">'.$text.'</a>';
		return $a;
	}
}

if ( ! function_exists('showLink'))
{
	/**
	 * wyswietla przycisk formurza  - submit
	 * @param string $text - text wyswietlany w title i na buttonie
	 */
	function showLink($text, $href='', $onclick='', $isBig=false) {
		echo getLink($text, $href, $onclick, $isBig);
	}
}