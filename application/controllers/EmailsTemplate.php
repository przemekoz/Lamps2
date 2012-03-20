<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class EmailsTemplate extends CI_Controller {

	/**
	 * obiek klasy utilImage - klasa pomocniczych funckcji dot obazkow
	 * @var PK_UtilImage
	 */
	public $UI = null;

	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('div');
		$this->load->helper('email');
		$this->load->library('PK_UtilImage');
		$this->UI = new PK_UtilImage();
	}

	public function choose_template($id) {
		$this->load->library('ajax');

		$this->load->library('xml');
		$this->load->library('parser');
		$this->load->helper('select');

		$arr = array();
		if ($this->xml->load('views_emails/'.$id.'/fields')) {
			$arr = $this->xml->parse();


			foreach ($arr['xml'][0]['items'][0]['item'] as $i) {
				$data[ $i['title'][0]]['top'] = $i['y'][0];
				$data[ $i['title'][0]]['left'] = $i['x'][0];
				$data[ $i['title'][0]] = $data[ $i['title'][0].'_textarea'] = $i['desc'][0];
			}

			$this->db->select('header, content');
			$query = $this->db->get('preview_email');
			$row = $query->row_array();
			if (isset($row['header']) && strlen($row['header'])) {
				$data['header'] = $data['header_textarea'] = nl2br($row['header']);
				$data['header_textarea'] = str_replace('<br>', '', $data['header_textarea']);
				$data['header_textarea'] = str_replace('<br />', '', $data['header_textarea']);
			}
			if (isset($row['content']) && strlen($row['content'])) {
				$data['content'] = $data['content_textarea'] = nl2br($row['content']);
				$data['content_textarea'] = str_replace('<br>', '', $data['content_textarea']);
				$data['content_textarea'] = str_replace('<br />', '', $data['content_textarea']);
			}

			$data['header_class'] = 'class="caption"';
			$data['header_action'] = 'onclick="showTextarea(\'dheader\')"';
			$data['content_class'] = 'class="caption"';
			$data['content_action'] = 'onclick="showTextarea(\'dcontent\')"';
			$data['emailTemplate'] = $this->parser->parse('../views_emails/'.$id.'/template', $data, true);

			//$arrayValuesLabels = array('val1'=>'value 1', 'val2'=>'value 2', 'val3'=>'value 3');
			//$data['select'] = select_custom($arrayValuesLabels);
			$data['select_font'] = select_custom_extra('font');
			$data['select_size'] = select_custom_extra('size');
			$data['select_color'] = select_custom_extra('color');

			$this->load->view('email_template_choose', $data);

		}//if
	}//function




	function uploadBg()
	{
			
		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;

		$config['upload_path'] = 'uploads/tmp/';
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '2048'; //KB
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$config['overwrite']  = TRUE;
		$config['file_name']  = 'u'.$idUser.'bg.jpg';

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->do_upload('file');
		redirect('emailstemplate/drag');
	}


	public function drag() {
		$this->load->library('session');
		$this->load->helper('context_menu');
		$this->load->helper('buttons');





		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;






		/*
		 * odczytanie z katalogu obrazkow usera
		 * elementy: u{id_usera}_i{id_elementu}.png
		 * tlo: u{id_usera}bg.jpg
		 */
		$bg = '';
		$aItems = array();
		if ($handle = opendir('uploads/tmp')) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/^u'.$idUser.'_i[0-9]+\./', $file)) {
					$aItems[] = $file;
				}
				if (preg_match('/u'.$idUser.'bg\./', $file)) {
					$bg = $file.'?r'.rand(1,99); //dodane zeby nie bylo cachowania obrazkow w przegladare
				}
			}
			closedir($handle);
		}


		$data['bg'] = $bg;
		$data['items'] = $aItems;
		$data['userid'] = $idUser;


		$this->load->view('drag', $data);
	}//function



	public function pdf($type='I') {
		require('fpdf/fpdf.php');

		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;

		//@todo - trzeba sprawdzic czy obrazek zostal zapisany , jak nie to zapisa�

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World!');
		$pdf->Ln(10);
		$pdf->Image('uploads/tmp/u'.$idUser.'_saved.jpg');
		//$pdf->Output();
		return $pdf->Output($_SERVER['DOCUMENT_ROOT'].'uploads/tmp/u'.$idUser.'.pdf',$type);
	}


	public function choose_item() {
		
		$idUser = 1;
		
		$this->load->helper('choose_item');
		$this->load->helper('buttons');

		$step = isset($_GET['step']) 				? intval($_GET['step']) 	: 0;
		$columnId = isset($_GET['column']) 	? intval($_GET['column']) : 0;
		$crownId = isset($_GET['crown']) 		? intval($_GET['crown']) 	: 0;
		$fittingId = isset($_GET['fitting'])? intval($_GET['fitting']): 0;

		//jesli przekroczono 3 krok - zapis
		if ($step == 3) {
			$this->save_item();
			return true;
		}

		if ($step == 0) {
			$res = $this->db->query("SELECT id, code, 'column' as type FROM clmn ORDER BY code");
		} else if ($step == 1) {
			$res = $this->db->query("SELECT id, code, 'crown' as type FROM crown ORDER BY code");
		} else {
			$res = $this->db->query("SELECT id, code, 'fitting' as type FROM fitting ORDER BY code");
		}
		

		$aType = array('column', 'crown', 'fitting');

		$data['header'] = 'Step '.($step+1);
		$data['columnId'] = $columnId;
		$data['crownId'] = $crownId;
		$data['fittingId'] = $fittingId;
		$data['type'] = $aType[$step];
		$data['step'] = $step+1;
		$data['list'] = $res->result();
		$data['userid'] = $idUser;

		$this->load->view('choose_item', $data);

	}


	public function save_item() {
		echo 'SAVE ITEM ';

		
		$idUser = 1;
		
		
		$img = $this->UI->createimage(200, 550, true);

		//wczytaj i dodaj do nowego obrazka kolumne
		$column = $this->UI->getimage('uploads/column_'.intval($_GET['column']).'.png');
		$this->UI->imagecopy($img, $column, 0, 195, 0, 0, imagesx($column), imagesy($column));

		//wczytaj i dodaj do nowego obrazka korone
		$crown = $this->UI->getimage('uploads/crown_'.intval($_GET['crown']).'.png');
		$this->UI->imagecopy($img, $crown, 0, 120, 0, 0, imagesx($crown), imagesy($crown));

		//wczytaj i dodaj do nowego obrazka oprawe
		$fitting = $this->UI->getimage('uploads/fitting_'.intval($_GET['fitting']).'.png');
		$this->UI->imagecopy($img, $fitting, 0, 0, 0, 0, imagesx($fitting), imagesy($fitting));

		
		//zapisz calosc
		
		/*
		 *  @TODO
		 *  !! rand() zamienic na kolejne id !!
		 */
		//zapisz obrazek oraz jego lustrzane odbicie
		$this->UI->imagesaveflip($img, 'u'.$idUser.'_i'.rand(1,99), 'PNG');

		redirect('emailstemplate/drag');
	}



	//wczytuje obrazek dodnay przez usera
	public function get_bg_image($filename) {

		return $this->UI->getimage($filename);

		/*
		 * po testach wywalic !
		 *
		 $dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';
		 $filename = $dir.strtolower($filename);

		 if (!@is_file($filename) || !extension_loaded('gd')) {
			return false;
			}

			$im = false;
			if (preg_match('/\.gif/', $filename)) {
			$im = @imagecreatefromgif($filename);
			}
			if (preg_match('/\.jpg/', $filename) || preg_match('/\.jpeg/', $filename)) {
			$im = @imagecreatefromjpeg($filename);
			}
			if (preg_match('/\.png/', $filename)) {
			$im = @imagecreatefrompng($filename);
			}

			return $im;
			*/

	}//function

	//wyswietla obrazek
	public function get_image($filename) {

		$dir = $_SERVER['DOCUMENT_ROOT'].'/uploads/';

		$img = $this->get_bg_image($filename);

		imagejpeg($img, $dir.'generated_bg[id_usera_zalogowanego].jpg');

		imagedestroy($img);
	}//function





	public function ajax_save_image()
	{
		$aProducts = json_decode($_POST['products']);

		if (!is_array($aProducts)) {
			return false;
		}

		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;

		//wczytaj obrazek tla
		$bg = $this->UI->getimage('uploads/tmp/u'.$idUser.'bg.jpg');

		foreach ($aProducts as $key => $row) {
			/*
			 * $filename - plik obrazka
			 * $x - wsp x na canvasie
			 * $y - wsp y na canvasie
			 * $width - szerokosc obrazka jak > 0 to trzeba skalowac
			 * $height - wysokosc obrazka jak > 0 to trzeba skalowac
			 * $type - norm, invert - normalne czy lustrane odbicie
			 */
			list($filename, $x, $y, $width, $height, $type) = $row;

			if (!is_file($_SERVER['DOCUMENT_ROOT'].$filename)) {
				continue;
			}

			//dodaj nowy pobrazek
			$product = $this->UI->getimage($filename);

			//przeskalowany przez JS
			if ($width > 0 && $height > 0) {
				//utworzenie nowego obrazka
				$newImg = $this->UI->createimage($width, $height, true);
				$this->UI->imageresize($newImg, $product, 0, 0, 0, 0, $width, $height, imagesx($product), imagesy($product));
				$product = $newImg;
			}

			//naloz na t�o
			$this->UI->imagecopy($bg, $product, $x, $y, 0, 0, imagesx($product), imagesy($product));
			$this->UI->imagedestroy($product);
		}


		$this->UI->imagesave($bg, 'uploads/tmp/u'.$idUser.'_saved', 'JPG');
		$this->UI->imagedestroy($bg);
	}


	public function download($file, $type='pdf') {

		// Set headers
		@header("Cache-Control: public");
		@header("Content-Description: File Transfer");
		@header("Content-Disposition: attachment; filename=$file");
		if ($type == 'pdf') {
			@header("Content-Type: application/pdf");
		}
		if ($type == 'jpg') {
			@header("Content-Type: image/jpeg");
		}
		@header("Content-Transfer-Encoding: binary");

		// Read the file from disk
		readfile($_SERVER['DOCUMENT_ROOT'].'/uploads/tmp/'.$file);
	}

	public function downloadPdf() {
		$this->pdf('D');
	}

	public function downloadJpg() {
		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;


		$this->download('u'.$idUser.'_saved.jpg', 'jpg');
	}

	public function send() {

		/*
		 * zczytac id zalogowanego usera
		 */
		$idUser = 1;

		$data = array('title'=>'Wysyłam email, z załącznikiem...', 'userid'=>$idUser);
		$this->load->view('main_template', $data);
		return;
		
		


		//zapisanie pdf-a
		$filename = $this->pdf('F');


		$my_file = $filename;
		$my_path = $_SERVER['DOCUMENT_ROOT']."/uploads/tmp/";
		$my_name = "Promar";
		$my_mail = "Promar@mail.com";
		$my_replyto = "my_reply_to@mail.net";
		$my_subject = "Testowy mail.";
		$my_message = "Test...";
		mail_attachment($my_file, $my_path, "recipient@mail.org", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

	}



}
