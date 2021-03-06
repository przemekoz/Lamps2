<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Image library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */

class PK_UtilImage {



	public function __construct() {
		if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			errorlog('Cannot initialize GD');
		}
	}

	/**
	 * Metoda tworzy obrazek w pamieci
	 * @param $width int
	 * @param $height int
	 * @param $isTransparentBg bool - gdy ustawione na TRUE, tworzony obrazek z przezroczystym t�em
	 * @return resource
	 */
	public function createimage($width, $height, $isTransparentBg=false) {
		$img = @imagecreatetruecolor($width, $height)
		or errorlog('Cannot run imagecreatetruecolor() in '.__CLASS__);

		//zwraca obrazek bez przezroczystego tla
		if (!$isTransparentBg) {
			return $img;
		}
			
		@imagealphablending($img, false)
		or errorlog('Cannot run imagealphablending() in '.__CLASS__);
			
		@imagesavealpha($img,true)
		or errorlog('Cannot run imagesavealpha() in '.__CLASS__);
			
		if( $transparent = @imagecolorallocatealpha($img, 255, 255, 255, 127) === FALSE ) {
			errorlog('Cannot run imagecolorallocatealpha() in '.__CLASS__);
		}
			
		@imagefilledrectangle($img, 0, 0, $width, $height, $transparent)
		or errorlog('Cannot run imagefilledrectangle() in '.__CLASS__);
			
			
		return $img;
	}

	/**
	 * Metoda wczytuje obrazek z dysku - rozpoznawanie typu na podstawie rozszerzenia
	 * @param $filename string
	 * @return resource
	 */
	public function getimage($filename) {

		$filename = strtolower($filename);

		if (!is_file($filename)) {
			$filename = $_SERVER['DOCUMENT_ROOT'].'/'.$filename;
		}

		if (!is_file($filename) || !is_readable($filename)) {
			errorlog('Cannot read image file:'.$filename);
			return false;
		}

		if (preg_match('/\.gif/', $filename)) {
			$img = @imagecreatefromgif($filename);
		}
		elseif (preg_match('/\.jpg/', $filename) || preg_match('/\.jpeg/', $filename)) {
			$img = @imagecreatefromjpeg($filename);
		}
		elseif (preg_match('/\.png/', $filename)) {
			$img = @imagecreatefrompng($filename);
		}
		else {
			errorlog('Cannot recognize image type');
			$img = 0;
		}

		if ($img === FALSE) {
			errorlog('Cannot create image from imagecreatefrom...()');
		}

		return $img;
	}

	/**
	 * Metoda kopiuje jeden obrazek na drugi
	 */
	public function imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h) {
		@imagecopy($dst_im, $src_im, $dst_x, $dst_y, $src_x, $src_y, $src_w, $src_h)
		or errorlog('Cannot run imagecopy() '.__CLASS__);
	}

	/**
	 * Zapisuje obrazek na dysku
	 * @param string $mode - gdy ustawione na 'flip' zapisuje sie rowniez lustrzane odbicie
	 */
	public function imagesave($img_resource, $filename, $type='PNG') {

		$res = TRUE;
		if (strtoupper($type) == 'PNG') {
			$res = @imagepng($img_resource, $filename.'.png');
		}
		if (strtoupper($type) == 'JPG') {
			$res = @imagejpeg($img_resource, $filename.'.jpg', 85);
		}
		
		if (!$res) {
			errorlog('Cannot write image: '.$filename);
		}

	}
	
	/**
	 * Zapisuje obrazek na dysku - łacznie z lustrzanym odbiciem
	 *
	 */
	public function imagesaveflip($img_resource, $filename, $type='PNG') {

		$dir = 'uploads/tmp/';
		
		//zapsanie obrazka normalnego
		$this->imagesave($img_resource, $dir.$filename, $type);

		$flipImg = $this->flip($img_resource);
			
		//zapsanie obrazka normalnego
		$this->imagesave($flipImg, $dir. 'inv_'.$filename, $type);
		$this->imagedestroy($flipImg);
	}
	

	/**
	 * Usuwa obrazek z pami�ci
	 */
	public function imagedestroy($img_resource) {
		@imagedestroy($img_resource)
		or errorlog('Cannot destroy image');
	}

	/**
	 * Skaluje obrazek
	 */
	public function imageresize($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h) {
		@imagecopyresampled($dst_image, $src_image, $dst_x, $dst_y, $src_x, $src_y, $dst_w, $dst_h, $src_w, $src_h)
		or errorlog('Cannot resize image');
	}

	/**
	 * 
	 * odwraca obrazek
	 * @param resource $imgsrc
	 * @param int $mode
	 */
	public function flip($imgsrc, $mode = 2) {
		$width = imagesx($imgsrc);
		$height = imagesy($imgsrc);

		$src_x = 0;
		$src_y = 0;
		$src_width = $width;
		$src_height = $height;

		switch ($mode) {

			case '1': //vertical
				$src_y = $height - 1;
				$src_height = -$height;
				break;

			case '2': //horizontal
				$src_x = $width - 1;
				$src_width = -$width;
				break;

			case '3': //both
				$src_x = $width - 1;
				$src_y = $height - 1;
				$src_width = -$width;
				$src_height = -$height;
				break;

			default:
				return $imgsrc;
		}

		$imgdest = $this->createimage($width, $height, true);
		
		$this->imageresize($imgdest, $imgsrc, 0, 0, $src_x, $src_y, $width, $height, $src_width, $src_height);
		return $imgdest;
	}
}

?>