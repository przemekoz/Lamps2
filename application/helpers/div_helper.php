<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Div library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */
if ( ! function_exists('divShadow'))
{
	/**
	 * helper dodaje kod html-owy diva razem z cieniem
	 * @param int $width  - szerokosc warstwy (lacznie z cieniami)
	 * @param int $height - wysokosc warstwy (lacznie z cieniami)
	 * @param int $padding - padding wewnatrz warstwy
	 * @return string - kod html 
	 */
	function divShadow($width, $height, $content, $padding=15) {
		
		$width = intval($width);
		$height = intval($height);
		$padding = intval($padding);
		
		
		$inWidth  = $width - 12;
		$inHeight  = $height - 12;
		
		$html = '
		<div style="width:'.$width.'px; height:'.$height.'px;">
				<div style="float:left;width:6px;height:6px;background:url(\'/img/sh_left_top.png\') top left no-repeat;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				<div style="float:left;width:'.$inWidth.'px;height:6px;background:url(\'/img/sh_top.png\') repeat-x;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				<div style="float:left;width:6px;height:6px;background:url(\'/img/sh_right_top.png\') top left no-repeat;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				<div style="clear:both"></div>
				<div style="float:left;width:6px;height:'.$inHeight.'px;background:url(\'/img/sh_left.png\') repeat-y"></div>
				<div style="float:left;width:'.$inWidth.'px;height:'.$inHeight.'px;background:#fff"><div style="padding:'.$padding.'px">'.$content.'</div></div>
				<div style="float:left;width:6px;height:'.$inHeight.'px;background:url(\'/img/sh_right.png\') repeat-y"></div>
				<div style="clear:both"></div>
				<div style="float:left;width:6px;height:6px;background:url(\'/img/sh_left_bottom.png\') top left no-repeat;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				<div style="float:left;width:'.$inWidth.'px;height:6px;background:url(\'/img/sh_bottom.png\') repeat-x;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				<div style="float:left;width:6px;height:6px;background:url(\'/img/sh_right_bottom.png\') top left no-repeat;padding:0;margin:0;font-size:1px;line-height:1px"></div>
				
				<div style="clear:both"></div>
		</div>
		';
		
		return $html;
	}
}
