<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('contextMenuLink'))
{

	function contextMenuLink($linkName, $onclick, $icon=null) {
		
		$d = '/img/icon/';
		
		$i = '';
		//var_dump($_SERVER['DOCUMENT_ROOT'].$d.$icon);
		if (is_file($_SERVER['DOCUMENT_ROOT'].$d.$icon)) {
			$i = '<img src="'.$d.$icon.'" style="max-width:24px; max-height:24px; margin: 0 auto">';
		}
		
		//<div style="float:left; width:34px; /*background: red*/">&nbsp;</div>
		
		$html  = '<div onclick="'.$onclick.'" style="color:#555;  min-height: 25px; cursor: pointer; width:100%" onmouseover="this.style.background=\'#d3d3d3\'" onmouseout="this.style.background=\'#dbdbdb\'">';
		$html .= '<div style="float:left; width:20%;text-align:center">'.$i.'</div>';
		$html .= '<div style="float:left; width:80%"><div style="padding: 4px 2px 0 7px; font-family: tahoma; font-size: 12px; line-height: 1.2em">'.$linkName.'</div></div>';
		$html .= '<div style="clear:both"></div>';
		$html .= '</div>';
		return $html;
	}
}


if ( ! function_exists('showContextMenu'))
{
	function showContextMenu($arrayLinks, $cssId) {
		
		$html = '<div id="'.$cssId.'" style="width: 200px; border: 1px solid #dbdbdb; border-top-color: #eaeaea; border-right-color: #c4c4c4; border-bottom-color: #b8b8b8; background: #dbdbdb;display: none; position: absolute; top: 0; left: 0; z-index: 1000"><div style="padding: 2px">
			';
		$html .= implode($arrayLinks);
		$html .= '</div></div>';
		echo $html;
	}
}