<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 *
 * author: Przemek Kozinski
 * copyright: (c) 2012
 */
if ( ! function_exists('notify'))
{
	/**
	 * Funkcja wyświetla notyfikację, po czasie $duration notyfikacja znika 
	 * 
	 * @param string $text
	 * @param string $color - kolor tekstu
	 * @param int $duration - czas trwania wyświetlania informacji (milisekundy)
	 */
	function notify($text, $color='white', $duration=4000) {

		/* jesli nie ma tekstu -> wylot */
		if (empty($text)) {
			return false;
		}
		
		@header('Content-Type: text/html; charset=UTF-8'); 
		echo 
		'
			<script src="/javascript/jquery-1.6.1.min.js" type="text/javascript"></script>
			<script src="/javascript/ui.core.min.js" type="text/javascript"></script>

			<div id="notify" style="display:none; width:100%; position:absolute; top:0; left:0; background:black; color:white; opacity:0.7;">
				<!-- this layer set the height of div - the text is not visible -->
				<div style="text-align:center; color:black; padding:30px 0; opacity:0.7">'.$text.'</div> 
			</div>
			
			<div id="notify_text" style="display:none; width:100%; position:absolute; top:0; left:0;">
				<div style="text-align:center; color:'.$color.'; padding:30px 0; font-family: arial, sans-serfi; font-size:14px; line-height:1.3em">'.$text.'</div> 
			</div>

			<script type="text/javascript">
			var nt = null;
			function show_notify() {
				$("#notify").fadeIn(150);
				$("#notify_text").fadeIn(160);
				nt = setTimeout("hide_notify()",'.$duration.');
			}
			
			function hide_notify() {
				$("#notify_text").fadeOut(380);
				$("#notify").fadeOut(400);
				clearTimeout(nt);
			}
			show_notify();
			</script>
		';
	}
}