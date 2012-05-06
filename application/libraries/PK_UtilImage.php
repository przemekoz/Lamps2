<?php  if (!defined('BASEPATH')) exit('No direct script access allowed');

/***
 * Image library
 *
 * author: Przemek Kozinski
 * copyright: (c) 2011
 */

class PK_UtilImage {


	private $header;

	public function __construct() {
		if (!extension_loaded('gd') && !extension_loaded('gd2')) {
			errorlog('Cannot initialize GD');
		}
	}

	public function add_header($filename) {
		$this->header = $this->getimage($filename);
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
			$white 	= imagecolorallocate($img, 255, 255, 255);
			imagefilledrectangle($img, 0, 0, $width, $height, $white);
			return $img;
		}

		@imagealphablending($img, false)
		or errorlog('Cannot run imagealphablending() in '.__CLASS__);
			
		$transparent = @imagecolorallocatealpha($img, 255, 255, 255, 127);
			
		@imagefilledrectangle($img, 0, 0, $width, $height, $transparent)
		or errorlog('Cannot run imagefilledrectangle() in '.__CLASS__);
			
		//@imagealphablending($img,true)
		//or errorlog('Cannot run imagesavealpha() in '.__CLASS__);

		/* to nie wiem czy musi byc */
		@imagealphablending($img,false);
		@imagesavealpha($img,true);

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
	public function imagesave($img_resource, $filename, $type='PNG', $tInfo=array()) {


		/* jesli jest ustwaiony obrazek nagłówka */
		if (!empty($this->header)) {
			$wh = imagesx($this->header);
			$hh = imagesy($this->header);

			$w = imagesx($img_resource);
			$h = imagesy($img_resource);

			$width = $w > $wh ? $w : $wh;
			$height = $h + $hh;
				
			$img = $this->createimage($width, $height);
			$this->imagecopy($img, $this->header, floor(($width-$wh)/2),  0, 0, 0, $wh, $hh);
			$this->imagecopy($img, $img_resource, floor(($width-$w)/2), $hh, 0, 0, $w, $h);
			$img_resource = $img;
		}
		
		/* jesli na tle sa jakies produkty */
		if (!empty($tInfo)) {
			$font = $_SERVER['DOCUMENT_ROOT'].'/fpdf/arial.ttf';

			$h = imagesy($img_resource);
			$width = imagesx($img_resource);

			$height = $h + count($tInfo)*16+100;
				
			$img = $this->createimage($width, $height);
			$black 	= imagecolorallocate($img, 0, 0, 0);
			$this->imagecopy($img, $img_resource, 0, 0, 0, 0, $width, $h);
			
			$offset = $h+20;
			for ($i=0; $i<count($tInfo); $i++) {
				imagettftext($img, 11, 0, 0, $offset+($i*16), $black, $font, ($i+1).'. '.$tInfo[$i]);
			}

			$img_resource = $img;
		}

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

		$dir = 'uploads/';

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



	public function add_product_label($bg,$img, $x, $y, $text) {

		//jesli dlugosc tekstu do wstawienia wieksza niz 2 lub gdy nie ma tekstu --> wylot
		if (!strlen($text) || strlen($text) > 2) {
			return false;
		}

		$black 	= imagecolorallocate($bg, 0, 0, 0);
		$grey 	= imagecolorallocate($bg, 128, 128, 128);
		$white 	= imagecolorallocate($bg, 255, 255, 255);

		//$x = $x+imagesx($img)-10;
		//$y = $y+imagesy($img)-10;
		$x = $x + floor(imagesx($img)/2) - 10;
		$y = $y - 25;

		$text = strval($text);

		//ramka
		imagefilledrectangle($bg, $x-2, $y-2, $x+22, $y+22, $grey);
		//ramka
		imagefilledrectangle($bg, $x-1, $y-1, $x+21, $y+21, $black);
		//białe tło
		imagefilledrectangle($bg, $x, $y, $x+20, $y+20, $white);

		// Replace path by your own font path
		$font = $_SERVER['DOCUMENT_ROOT'].'/fpdf/arialbd.ttf';


		// Add the text
		$strlen = array(1=>6, 2=>1);
		imagettftext($bg, 12, 0, $x+$strlen[strlen($text)], $y+15, $black, $font, $text);
			
		return $bg;
	}


}

?>