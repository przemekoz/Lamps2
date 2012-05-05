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

if ( ! function_exists('footer_html'))
{
	/**
	 * @return string - kod html 
	 */
	function footer_html() {
		
		$html = "
		<br clear=\"all\">
		<div style=\"background: #67806E; width:100%;height:50px;border-top:2px solid #674A3E;margin-top:40px;text-align:center\">
		<div style=\"margin:0 auto; width:1000px;text-align:left;\">
		<div style=\"width:500px;float:left;padding:21px 0 0 0\"><span style=\"color:white; font-family:arial, sans-serif; font-size:12px\">&copy; ".date('Y')."</span></div>
		<div style=\"width:500px;float:left;padding:21px 0 0 0;text-align:right\"><a href=\"https://twitter.com/#!/przemekoz\" target=\"_blank\" title=\"created by Przemek Koziński\" onmouseover=\"init()\" onfocus=\"blur()\" style=\"text-decoration: none;font-size:10px; font-family:arial, sans-serif;color:#3E4D42\">
@uthor<span id=\"line\" style=\"visibility:hidden\">:</span><span id=\"line2\"></span>
</a></div>
		<div style=\"clear:both\"></div>
		
		 
		</div>
		</div>
		<script type=\"text/javascript\">
	var string = ['p', '.', 'k', 'o', 'z', 'i', 'ń', 's', 'k', 'i'];

	var iter = 0;
	var iter2 = 0;

	var str = '';

	var interval = null;
	var interval2 = null;
	var interval3 = null;
	var timeout = null;
	
function show() {


	if (iter == string.length) {
		
		clearInterval(interval);
		interval = null;
		timeout = setTimeout('hide_pre()', 2000);
		return true;
	}	
	

	str += string[iter];
	document.getElementById('line2').innerHTML = str;
	iter++;
}

function hide_pre() {
	iter--;
	interval3 = setInterval('hide()', 30);
	clearTimeout(timeout);
	timeout = null;
}


function hide() {
	if (iter < 0) {
		iter = 0;
		iter2 = 0;
		clearInterval(interval3);
		interval3 = null;
		return true;
	}	

	
	str = '';
	for(var i=0; i<iter; i++) {
		str += string[i];
	}

	document.getElementById('line2').innerHTML = str;
	iter--;
	
	document.getElementById('line').style.visibility = 'hidden';
}

function blink() {

	if (iter2 == 5) {
		clearInterval(interval2);
		interval2 = null;
		interval = setInterval('show()', 40);
		return true;
	}
	
	if (iter2 % 2 == 0) {
		document.getElementById('line').style.visibility = 'visible';
	} else {
		document.getElementById('line').style.visibility = 'hidden';
	}
	
	iter2++;
}


function init() {

	if (interval3 != null || interval2 != null || interval != null || timeout != null) {
		return false;
	}
	
	interval2 = setInterval('blink()', 20);
}
</script>
		
		";
		
		return $html;
	}
}
