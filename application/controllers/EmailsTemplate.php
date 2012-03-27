<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


class EmailsTemplate extends CI_Controller {

	/**
	 * obiek klasy utilImage - klasa pomocniczych funckcji dot obazkow
	 * @var PK_UtilImage
	 */
	public $UI = null;

	/* przechowuje nazwe pliku tła */
	private $userBackgroundFile;

	/* identyfikator usera */
	private $userId;
	
	public function __construct() {
		parent::__construct();
		$this->load->helper('url');
		$this->load->helper('div');
		$this->load->helper('email');
		$this->load->library('PK_UtilImage');
		$this->UI = new PK_UtilImage();
		
		/* identyfikator sesji */
		
		////////////////////////////////////////
		// @TODO - zmienic na id sesji        //
		////////////////////////////////////////
		$this->userId = '1234567';
		////////////////////////////////////////
		// @TODO - zmienic na id sesji        //
		////////////////////////////////////////
		
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
			
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'jpg';
		$config['max_size']	= '2048'; //KB
		$config['max_width']  = '1000';
		$config['max_height']  = '1000';
		$config['overwrite']  = TRUE;
		
		/* ustawienie nazwy pliku ktory uploadowal user */
		$this->userBackgroundFile = 'user_background_'.$this->userId.'.jpg';
		$config['file_name']  = $this->userBackgroundFile; 

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		$this->upload->do_upload('file');
		redirect('emailstemplate/drag');
	}


	public function drag() {
		$this->load->library('session');
		$this->load->helper('context_menu');
		$this->load->helper('buttons');



		//[rzechowuje tablice JS - informacje o wygenerowanych lampach usera
		$data['JS_ELEMENTS_DATA'] = '';


		/*
*/		
		$this->db->select('id, id_column, id_crown, id_fitting, text_column, text_crown, text_fitting');
		$this->db->where('id_user', $this->userId);
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('saved_element');


		//zmienna przechwuje nazwy plikow
		$aItems = array();
		foreach ($query->result() as $row) {
			$data['JS_ELEMENTS_DATA'] .= "ELEMENTS_DATA['u{$this->userId}_i{$row->id}.png'] = {'text':'{$row->text_column} {$row->text_crown} {$row->text_fitting}', 'count':0};\r\n";
			$aItems[] = "u{$this->userId}_i{$row->id}.png";
		}
		
		/*
		 * odczytanie z katalogu obrazkow usera
		 * elementy: u{id_usera}_i{id_elementu}.png
		 * tlo: u{id_usera}bg.jpg
		 */
		/*
		$bg = '';
		$aItems = array();
		if ($handle = opendir('uploads/tmp')) {
			while (false !== ($file = readdir($handle))) {
				if (preg_match('/^u'.$this->userId.'_i[0-9]+\./', $file)) {
					$aItems[] = $file;
				}
				if (preg_match('/u'.$this->userId.'bg\./', $file)) {
					$bg = $file.'?r'.rand(1,99); //dodane zeby nie bylo cachowania obrazkow w przegladare
				}
			}
			closedir($handle);
		}
*/

		//$data['bg'] = "/uploads/tmp/u{$this->userId}bg.jpg";
		$data['bg'] = $this->userBackgroundFile;
		
		/* jesli user wybral predefiniowane tło */
		if ($this->input->get('bg') > 0) {
			$data['bg'] = "/uploads/background_".$this->input->get('bg').".jpg";
		}
		
		$data['items'] = $aItems;
		$data['userid'] = $this->userId;


		$this->load->view('drag', $data);
	}//function



	public function pdf($type='I') {
		require('fpdf/fpdf.php');


		//@todo - trzeba sprawdzic czy obrazek zostal zapisany , jak nie to zapisa�

		$pdf = new FPDF();
		$pdf->AddPage();
		$pdf->SetFont('Arial','B',16);
		$pdf->Cell(40,10,'Hello World!');
		$pdf->Ln(10);
		$pdf->Image('uploads/u'.$this->userId.'_saved.jpg');
		//$pdf->Output();
		return $pdf->Output($_SERVER['DOCUMENT_ROOT'].'uploads/u'.$this->userId.'.pdf',$type);
	}


	public function choose_item() {
		
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
			$res = $this->db->query("SELECT id, title, 'column' as type FROM `column` ORDER BY title");
		} else if ($step == 1) {
			$res = $this->db->query("SELECT id, title, 'crown' as type FROM crown ORDER BY title");
		} else {
			$res = $this->db->query("SELECT id, title, 'fitting' as type FROM fitting ORDER BY title");
		}
		

		$aType = array('column', 'crown', 'fitting');

		$data['header'] = 'Step '.($step+1);
		$data['columnId'] = $columnId;
		$data['crownId'] = $crownId;
		$data['fittingId'] = $fittingId;
		$data['type'] = $aType[$step];
		$data['step'] = $step+1;
		$data['list'] = $res->result();
		$data['userid'] = $this->userId;

		$this->load->view('choose_item', $data);

	}


	
	
	public function choose_background() {
		
		
		$this->load->helper('buttons');
		$this->load->helper('form');

		
		$this->db->select('id');
		$this->db->order_by('id', 'desc');
		$res = $this->db->get('background');
		
		$data['list'] = $res->result();
		$data['userid'] = $this->userId;
		$data['url'] = 'EmailsTemplate';

		$this->load->view('choose_background', $data);
	}
	
	
	
	
	
	
	/*
	|
		 CREATE TABLE IF NOT EXISTS saved_element (
         id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
         id_user INT NOT NULL DEFAULT 0,
         id_column INT NOT NULL DEFAULT 0,
         id_crown INT NOT NULL DEFAULT 0,
         id_fitting INT NOT NULL DEFAULT 0,
         text_column VARCHAR(255) NOT NULL DEFAULT '',
         text_crown VARCHAR(255) NOT NULL DEFAULT '',
         text_fitting VARCHAR(255) NOT NULL DEFAULT ''
       );
	
	|
	*/
	
	public function save_item() {
		echo 'SAVE ITEM ';

		
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

		//zapisz do bazy id_usera, wybrane elementy, kody, tych elementów + nazwę wygenerowanego pliku
		
		//ustawienie jake pola nalezy zczytac
		$this->db->select('title');
		
		//tablica pmocnicza, przechowuje dane z bazy o elementach
		$t = array();
		$a = array('column', 'crown', 'fitting');
		//dla kazdego typu elementu zczytanie z bazy danych i zapisanie do tablicy pomocniczej
		foreach ($a as $element) {
			//dodanie do where wartosci z GET
			$this->db->where('id', $this->input->get($element));
			//ustawienie odpowiedniaj nazwy tabeli
			$query = $this->db->get($element);
			$row = $query->row_array();
			$t[$element] = $row['title'];
		}
		
		
		//zapisz calosc
		$insert = array(
			'id_user'=>1,
			'id_column'=>$this->input->get('column'),
			'text_column'=>$t['column'],
			'id_crown'=>$this->input->get('crown'),
			'text_crown'=>$t['crown'],
			'id_fitting'=>$this->input->get('fitting'),
			'text_fitting'=>$t['fitting']
		);
		$this->db->insert('saved_element',$insert);

		//opdczytanie dodanego idka
		$lastId = $this->db->insert_id();
		
		//ustawienie nazwy pliku
		$filename = 'u'.$this->userId.'_i'.$lastId;
		
		//zapisz obrazek oraz jego lustrzane odbicie
		$this->UI->imagesaveflip($img, $filename, 'PNG');

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


		//wczytaj obrazek tla
		//$bg = $this->UI->getimage('uploads/tmp/u'.$this->userId.'bg.jpg');
		$bg = $this->UI->getimage($this->userBackgroundFile);

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


		$this->UI->imagesave($bg, 'uploads/u'.$this->userId.'_saved', 'JPG');
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
		readfile($_SERVER['DOCUMENT_ROOT'].'/uploads/'.$file);
	}

	public function downloadPdf() {
		$this->pdf('D');
	}

	public function downloadJpg() {


		$this->download('u'.$this->userId.'_saved.jpg', 'jpg');
	}

	public function send() {


		$data = array('title'=>'Wysyłam email, z załącznikiem...', 'userid'=>$this->userId);
		$this->load->view('main_template', $data);
		return;
		

		//zapisanie pdf-a
		$filename = $this->pdf('F');


		$my_file = $filename;
		$my_path = $_SERVER['DOCUMENT_ROOT']."/uploads/";
		$my_name = "Promar";
		$my_mail = "Promar@mail.com";
		$my_replyto = "my_reply_to@mail.net";
		$my_subject = "Zapytanie z aplikacji.";
		$my_message = "Test...";
		mail_attachment($my_file, $my_path, "biuro@promar-sj.com.pl", $my_mail, $my_name, $my_replyto, $my_subject, $my_message);

	}



}
