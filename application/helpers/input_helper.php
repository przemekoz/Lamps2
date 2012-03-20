<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */


if ( ! function_exists('inputTextarea'))
{
	function inputTextarea($label, $textarea_name, $textarea_value, $type='big') {

		$width = 304;
		$height = 354;
		$fontSize = 15;

		if ($type == 'big') {
			$width = 504;
			$height = 554;
			$fontSize = 17;
		}

		$inputWidth = $width - 9;
		$inputHeight = $height - 9;


		$html = '
		<label for="'.$textarea_name.'">'.$label.'</label>
		<div id="'.$textarea_name.'_wrapper" style="width: '.$width.'px; height: '.$height.'px; background: url(\'/img/textarea_'.$type.'.png\') no-repeat;;margin-bottom:10px">
			<div style="padding: 4px 0 0 5px;">
				<textarea id="'.$textarea_name.'_wrapper" name="'.$textarea_name.'" onfocus="textareaFocus(\''.$textarea_name.'_wrapper\', \''.$type.'\')" onblur="textareaBlur(\''.$textarea_name.'_wrapper\',\''.$type.'\')" style="width:'.$inputWidth.'px; height:'.$inputHeight.'px; border:none; font-family:arial, sans-serif; font-size:'.$fontSize.'px; line-height:1.1em; color:#4C2400; padding: 0 0 0 0; margin: 0 0 0 0; resize:none">'.$textarea_value.'</textarea>
			</div>
		</div>';

		return $html;
	}
}
if ( ! function_exists('inputForm'))
{
	function inputForm($label, $input_name, $input_value, $type, $mode) {

		$width = 304;
		$height = 34;
		$fontSize = 15;

		if ($type == 'big') {
			$width = 504;
			$height = 44;
			$fontSize = 17;
		}

		$inputWidth = $width - 9;
		$inputHeight = $height - 8;


		$html = '
		<label for="'.$input_name.'">'.$label.'</label>
		<div id="'.$input_name.'_wrapper" style="width: '.$width.'px; height: '.$height.'px; background: url(\'/img/field_'.$type.'.png\') no-repeat;margin-bottom:10px">
			<div style="padding: 4px 0 0 5px;">
				<input type="'.$mode.'" value="'.$input_value.'" name="'.$input_name.'" onfocus="inputFocus(\''.$input_name.'_wrapper\', \''.$type.'\')" onblur="inputBlur(\''.$input_name.'_wrapper\',\''.$type.'\')" style="width:'.$inputWidth.'px; height:'.$inputHeight.'px; border:none; font-family:arial, sans-serif; font-size:'.$fontSize.'px; line-height:1em; color:#4C2400; padding: 0 0 0 0; margin: 0 0 0 0">
			</div>
		</div>';

		return $html;
	}
}

if ( ! function_exists('inputText'))
{
	function inputText($label, $input_name, $input_value='', $type='big') {
		$mode='text';

		return inputForm($label, $input_name, $input_value, $type, $mode);
	}
}

if ( ! function_exists('inputPassword'))
{
	function inputPassword($label, $input_name, $input_value='', $type='big') {
		$mode='password';

		return inputForm($label, $input_name, $input_value, $type, $mode);
	}
}

if ( ! function_exists('inputFile'))
{
	function inputFile($label, $name, $file='') {

		$d = '/uploads/';

		
		$html  = '<label for="'.$name.'">'.$label.'</label>';
		$html .= '<input type="file" name="'.$name.'">';
		if(is_file($_SERVER['DOCUMENT_ROOT'].$d.$file)) 
			$html .= '<img src="'.$d.$file.'" style="max-width: 200px; max-height: 200px"><br><br>'; 
		
		return $html;
	}
}
